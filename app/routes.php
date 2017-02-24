<?php
	$app->get('/', 'HomeController:sayHello')->setName('home');
	$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$app->get('/auth/signout', 'AuthController:getSignOut');
	$app->post('/auth/signup', 'AuthController:postSignUp');
	$app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin');
 ?>