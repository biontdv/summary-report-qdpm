<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TesterController extends Controller
{
    public function tester(Request $request){
            $projectId = $request->input('ProjectId');
            $tester = DB::table('summary_sit')
                    ->where('id', $projectId)
                    ->get();
    	    return response()->json($tester, 200);
        }
}
