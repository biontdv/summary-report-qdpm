<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TaskPicController extends Controller
{
    public function taskPic(Request $request){
            $userId = $request->input('UserId');
            $projectId = $request->input('ProjectId');
            $task = DB::table('tasks')
            		->select('tasks.id','tasks.name','tasks.description','tasks.tasks_status_id','tasks_status.name as tasks_status','projects.name as projects','projects_id','tasks.start_date','tasks.due_date')
            		->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id')
            		->leftjoin('projects','projects.id','=','tasks.projects_id')
            		->whereRaw("find_in_set($userId,assigned_to)")
            		->where("projects_id",$projectId)
            		->orderby('id', 'ASC')
            		->get();
          return response()->json($task, 200);
        }
}