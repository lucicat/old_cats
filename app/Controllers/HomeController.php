<?php 
	namespace App\Controllers;
	use App\Controllers\Controller;
	use App\Models\HomeModel;
	use App\Models\UserModel;
	/*
	 * Class which show home page 
	 */
	class HomeController extends Controller 
	{
		/**
		 * Select first row from table home_news 
		 * and transfer it to twig view
		 * @param $request
		 * @param $response
		 * @return  View compilating homepage.twig 
		 **/
		public function sayHello($request, $response) 
		{
			$home_page_data = UserModel::where('email', 'kitt@er.ru')->first();
			return $this->view->render( $response, 'homepage.twig');
		}
	}

 ?>