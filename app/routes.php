<?php
	$app->get('/', 'HomeController:sayHello')->setName('home');
	$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
	$app->post('/auth/signup', 'AuthController:postSignUp');
 ?>