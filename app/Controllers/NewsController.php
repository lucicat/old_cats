<?php 

namespace App\Controllers;
// use App\Models\NewsModel;

class NewsController extends Controller
{
    public function showNews($request, $response, $args)
    {
        return $this->view->render($response, 'news/news.twig');
    }
}