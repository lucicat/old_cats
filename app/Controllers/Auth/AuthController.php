<?php 
	namespace App\Controllers\Auth;

	use App\Controllers\Controller;
	use App\Models\UserModel;
	/*
	 * User autorized  
	 */
	class AuthController extends Controller 
	{


		public function getSignUp($request, $response) 
		{
			return $this->view->render($response, 'auth/signup.twig');
		}

		/**
		 * Register user and redirect at home page..
		 * @param  Request $request  
		 * @param  Response $response 
		 * @return render view with twig 
		 */
		public function postSignUp($request, $response) 
		{

			$user = UserModel::create([
				'name' 			=> $request->getParam('name'),
				'last_name' => $request->getParam('last_name'),
				'email' 		=> $request->getParam('email'),
				'password' 	=> password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			]);

			return $response->withRedirect($this->router->pathFor('home'));
		}


	}

 ?>