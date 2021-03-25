<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PivotSummaryProjectController extends Controller
{
    public function pivotSummaryProject(Request $request){
        $projectId =  $request->input('ProjectId');
    	 $pivotSummaryProject = DB::table('pivot_summary_project')
                                ->where('project_id',  $request->input('ProjectId'))                              
                                ->get();
    	 return response()->json($pivotSummaryProject, 200);

    }
}
