<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardMobileController extends Controller{
    public function getProjectOverview(Request $request){
        $userId = $request ->input("user_id");
        
        $user_role = DB::table('users')
                    ->select('users_group_id')
                    ->where('id','=',$userId)
                    ->value('users_group_id');
        
        if ($user_role == 1 || $user_role == 4){
            $res = DB::table('projects_overview')
            ->select('*')
            
            ->groupby('id_project')
            ->orderby('project_name','ASC')
            ->distinct()
            ->get();
            return response()->json($res,200);
        } else {
            $res = DB::table('projects_overview')
            ->select('*')
            ->where('assignee_id','=',$userId)
            ->orderby('project_name','ASC')
            ->get();
            return response()->json($res,200);
        }
        
    }
}