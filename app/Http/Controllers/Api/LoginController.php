<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use App\Http\Controllers\Controller;
use DB;
use Hash;


class LoginController extends Controller
{
    public function login(Request $request){
    	$email = $request->input("Email");
        $selectPass = DB::table('users')
                    ->select('id','email','name','password')
                    ->where('email','=',$email)
                    ->get();
        $passServer = "";
        
        if (!empty($selectPass[0])){
            $passServer = $selectPass[0]->password;     
        }

        $password = Hash::check($request->input("Password"),$passServer);
        $data = array();
        if ($password) {
            $data = array(
                'id' => $selectPass[0]->id,
                'name' => $selectPass[0]->name,
                'email' => $selectPass[0]->email,
                'status' => '1',
                );
        }else{
           $data  = array('message' => 'Login Gagal..',
                'status' => '0' );
        }
        return response()->json([$data], 200);
     }
 }

