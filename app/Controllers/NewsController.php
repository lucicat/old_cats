<?php 

namespace App\Controllers;
use App\Models\NewsModel;
use App\Pagination\Pagination;

class NewsController extends Controller
{
    public function showNews($request, $response, $args)
    {
        $this->environment = $this->view->getEnvironment();
        $this->pagination->setCountPerPage(5);
        $skip = $this->pagination->getSkip();
        $take = $this->pagination->getTake();
        $news = NewsModel::select('*')
                         ->skip($skip)
                         ->take($take)
                         ->get();
        $news = $news ? $news : false;
        $this->environment->addGlobal('news', $news);
        return $this->view->render($response, 'news/news.twig');

    }


    public function showFullNews($request, $response, $args)
    {
        return; 
    }
}