<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class picDurationController extends Controller
{
    public function picDuration(){
       $idle = DB::table('picprojectduration')
			->selectRaw('assignee_name,assignee_id,projects_name,start_date,due_date,MAX(idle_date) as max_idle,active')
			->where('active','1')
			->orderBy('max_idle','ASC')
			->groupBy('assignee_name')
			->get();
		return response()->json($idle,200);
    	
    }
}
