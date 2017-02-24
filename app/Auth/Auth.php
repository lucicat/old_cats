<?php

namespace App\Auth;
use App\Models\UserModel;


class Auth 
{

	/**
	 * get user data from DB  
	 * @return resource user data
	 */
	public function user()
	{
		return UserModel::where('idcats', $_SESSION['user']);
	}


	/**
	 * check for authorization 
	 * @return boolean true if user authorizate
	 */
	public function check()
	{
		return isset($_SESSION['user']);
	}


	/**
	 *  grab user data 
	 *  compare them and return 
	 * @param  text $email    		email from form
	 * @param  text $password 		password from form
	 * @return boolean           	false = repeat signin
	 */
	public function attempt($email, $password)
	{
		// grab the user by email 
		$user = UserModel::where('email', $email)->first();

		if (!$user) {
			return false;
		}

		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->idcats;
			return true;
		}

		return false;
	}

	/**
	 * logout user, delet cookie
	 * @return boolean 
	 */
	public function signout()
	{
		if ($_SESSION['user']) {
			unset($_SESSION['user']);
			return true;
		}
		return false;
	}
}