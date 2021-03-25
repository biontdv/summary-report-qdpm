<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TotalTicketController extends Controller
{
    public function totalTicket(Request $request){
        	$ProjectId = $request->input('ProjectId');
            $totalTicket = DB::table('summary_tickets_count')
                    ->where('projects_id', $ProjectId)
                    ->get();
    	    return response()->json($totalTicket, 200);
	}
}