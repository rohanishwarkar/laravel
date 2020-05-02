<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class authcon extends Controller
{
    public function register(Request $request){
		 $val_data = $request->validate([
			 'name'=>'required|max:55',
			 'email'=>'email|required',
			 'password'=>'required|confirmed'
		 ]);

		 $val_data['password'] = bcrypt($request->password);
		 $user = User::create($val_data);
		 $access_token = $user->createToken('authToken')->accessToken;
		 return response(['user'=>$user,'access'=>$access_token]);
	 }

	 public function login(Request $request){
		$val_data = $request->validate([
			'email'=>'email|required',
			'password'=>'required'
		]);
		if(!auth()->attempt($val_data)){
			return response(['details'=>'Invalid Credentials']);
		}
		$token = auth()->user()->createToken('authToken')->accessToken;
		return response(['user'=>auth()->user(),'token'=>$token]);
	 }
}
