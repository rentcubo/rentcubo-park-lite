<?php

namespace App\Helpers;

use Hash, Exception, Auth, Mail, File, Log, Storage, Setting, DB; 

class Helper {

	/**
	 * @method clean()
	 * 
	 * @uses To replace spaces in string with '-'
	 *
	 * @created Anjana H
	 *
	 * @updated Anjana H
	 *
	 * @param string
	 *
	 * @return string
	 *
	 */
	public static function clean($string) {

	    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	/**
	 * @method generate_token()
	 * 
	 * @uses To genearate token
	 *
	 * @created Anjana H
	 *
	 * @updated Anjana H
	 *
	 * @param Null
	 *
	 * @return token string
	 *
	 */
	public static function generate_token() {
	    
	    return Helper::clean(Hash::make(rand() . time() . rand()));
	}

	/**
	 * @method generate_token_expiry()
	 * 
	 * @uses To genearate token expiry
	 *
	 * @created Anjana H
	 *
	 * @updated Anjana H
	 *
	 * @param Null
	 *
	 * @return token string
	 *
	 */
	public static function generate_token_expiry() {

	    $token_expiry_hour = Setting::get('token_expiry_hour') ?: 1;
	    
	    return time() + $token_expiry_hour*3600;  // 1 Hour
	}

}