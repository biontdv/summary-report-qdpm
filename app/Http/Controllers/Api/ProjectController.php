<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProjectController extends Controller
{
    public function project(Request $request){
        $userId = $request->input('UserId');
        $role = DB::table('users')->select('id','users_group_id')->where('id', $userId)->get();  

            if (($role[0]->users_group_id == 4) || ($role[0]->users_group_id == 1) || ($role[0]->users_group_id == 14)){
                $project = DB::table('projects')
                ->select('id','name')
                ->where('projects_status_id',1)
                ->orderby('name','ASC')
                ->get();
                return response()->json($project, 200); 
            }else{
                $user_project  = DB::table('list_project')
                ->select('*')
                ->where('assignee_id',$userId)
                ->get();
                return response()->json($user_project, 200); 
            }
    }
    
}