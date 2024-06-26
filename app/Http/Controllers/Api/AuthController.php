<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as Val;

class AuthController extends Controller
{
    public function login(Request $request){


        $credentials = $request->only(['id_card_number','password']);
        // dd($credentials);
        if(Auth::attempt($credentials)){
            /** @var \App\Models\Society*/
            $society = auth()->user();
            // dd($request->user());
            $society->load(['regional']);

            $token = $society->createToken('myToken')->plainTextToken;
            return response()->json(['message'=>'login success','body'=>[
                'name'=>$society->name,
                'bron_date'=>$society->born_date,
                'gender'=>$society->gender,
                'token'=>$token,
                'regional'=>$society->regional,
            ]],200);
        }   


        return response()->json(['message'=>'ID Card Number or Password incorrect'],401);
        
    }


    public function logout(Request $request){
        // dd($request);   
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logout success'], 200);
    }
}
