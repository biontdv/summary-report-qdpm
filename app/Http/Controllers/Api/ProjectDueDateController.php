<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProjectDueDateController extends Controller
{
    public function pivotPicSummary(Request $request){
        $projectId =  $request->input('ProjectId');
    	 $pivotPicSummary = DB::table('pivot_summary_pic_project_api')
                                ->where('id',  $request->input('ProjectId'))

                                ->get();
    	 return response()->json($pivotPicSummary, 200);

    }

    public function DueDate(Request $request){
//         SELECT 
// 		 pr.id,
// 		 pr.name,
//          ex.value as uat_date
// FROM extra_fields_list ex
// INNER JOIN projects pr ON ex.bind_id = pr.id
// WHERE bind_id = 73
// 	AND extra_fields_id = 5   
        $projectId = $request->input('ProjectId');
        $uat = DB::table('extra_field_list')
                    ->select('projects.id','projects.name','extra_field_list.value as uat_date')
                    ->join('projects','extra_field_list.bind_id','projects.id')
                    ->get();
        return response()->json($uat,200);
    }
}
