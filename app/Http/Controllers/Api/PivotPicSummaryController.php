<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PivotPicSummaryController extends Controller
{
    // ini di perbarui
    public function pivotPicSummary(Request $request){
        $projectId =  $request->input('ProjectId');
    	 $pivotPicSummary = DB::table('pivot_summary_pic_project_api')
                                ->where('id',  $request->input('ProjectId')) 
                                ->groupby('name_user_summary')
                                //->groupby('project') 
                                ->get();
         return response()->json($pivotPicSummary, 200);
    }
}
 