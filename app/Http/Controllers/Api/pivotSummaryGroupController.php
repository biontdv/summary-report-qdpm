<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class pivotSummaryGroupController extends Controller
{
    public function pivotSummaryGroup(Request $request){
        $groupId =  $request->input('GroupId');
    	 $pivotSummaryGroup = DB::table('pivot_summary_group')
                                ->where('task_group_id',  $groupId)                               
                                ->get();
    	 return response()->json($pivotSummaryGroup, 200);

    }
}

