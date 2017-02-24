<?php
	$app->get('/', 'HomeController:sayHello')->setName('home');
	
	//auth routes
	$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$app->post('/auth/signup', 'AuthController:postSignUp');
	$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	$app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin');

	//profile routes
	$app->get('/profile', 'ProfileController:showProfile')->setName('profile.show');
 ?>