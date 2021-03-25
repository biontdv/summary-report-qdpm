<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LatestTaskPicController extends Controller
{
   	function getLatestTaskPic(){
   		$getData = DB::table('latest_pic_task')->get();
   		return response()->json($getData,200);
   	}
}
