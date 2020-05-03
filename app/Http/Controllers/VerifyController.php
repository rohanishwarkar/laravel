<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

class VerifyController extends Controller
{
	public function VerifyEmail($token = null)
	{
		if($token == null) {

			// session()->flash('message', 'Invalid Login attempt');

			// return redirect()->route('login');
			return response(['details'=>'Invalid Credentials']);

		}

		$user = User::where('email_verification_token',$token)->first();

		if($user == null ){

			return response(['details'=>'Invalid Token']);

		}

		$user->update([
		 'email_verified_at' => Carbon::now(),
		 'email_verification_token' => ''

		]);
		
		return response(['details'=>'Correct Login']);

	}
}
