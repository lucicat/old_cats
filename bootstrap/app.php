<?php
	session_start();
	
	// include configuration file..
	require '../app/config.php';

	// load our Slim\App in $app
	$app = new \Slim\App($config);

	// get routes
	require '../app/routes.php';

	// get container, where will be save our modyles
	$container = $app->getContainer();

	// set global capsule illuminate ORM by laravel 
	$capsule = new \Illuminate\Database\Capsule\Manager;
	$capsule->addConnection($container['settings']['db']);
	$capsule->setAsGlobal();
	$capsule->bootEloquent();


	// get DB 
	$container['db'] = function ($container) use ($capsule) {
		return $capsule;
	};

	$container['validator'] = function ($container) {
		return new App\Validation\Validator;
	};
	
	
	// injection twig template manager 
	$container['view'] = function ($container) {
		$view = new \Slim\Views\Twig(realpath('../resources/view/'), [
			'cache' => false
		]);

		$view->addExtension(new \Slim\Views\TwigExtension(
			$container->router,
			$container->request->getUri()
		));

		return $view;
	};
	$app->add(new \App\Middleware\ValidationMiddleware($container));

	// set HomeController 
	$container['HomeController'] = function ($container) {
		return new App\Controllers\HomeController($container);
	};

	// set AuthController 
	$container['AuthController'] = function ($container) {
		return new App\Controllers\Auth\AuthController($container);
	};

	// initialize our application
	$app->run();


?>