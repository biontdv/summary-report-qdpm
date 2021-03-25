<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GroupController extends Controller
{
    public function group(Request $request){
            $projectId = $request->input('ProjectId');
            $group = DB::table('tasks_groups')
                    ->where('projects_id',$projectId)
                    ->get();
    	    return response()->json($group, 200);
        }
}
