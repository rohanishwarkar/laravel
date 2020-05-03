<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\VerifyUser;

class VerifyController extends Controller
{
	public function VerifyEmail($token = null)
	{

		$verifyUser = VerifyUser::where('token', $token)->first();
		if(isset($verifyUser) ){
			$user = $verifyUser->user;
			if(!$user->verified) {
				$verifyUser->user->verified = 1;
				$verifyUser->user->save();
				$status = "Your e-mail is verified. You can now login.";
			} else {
				$status = "Your e-mail is already verified. You can now login.";
			}
		} else {
			$status = 'Unknown Email';
			
		}
		return response(['details'=>$status]);
	}
}
