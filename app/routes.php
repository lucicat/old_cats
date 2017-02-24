<?php
	$app->get('/', 'HomeController:sayHello')->setName('home');
	$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$app->post('/auth/signup', 'AuthController:postSignUp');
	$app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
	$app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin');
 ?>