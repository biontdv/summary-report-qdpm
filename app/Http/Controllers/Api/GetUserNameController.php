<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GetUserNameController extends Controller
{
    public function getDataUser(Request $request){
    	$userId = $request->input('UserId');
    	$getDataUser = DB::table('users')
    					->select('id', 'name')
    					->where('id', $userId)
    					->get();
    	return response()->json($getDataUser, 200);
    }
}
