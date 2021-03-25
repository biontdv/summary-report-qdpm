<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
{
    public function list()
    {

        $res = DB::table('tasks_temp')
        ->select('id','Assignee','task_status_id','completed_tasks','open_tasks','done_tasks')
        //->where('active', 1)
        ->get();
        
        // foreach($res as $key => $value) {
        //     $assigneeId =$value->id;
        //     dump($value->id);
        //     $taskopen = DB::table('tasks_open_pic')
        //             ->where('assignee_id', $assigneeId)
        //             ->count();
        //     dump($taskopen);
        //    $taskcompleted = DB::table('tasks_completed_summary')
        //             ->where('assignee_id', $assigneeId)
        //             ->count();  
        //     dump($taskcompleted);
        //    $totaldone = DB::table('tasks_done_summary')
        //    ->where('assignee_id', $assigneeId)
        //    ->count(); 
        //    dump($totaldone);
        //    $totalprogress = DB::table('task_more_detail')
        //    ->where('assignee_id','=', $assigneeId)
        //    ->where("progress",'<>','')
        //    ->count();
        //    dump($totalprogress);              
        //     $value->taskopen = $taskopen;
        //     $value->taskprogress=$totalprogress;
        //     $value->totaldone = $totaldone;
        //     $value->totalcompleted = $taskcompleted;
        //     $res[$key] = $value;
        // }
        
        return response()->json($res, 200);            
    }
    
    public function list_pl_using(){
      $result = DB::select(DB::raw('call summary_list_user_task()'));

      return response()->json($result,200);
    }
    
}