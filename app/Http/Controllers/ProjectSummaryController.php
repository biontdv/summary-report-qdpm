<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Gbrock\Table\Facades\Table;
use App\tasksProjectSummary;
use App\User;
use App\Library\GetSession;

class ProjectSummaryController extends Controller
{
    private function getProjectList(){
        $projects = DB::table('projects')
        ->join('tasks', 'tasks.projects_id', '=', 'projects.id')
        ->select('projects.*')
        ->distinct()
        ->where('projects.projects_status_id', 1)
        ->orderBy('projects.name', 'asc')
        ->get();
        return $projects;
    }

    public function index(Request $request){
    //  $user_name="";
     //echo "hello from laravel";
     
     // if(!$request->session()->has('users')){
     //   return redirect(env('QDPM_URL'));
        // }elseif(session()->get('users')->users_group_id !=1 && (session()->get('users')->users_group_id != 4)) {
        //     return redirect(env('QDPM_URL'));
   // }else{
     //  $user_name=session()->get('users')->name;
   // }
    $projects = $this->getProjectList();
    $projectId = $request->input('project-id');
    $projectId = ($projectId == "") ? $projects->first()->id : $projectId;
    $selectedProject = DB::table('projects')->where('id', $projectId)->first();
    $projectSummary = DB::table('pivot_summary_project')->where('project_id',$projectId)->get();
    $yourFirstChart = DB::table('project_summary_status')
    ->selectRaw('project,task_status_id,task_status,sum(ts_count) as total_status')
    ->where('project_id', $projectId)
    ->groupBy('project','task_status')
    ->get();

    $tasksSummary = DB::table('query_opentasks_projectsummary')
    ->select('query_opentasks_projectsummary.id','query_opentasks_projectsummary.name','query_opentasks_projectsummary.description','assigned_to')
    ->where('projects_id', $projectId)
    ->get();


    return view('projectSummary.index')
    ->with('selectedProject',$selectedProject)
    ->with('projects',$projects)
    ->with('projectSummary',$projectSummary)
    ->with('tasksSummary',$tasksSummary)
    ->with('yourFirstChart',$yourFirstChart);
  //  ->with('user_name',$user_name);

}
public function exportProjectSummary(Request $request){
    ///testing
    $projectId = $request->input('project-id');
    $selectedProject = DB::table('projects')->where('id', $projectId)->first();
    $tableSummary = DB::table('pivot_summary_project')
    ->where('project_id', $projectId)
    ->orderby('phase_name', 'ASC')
    ->get();

    $taksSummary = DB::table('query_opentasks_projectsummary')
    ->select('id','name','description','assigned_to')
    ->where('projects_id', $projectId)
    ->get();
    $tabletasksSummary = Table::create($taksSummary);
    Excel::create($selectedProject->name . ' Project Summary', function($excel) use($selectedProject, $tableSummary, $tabletasksSummary) {
        $excel->sheet('New sheet', function($sheet) use($selectedProject, $tableSummary, $tabletasksSummary) {
            $sheet->loadView('projectSummary._summary')
            ->with('selectedProject', $selectedProject)
            ->with('tableSummary', $tableSummary)
            ->with('tabletasksSummary', $tabletasksSummary);
        });
    })->download('xls');
}


public function picSummary(Request $request){
  $user_name="";
  if(!$request->session()->has('users')){
    return redirect(env('QDPM_URL'));
        // }elseif(session()->get('users')->users_group_id !=1 && (session()->get('users')->users_group_id != 4)) {
        //     return redirect(env('QDPM_URL'));
}else{
    $user_name=session()->get('users')->name;
}
$projects = $this->getProjectList();
$projectId = $request->input('project-id');
$projectId = ($projectId == "") ? $projects->first()->id : $projectId;
$selectedProject = DB::table('projects')->where('id', $projectId)->first();
$picSummary = DB::table('pivot_summary_pic_project')
        						// ->selectRaw('name_user_summary, task_group, phase_name, phase_id, sum(opened) as opened, sum(suspended) as suspended, sum(reOpened) as reOpened, sum(done) as done, sum(completed) as completed')
->where('id', $projectId)
->orderby('name_user_summary', 'ASC')                                
->get();
$takspicSummary = DB::table('query_opentasks_picsummary')
->select('id','name','description','assigned_to')
->where('projects_id',$projectId)
->get();
$chartDesignKedua = DB::table('pivot_summary_pic_project')
->selectRaw('name_user_summary, sum(opened) as opened, sum(suspended) as suspended, sum(reOpened) as reOpened, sum(done) as done, sum(completed) as completed')
->where('id', $projectId)
->groupBy('project','name_user_summary')
->get();

$tester = DB::table('summary_sit')
->where('id', $projectId)
->get();

return  view ('projectSummary.index-pic')
->with('selectedProject', $selectedProject)
->with('projects', $projects)
->with('picSummary', $picSummary)
->with('takspicSummary', $takspicSummary)
->with('chartDesignKedua', $chartDesignKedua)
->with('user_name',$user_name)
->with('tester',$tester);
}

public function picDuration(Request $request){
    $user_name="";
    if(!$request->session()->has('users')){
        return redirect(env('QDPM_URL'));
    }else{
        $user_name=session()->get('users')->name;
    }

    $idle = DB::table('picprojectduration')
        ->selectRaw('assignee_name,assignee_id,projects_name,start_date,due_date,MAX(idle_date) as max_idle,active')
        ->where('active','1')
        ->groupBy('assignee_name')
        ->get();
    return view('projectSummary.index-pproject')
        ->with('user_name',$user_name)
        ->with('idle',$idle);

}

public function picDurationJson ($id){
    $data = DB::table('picprojectduration')
    ->where('assignee_id',$id)
    ->orderBy('assignee_name','ASC')
    ->orderby('start_date','ASC')
    ->get();
    return response()->json($data, 200);

}

public function exportPicSummary(Request $request){
    $projectId = $request->input('project-id');
    $selectedProject = DB::table('projects')->where('id', $projectId)->first();
    $tablePicSummary = DB::table('pivot_summary_pic_project')
                                                        // ->selectRaw('name_user_summary, task_group, sum(opened) as opened, sum(suspended) as suspended, sum(reOpened) as reOpened, sum(done) as done, sum(completed) as completed')
    ->where('id', $projectId)
    ->orderby('name_user_summary', 'ASC')                                
    ->get();
        // $tablePicSummary = Table::create($picSummary);

    $takspicSummary = DB::table('query_opentasks_picsummary')
    ->select('id','name','description','assigned_to')
    ->where('projects_id',$projectId)
    ->orderby('name', 'ASC')                           
    ->get();
    $tabletasksPicSummary = Table::create($takspicSummary);

    Excel::create($selectedProject->name . ' Project Summary', function($excel) use($selectedProject, $tablePicSummary, $tabletasksPicSummary) {
        $excel->sheet('New sheet', function($sheet) use($selectedProject, $tablePicSummary, $tabletasksPicSummary) {
            $sheet->loadView('projectSummary._pic')
            ->with('selectedProject', $selectedProject)
            ->with('tablePicSummary', $tablePicSummary)
            ->with('tabletasksPicSummary', $tabletasksPicSummary);
        });
    })->download('xls');
}

public function notfound(){
    return '404 not found';
}

function rubah_tanggal($tgl)
{
   $exp = explode('-',$tgl);
   if(count($exp) == 3)
   {
       $tgl = $exp[2].'-'.$exp[1].'-'.$exp[0];
   }
   return $tgl;
}

public function ganttChart(request $request)
{

    $user_name="";
    if(!$request->session()->has('users')){
        return redirect(env('QDPM_URL'));
        // }elseif(session()->get('users')->users_group_id !=1 && (session()->get('users')->users_group_id != 4)) {
        //     return redirect(env('QDPM_URL'));
    }else{
        $user_name=session()->get('users')->name;
    }
    $projectData = DB::table('task_view_pertama')
    ->selectRaw('id_tasks,id_project,status_project,nama_type_projects,id_priority,name_projects, name,name_type,assigned_to,deskripsi, start_date, closed_date,due_date,created_at,created_by,label,task_status,priority,lama, progress')
    ->get();

    forEach($projectData as $key=>$item){
        $item->deskripsi  = preg_replace( "/\r|\n/", "", $item->deskripsi );
        $item->deskripsi = chunk_split($item->deskripsi, 10 , "");

        $item->start_date= $this->rubah_tanggal($item->start_date) ;
    }
                       // return (var_dump($projectData));
    return view('ganttChart.index')
    ->with('projectData', $projectData);
                        // ->with('viewProject', $viewProject);
}

public function GetDataTooltip(Request $request)
{

    $projectData = DB::table('task_view_pertama')
    ->selectRaw('id_tasks,id_project,status_project,nama_type_projects,name_projects, name, start_date, closed_date,due_date, lama, progress')
    ->Where('id_tasks', $request->input('id_tasks'))
    ->get();

    forEach($projectData as $key=>$item){
     $item->start_date= $this->rubah_tanggal($item->start_date) ;
}

 return response()->json($projectData, 200);
}

}
