<?php 

namespace App\Controllers;
use App\Models\UserModel;

class CatsController extends Controller
{
    public function showCats($request, $response, $args)
    {
        return $this->view->render($response, 'cats/cats.twig');
    }
}