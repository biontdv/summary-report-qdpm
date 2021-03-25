<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PicIdleDetailController extends Controller
{
    public function picIdleDetail(Request $request){
       $userId = $request->input("UserId");
       $data = DB::table('picprojectduration')
           ->select('projects_id', 'projects_name','task_name','assignee_name',
               'assignee_id', 'start_date', 'idle_date', 'active')
              ->where('assignee_id',$userId)
              ->orderBy('assignee_name','ASC')
              ->orderBy('idle_date','DESC')
              ->limit(1)
              ->get();
        return response()->json($data, 200);

    	
    }
}
