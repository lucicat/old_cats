<?php
    $app->get('/', 'HomeController:sayHello')->setName('home');
    
    //auth routes
    $app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $app->post('/auth/signup', 'AuthController:postSignUp');
    $app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $app->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin');

    /////////////////////
    //profile routes
    //
    $app->get('/profile', 'ProfileController:showProfile')
        ->setName('profile.show')
        ->add(new \App\Middleware\PaginationMiddleware($container))
        ->add(new \App\Middleware\GuestMiddleware($container));

    $app->post('/profile/addstory', 'StoriesController:addStory')
        ->setName('add.story')
        ->add(new \App\Middleware\GuestMiddleware($container));

    $app->get('/profile/{cat}', 'ProfileController:showCat')
        ->setName('profile.show.cat')
        ->add(new \App\Middleware\PaginationMiddleware($container));

    // $app->get('/profile/{cat}/{story}/addstory', 'ProfileController:addStory')
    //      ->setName('cat.add.story');
    
    $app->post('/profile/{cat}/{story}/addstory', 'ProfileController:postAddStory');

    // end profile routes
    /////////////////////////



    $app->get('/cats', 'CatsController:showCats')
        ->add(new \App\Middleware\PaginationMiddleware($container));
    $app->get('/cats/search', 'CatsController:searchCats')
        ->setName('search.cats')
        ->add(new \App\Middleware\PaginationMiddleware($container));

    ///////////////
    // news routes
    $app->get('/news', 'NewsController:showNews')
        ->setName('show.news')
        ->add(new \App\Middleware\PaginationMiddleware($container));
    $app->get('/news/{id_news}', 'NewsController:showFullNews');
    ///////////////////
    ///
    $app->get('/contacts', 'ContactsController:showContacts')->setName('contacts');
    $app->post('/contacts', 'ContactsController:sendMessage')->setName('contacts');


 ?>