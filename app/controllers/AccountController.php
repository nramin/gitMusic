<?php
class AccountController extends BaseController {

	public function getLogin() {
		return View::make('login');
	}

	public function getCreate() {
		return View::make('signup');
	}
	
	public function postLogin() {
		$validator = Validator::make(Input::all(),
			array(
				'username' => 'required',
				'password' => 'required'
			)
		);
			
		if ($validator->fails()) {
			return Redirect::route('login-post')
					->withErrors($validator)
					->withInput();
		} else {
		
			$remember = (Input::has('remember')) ? true : false;
		
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
				//,'active' => 1
			), $remember);
			
			if ($auth) {
				// redirect to the intended page
				return Redirect::intended('/');
			} else {
				return Redirect::route('login-post')
				->with('global', 'Invalid credentials.') // or account not activated via active != 1
				->withInput();
			}
		
		}
		
		return Redirect::route('login-post')
				->with('global', 'There was a problem signing you in.');
	}
	
	public function getLogOut() {
		Auth::logout();
		return Redirect::route('home');
	}
	
	public function postCreate() {
		
		$validator = Validator::make(Input::all(),
			array(
				'username'  	 => 'required|min:3|max:20|unique:users',
				'email' 		 => 'email|max:254|unique:users', //NOT REQUIRED FOR DEBUGGING PURPOSES FOR NOW, MAKE IT REQUIRED LATER
				'password'		 => 'required|min:6|max:60',
				'password_again' => 'required|same:password'
			)
		);
		
		if ($validator->fails()) {
			return Redirect::route('signup-post')
					->withErrors($validator)
					->withInput();
		} else {
			
			$username = Input::get('username');
			$email	  = Input::get('email');
			$password = Input::get('password');
			
			// Activation code
			$code 	  = str_random(60); 
			
			$create_user = User::create(array(
				'username' => $username,
				'email' => $email,
				'password' => Hash::make($password),
				'temp_code' => $code,
				'is_active' => 'Y'
			));
			
			if ($create_user) {
			
				// send validation email later
			
				return Redirect::route('/')
					->with('global', 'Your account has been created! Sign in now!');
			}
		}
	}
	
	// public function getChangePassword() {
	// 	return View::make('account.password');
	// }

}