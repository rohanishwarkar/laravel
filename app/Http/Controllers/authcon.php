<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\User;
use App\VerifyUser;

class authcon extends Controller
{
    public function registerr(Request $request){
		 $val_data = $request->validate([
			 'name'=>'required|max:55',
			 'email'=>'email|required',
			 'password'=>'required|confirmed'
		 ]);

		 $val_data['password'] = bcrypt($request->password);
		//  $val_data['email_verification_token'] = sha1(time());
		//  print_r($val_data);
		 $user = User::create($val_data);
		 $verifyUser = VerifyUser::create([
			'user_id' => $user->id,
			'token' => sha1(time())
		 ]);
		 \Mail::to($user->email)->send(new VerificationEmail($user));
		//  session()->flash('message', 'Please check your email to activate your account');
		//  $access_token = $user->createToken('authToken')->accessToken;
		 return response(['message'=>'Check your mail for verification!']);
	 }

	 public function loginn(Request $request){
		$val_data = $request->validate([
			'email'=>'email|required',
			'password'=>'required'
		]);
		if(!auth()->attempt($val_data)){
			return response(['details'=>'Invalid Credentials']);
		}
		$user = User::where('email',$request->email)->first();
		if($user->verified == 1){
			$token = auth()->user()->createToken('authToken')->accessToken;
			return response(['user'=>auth()->user(),'token'=>$token]);
		}
		return response(['details'=>'Verify Email first!']);
	 }
}
