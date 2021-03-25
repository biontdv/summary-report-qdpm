<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class picSummaryController extends Controller
{
    public function picSummary(Request $request){
        //$projectId = $request->input('ProjectId');
        // $picSummary = DB::raw('select distinct name_user_summary, count(*) as total from summary_pic_project group by name_user_summary')
        // ->select('name_user_summary') 
        //                         ->distinct('name_user_summary') 
        //                         ->count()
        //                         ->where('id', $projectId)      
        //                         ->groupby('name_user_summary')   
        //                         ->get();
        //  return response()->json($picSummary, 200);
         
        //$result = DB::select(DB::raw('select distinct name_user_summary, count(*) as total from summary_pic_project where id= '$projectId' group by name_user_summary'));

        $projectId = $request->input('ProjectId');
    	$picSummary = DB::table('summary_pic_project')
                                ->where('id', $projectId)
                                ->orderby('name_user_summary', 'ASC')  
                                //->groupby('name_user_summary')                              
                                ->get();
    	 return response()->json($picSummary, 200);

    }
}
