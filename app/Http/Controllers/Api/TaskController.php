<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TaskController extends Controller{
        public function task(Request $request){
            $projectId = $request->input('ProjectId');
            $statusId = $request->input('tasks_status_id'); 
            $task = DB::table('tasks')
                    ->select('tasks.id','tasks.projects_id',  
                                       'tasks.created_by', 'tasks.name', 'tasks.description','tasks.start_date','tasks.due_date',    
                                       'users.name as assigned_to',
                                        'tasks.tasks_status_id', 'tasks_status.name as tasks_status')
                    ->leftjoin('users', 'users.id', '=', 'tasks.assigned_to')
                    ->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id');
            if ($projectId!=null)$task = $task->where('projects_id',$projectId )->where('tasks_status_id', $statusId);
            $task = $task->orderby('name', 'ASC')->get();
          return response()->json($task, 200);
        }

        public function taskMoreDetail(Request $request){
                $taskId = $request->input('taskId');
                $task = DB::table('task_more_detail')
                        ->where('tasks_id', $taskId)
                        ->first();
                return response()->json($task, 200);
        }
        public function taskMoreDetailByUser(Request $request){
                $userid = $request->input('userid');
                $task = DB::table('task_more_detail')
                        ->join('tasks','tasks.id','=','task_more_detail.tasks_id')
                        ->join('tasks_status','tasks_status.id','=','tasks.tasks_status_id')
                        ->where('task_more_detail.assignee_id', $userid)
                        ->select('task_more_detail.tasks_id','task_more_detail.tasks_name',
                                 'task_more_detail.projects','tasks_status.name',
                                 'task_more_detail.assignee','task_more_detail.priority',
                                 'task_more_detail.label','task_more_detail.tasks_group',
                                 'task_more_detail.phase','task_more_detail.description',
                                 'task_more_detail.created_at','task_more_detail.estimated_time',
                                 'task_more_detail.start_date','task_more_detail.due_date',
                                 'task_more_detail.progress')
                        ->get();
                return response()->json($task, 200);
        }
        public function taskOpenCount(Request $request){
                $projectId = $request->input('projectId');
                $task = DB::table('task_open_count')
                        ->where('projects_id', $projectId)
                        ->get();
                return response()->json($task, 200);
        }

        public function taskOpenSummary(Request $request){
                $projectId = $request->input('projectId');
                $assigneeId = $request->input('assigneeId');
                $task = DB::table('task_open_summary')
                        ->where('projects_id', $projectId)
                        ->where('assignee_id', $assigneeId)
                        ->get();
                return response()->json($task, 200);
        }

        public function taskUpdateByBA(Request $request){
                $projectId = $request->input('projectId');
                $task = DB::table('task_updated_by_ba')
                        ->where('projects_id', $projectId)
                        ->where('count_updated', '<>' ,0)
                        ->get();
                return response()->json($task, 200);
        }

        public function taskUpdateByBADetail(Request $request){
                $projectId = $request->input('projectId');
                $userId = $request->input('userId');
                $task = DB::table('task_updated_by_ba_detail')
                        ->where('projects_id', $projectId)
                        ->where('user_id', $userId)
                        ->get();
                return response()->json($task, 200);
        }

        public function taskOpenPIC(Request $request){
                $assigneeId = $request->input('assigneeId');
                $task = DB::table('tasks_open_pic')
                        ->where('assignee_id', $assigneeId)
                        ->get();
                return response()->json($task, 200);
        }
        
        public function tasksCompletedCount(Request $request){
                $projectId = $request->input('projectId');
                $task = DB::table('tasks_completed_count')
                        ->where('projects_id', $projectId)
                        ->get();
                return response()->json($task, 200);
        }
        public function tasksCompletedPercent(Request $request){
                $projectId = $request->input('projectId');
                $totalCompleted = 0;
                $taskCompleted = DB::table('tasks_completed_count')
                        ->select('projects_id',DB::raw('SUM(count_completed) totalCompleted'))
                        ->where('projects_id', $projectId)
                        ->where('count_completed' ,'>',0)
                        ->get();
                $totalCompleted = $taskCompleted[0]->totalCompleted;
                $alltask = DB::table('tasks')->where('projects_id',$projectId)->count();
                if($totalCompleted > 0)
                $percentage=  ceil($totalCompleted / $alltask * 100);
                else {
                        $percentage = 0;
                }
                
                $task =  array(['id' => $projectId , 'Percentage' => $percentage]);
                return response()->json($task, 200);
        }

        public function tasksCompletedSummary(Request $request){
                $projectId = $request->input('projectId');
                $closedDate = $request->input('closedDate');
                // $task = DB::table('tasks_completed_summary')
                //         ->where('projects_id', $projectId)
                //         ->where('closed_date', $closedDate)
                //         ->get();
                $task = DB::SELECT(
                                "SELECT 
                                                t.id as tasks_id
                                                ,t.name as tasks
                                                ,u.name as assignee 
                                                ,p.name as priority
                                                ,l.name as labels
                                                ,g.name as `tasks_group`
                                                ,ph.name as phases
                                        FROM tasks t
                                LEFT JOIN users u ON u.id = t.assigned_to
                                LEFT JOIN tasks_priority p ON p.id = t.tasks_priority_id
                                LEFT JOIN tasks_labels l ON l.id = t.tasks_label_id
                                LEFT JOIN tasks_groups g ON g.id = t.tasks_groups_id
                                LEFT JOIN phases ph ON ph.id = t.projects_phases_id
                                        WHERE 
                                                t.projects_id = $projectId
                                                        AND
                                                closed_date = '$closedDate'
                                                        AND
			                	tasks_status_id = 7");
                return response()->json($task, 200);
        }

        public function taskCompletedDate(Request $request){
                $projectId = $request->input('projectId');
                $task = DB::SELECT(
                                "SELECT 
                                        date
                                        ,t.projects_id
                                        ,p.`name` as projects
                                        ,COUNT(CASE WHEN t.tasks_status_id = 7 THEN 1 ELSE NULL END) as count
                                    FROM (
                                    SELECT DATE(NOW() - INTERVAL n DAY) AS date
                                        FROM (
                                                SELECT 0 n
                                                UNION SELECT 1
                                                UNION SELECT 2
                                                UNION SELECT 3
                                                UNION SELECT 4
                                                UNION SELECT 5
                                                UNION SELECT 6
                                        ) q  
                                        ORDER BY date desc	
                                ) l
                                LEFT JOIN tasks t ON l.date = t.closed_date
                                        AND t.projects_id = $projectId
                                LEFT JOIN projects p ON t.projects_id = p.id
                                GROUP BY date, p.name, t.projects_id");
                return response()->json($task, 200);
        }

        
    public function taskProject(Request $request){
        $projectId = $request->input('projectId');
        $status = $request->input('status');
        if(empty($status)) {
        $task = DB::table('tasks')
                        ->select('tasks.id','tasks.name','tasks.description','tasks.tasks_status_id','tasks_status.name as tasks_status','projects.name as projects','projects_id','tasks.start_date','tasks.due_date')
                        ->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id')
                        ->leftjoin('projects','projects.id','=','tasks.projects_id')
                        ->where("projects_id",$projectId)
                        ->orderby('id', 'ASC')
                        ->get();
           $open = 0; 
           $completed= 0;
           $suspended =0;
           $done = 0;
           $newRequest = 0;
           $reopen = 0;
           $project = (object) array('Name'=>'','Opened' => 0,'Completed' => 0,'Suspended'=>0,
                        'Done' => 0, 'NewRequest' => 0, 'ReOpen' => 0, 'TotalOpened'=>0,'TotalCompleted'=>0,'TotalSuspended'=>0,
                        'TotalDone'=>0,'TotalNewRequest'=>0,'TotalReOpen'=>0,'TotalTask' => sizeof($task));
                        foreach($task as $key => $value) {
                                switch($value->tasks_status_id) {
                                        case 1 :
                                                $open++;
                                                break;
                                        case 2 :
                                                $suspended++;
                                                break;
                                        case 5 :
                                                $done++;
                                                break; 
                                        case 7 :
                                                $completed++;
                                                break;
                                        case 9 :
                                                $newRequest++;
                                                break;  
                                        case 4 :
                                                $reopen++;
                                                break;       
                                }
                
                                $project->Opened = $open;
                                $project->Completed= $completed;
                                $project->Suspended= $suspended;
                                $project->Done = $done;
                                $project->NewRequest = $newRequest;
                                $project->ReOpen = $reopen;
                                $project->Name=$value->projects;
                        }         
                        $project->TotalOpened = $project->Opened;
                        $project->TotalCompleted = $project->Completed;
                        $project->TotalSuspended = $project->Suspended;
                        $project->TotalSuspended = $project->Suspended;
                        $project->TotalDone = $project->Done;
                        $project->TotalNewRequest = $project->NewRequest;
                        $project->TotalReOpen = $project->ReOpen;
                        
                        $project->Opened = round($project->Opened / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
                        $project->Completed = round($project->Completed / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
                        $project->Suspended = round($project->Suspended / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
                        $project->Done = round($project->Done / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
                        $project->NewRequest = round($project->NewRequest / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
                        $project->ReOpen = round($project->ReOpen / sizeof($task) * 100,1, PHP_ROUND_HALF_UP);
      return response()->json([$project], 200);
                }

                else {
                        $data = (object)array('name' =>'','tasks' => 0);
                        $temp_jml = array();
                        $temp_name = array();
                        //$res =array();
                        $task = DB::table('tasks')
                        ->select('tasks.id','tasks.name','task_more_detail.assignee_id','task_more_detail.assignee','task_more_detail.progress')
                        ->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id')
                        ->leftjoin('projects','projects.id','=','tasks.projects_id')
                        ->leftjoin('task_more_detail', 'task_more_detail.tasks_id','=','tasks.id')
                        ->where("tasks.projects_id",$projectId)
                        ->where("tasks_status_id",$status)
                        ->orderby('id', 'ASC')
                        ->get();
                         foreach($task as $key =>$val) {
                                 if(empty( $temp_jml[$val->assignee_id])) {
                                         $temp_jml[$val->assignee_id] = 1;  
                                         $temp_name[$val->assignee_id] = $val->assignee;           
                                 }else {
                                        $temp_jml[$val->assignee_id] = 1 + $temp_jml[$val->assignee_id];
                                        $temp_name[$val->assignee_id] = $val->assignee;  
                                        
                                 }
                         }
                         $i=0;
                         foreach($temp_jml as $key => $val) {
                                $data->name =$temp_name[$key];
                                $data->tasks= $val;
                                $res[] = clone $data;
                         }
                        return response()->json($res, 200);
                }
    }

    public function TaskAttachmentFile() {
        $task = DB::table('projects')
        ->select('attachments.id as attId','projects.name as projects',
        'projects.id','attachments.file')
        //->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id')
       // ->leftjoin('projects','projects.id','=','tasks.projects_id')
        ->join('attachments',function($join)
        {
                $join->on('attachments.bind_id','=','projects.id');
                $join->where('attachments.bind_type','=','projects');
        })
        //->where('attachments.bind_id','=','projects.id')
        ->orderby('id', 'ASC')
        ->get();
         
        $res= array();
        foreach($task as $key => $value) {
                 $res[$value->id]['project'] = $value->projects;
                 $res[$value->id]['id'] = $value->attId;
                 $res[$value->id]['file'][] = $value->file;
               
        }             
        $projectDocs = array();
        foreach ($res as $key => $value)
        {
          $projectDocs[] = $value;
        }
        return response()->json($projectDocs, 200);
    }
}
