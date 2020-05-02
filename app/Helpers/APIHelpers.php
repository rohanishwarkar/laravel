<?php
namespace App\Helpers;
 class APIHelpers{
	 public static function getResponse($is_error,$code,$message,$content){
		 $res = [];
		 $res['status'] = $is_error;
		 $res['code'] = $code;
		 $res['details']=$message;
		 $res['data'] = $content;
		 return $res;
	 }
 }