<?php
    use Respect\Validation\Validator as v;
    session_start();
    
    // include configuration file..
    require '../app/config.php';

    // load our Slim\App in $app
    $app = new \Slim\App($config);

    
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

    // set validator controller
    $container['validator'] = function ($container) {
        return new App\Validation\Validator;
    };

    // set pagination class 
    $container['pagination'] = function ($container) {
        return new App\Pagination\Pagination;
    };
    

    $container['auth'] = function ($container) {
        return new \App\Auth\Auth;
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

        $view->getEnvironment()->addGlobal('auth', [
            'check' => $container->auth->check(),
            'user' => $container->auth->user()
        ]);

        return $view;
    };
    $app->add(new \App\Middleware\ValidationMiddleware($container));
    $app->add(new \App\Middleware\OldInputMiddleware($container));
    v::with('App\\Validation\\Rules\\');


    $container['CatsController'] = function ($container) {
        return new App\Controllers\CatsController($container);
    };      

    $container['NewsController'] = function ($container) {
        return new App\Controllers\NewsController($container);
    };  

    
    ////////////////////////////////////////////////////////
    $container['ProfileController'] = function ($container) {
        return new App\Controllers\Profile\ProfileController($container);
    };

    $container['StoriesController'] = function ($container) {
        return new App\Controllers\Profile\StoriesController($container);
    };
    ///////////////////////////////////////////////////////////

    $container['ContactsController'] = function ($container) {
        return new App\Controllers\ContactsController($container);
    };

    $container['HomeController'] = function ($container) {
        return new App\Controllers\HomeController($container);
    };

    $container['AuthController'] = function ($container) {
        return new App\Controllers\Auth\AuthController($container);
    };    

    $container['DiscussionController'] = function ($container) {
        return new App\Controllers\DiscussionController($container);
    };

    $container['MessageController'] = function ($container) {
        return new App\Controllers\MessageController($container);
    };



    // get routes
    require '../app/routes.php';

    // initialize our application
    $app->run();


?>