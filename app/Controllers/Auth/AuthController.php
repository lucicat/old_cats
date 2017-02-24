<?php 
	namespace App\Controllers\Auth;

	use App\Controllers\Controller;
	use App\Models\UserModel;
	use Respect\Validation\Validator as v;
	/*
	 * User autorized  
	 */
	class AuthController extends Controller 
	{

		public function postSignIn($request, $response)
		{
			
		}




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
			$validation = $this->validator->validate($request, [
				'email' 		=> v::noWhitespace()->notEmpty()->email()->emailAvailable(),
				'namecat' 	=> v::noWhitespace()->notEmpty()->alpha(), 
				'password' 	=> v::noWhitespace()->notEmpty(),
				'passwordagain' => v::noWhitespace()->notEmpty(),
				'weight'		=> v::noWhitespace()->notEmpty(),
				'sex'				=> v::noWhitespace()->notEmpty(),
				'breed'			=> v::noWhitespace()->notEmpty(),
				'years'			=> v::noWhitespace()->notEmpty(),
			]);

			if ($validation->failed()) {
				return $response->withRedirect($this->router->pathFor('auth.signup'));
			}

			$user = UserModel::create([
				'email' 		=> $request->getParam('email'),
				'name' 			=> $request->getParam('namecat'),
				'weight'		=> $request->getParam('weight'),
				'sex' 			=> $request->getParam('sex'),
				'breed'			=> $request->getParam('breed'),
				'years'			=> $request->getParam('years'),
				'password' 	=> password_hash($request->getParam('password'), PASSWORD_DEFAULT),
			]);

			return $response->withRedirect($this->router->pathFor('home'));
		}


	}

 ?>