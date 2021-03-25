<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GroupDetailController extends Controller
{
        public function groupSummary(Request $request){
         $projectId = $request->input('GroupId');
         $statusId = $request->input('tasks_status_id'); 
    	   $group = DB::table('tasks')
                    ->select('tasks.id','tasks.tasks_groups_id',  
                                       'tasks.created_by', 'tasks.name', 'tasks.description','tasks.start_date','tasks.due_date',    
                                       'users.name as assigned_to',
                                        'tasks.tasks_status_id', 'tasks_status.name as tasks_status')
                    ->leftjoin('users', 'users.id', '=', 'tasks.assigned_to')
                    ->leftjoin('tasks_status', 'tasks_status.id', '=', 'tasks.tasks_status_id');
            
            if ($projectId != null)
              $group = $group ->where('tasks_groups_id',$projectId )
                              ->where('tasks.tasks_status_id', $statusId);
              $group = $group->orderby('name', 'ASC')->get();
          return response()->json($group, 200);
    }
}
