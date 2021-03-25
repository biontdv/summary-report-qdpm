<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DetailTicketController extends Controller
{
    public function detailTicket(Request $request){
        	$ProjectId = $request->input('ProjectId');
            $detailTicket = DB::table('summary_ticket_detail')
                    ->where('projects_id', $ProjectId)
                    ->get();
    	    return response()->json($detailTicket, 200);
	}
}
