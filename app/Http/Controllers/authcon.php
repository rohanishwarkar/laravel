<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
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
		 \Mail::to($user->email)->send(new VerificationEmail($user));
		//  session()->flash('message', 'Please check your email to activate your account');
		//  $access_token = $user->createToken('authToken')->accessToken;
		 return response(['message'=>'Check your mail for verification!']);
	 }

	 public function login(Request $request){
		$val_data = $request->validate([
			'email'=>'email|required',
			'password'=>'required'
		]);
		if(!auth()->attempt($val_data)){
			return response(['details'=>'Invalid Credentials']);
		}
		$user = User::where('email',$request->email)->first();
		if($user->email_verified_at != null){
			$token = auth()->user()->createToken('authToken')->accessToken;
			return response(['user'=>auth()->user(),'token'=>$token]);
		}
		return response(['details'=>'Verify Email first!']);
	 }
}
