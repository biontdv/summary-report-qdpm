<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProjectSummaryController extends Controller
{
    public function projectSummary(Request $request){
    	 $projectSummary = DB::table('project_summary_status')
                                ->where('task_group_id', $request->input('ProjectId'))
                                ->get();
    	 return response()->json($projectSummary, 200);

    }
}
