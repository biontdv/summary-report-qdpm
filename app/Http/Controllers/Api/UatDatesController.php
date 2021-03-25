<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UatDatesController extends Controller
{
    public function uatDate (Request $request){
        $projectId = $request->input('ProjectId');
        $uat = DB::table('extra_fields_list')
                	->join('projects','extra_fields_list.bind_id','=','projects.id')
        			->select('projects.id','projects.name','extra_fields_list.value')
                    ->where('extra_fields_list.bind_id',$projectId)
                    ->where('extra_fields_list.extra_fields_id',5)
                    ->get();
        return response()->json($uat,200);
    }
}