<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class QueryOpenTaskPicSummaryController extends Controller
{
    public function queryOpenTaskPicSummary(Request $request){
        $projectId =  $request->input('ProjectId');
    	 $queryOpenTaskPicSummary = DB::table('query_opentasks_picsummary')
        											->select('id','name','description','assigned_to')
        											->where('projects_id', $projectId =  $request->input('ProjectId'))
        											->get();
    	 return response()->json($queryOpenTaskPicSummary, 200);

    }
    
}
