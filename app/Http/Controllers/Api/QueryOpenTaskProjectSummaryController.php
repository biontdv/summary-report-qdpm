<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class QueryOpenTaskProjectSummaryController extends Controller
{
    public function queryOpenTaskProjectSummary(Request $request){
        $projectId =  $request->input('ProjectId');
    	 $queryOpenTaskProjectSummary = DB::table('query_opentasks_projectsummary')
        ->select('query_opentasks_projectsummary.id','query_opentasks_projectsummary.name','query_opentasks_projectsummary.description','assigned_to')
                            ->where('projects_id', $projectId =  $request->input('ProjectId'))
                            ->get();
    	 return response()->json($queryOpenTaskProjectSummary, 200);

    }
}

