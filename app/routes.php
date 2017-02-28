<?php
    $app->get('/', 'HomeController:sayHello')->setName('home');
    
    //auth routes
    $app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $app->post('/auth/signup', 'AuthController:postSignUp');
    $app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin');

    /////////////////////
    //profile routes
    $app->get('/profile', 'ProfileController:showProfile')
        ->setName('profile.show')
        ->add(new \App\Middleware\PaginationMiddleware($container))
        ->add(new \App\Middleware\GuestMiddleware($container));

    $app->get('/profile/{cat}', 'ProfileController:showCat')
        ->setName('profile.show.cat')
        ->add(new \App\Middleware\PaginationMiddleware($container));

    // $app->get('/profile/{cat}/{story}', 'ProfileController:showCatWStory')
    //     ->setName('cat.with.story')
    //     ->add(new \App\Middleware\PaginationMiddleware($container));

    // $app->get('/profile/{cat}/{story}/addstory', 'ProfileController:addStory')
    //      ->setName('cat.add.story');
    
    $app->post('/profile/{cat}/{story}/addstory', 'ProfileController:postAddStory');

    // end profile routes
    /////////////////////////



    $app->get('/cats', function () {
        echo 'some test';
        die();
    })->add(new \App\Middleware\PaginationMiddleware($container));

 ?>