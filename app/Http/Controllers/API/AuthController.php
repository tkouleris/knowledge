<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only(['email','password']);

        if( !$token = auth()->attempt($credentials) ){
            return response()->json(['error'=> 'Bad Credentials'],401);
        }
        $user = User::where('email',$credentials['email'])->first();

        return response()->json(
            [
                'id'=>$user->id,
                'name'=>$user->name,
                'token'=>$token
            ]
        );
    }

    public function logout(Request $request)
    {
//        $token = $this->jwt->get_token_from_request( $request );
//        $this->jwt->invalidate_token( $token );
//
//        $results['success'] = true;
//        $results['message'] = 'Logged out';
//        return response()->json($results,200);
    }
}
