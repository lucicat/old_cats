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
        $this->countNews();
        $this->environment->addGlobal('news', $news);
        $this->environment->addGlobal('currentPage', $this->pagination->getCurrentPage());
        $this->environment->addGlobal('countPage', $this->pagination->getCountPage());
        return $this->view->render($response, 'news/news.twig');

    }
    /**
     * counting all news for view pagination
     * @return [type] [description]
     */
    public function countNews()
    {
        $count = NewsModel::select('*')
                          ->count();
        $this->pagination->setCountElements($count);
        return $count;
    }


    public function showFullNews($request, $response, $args)
    {
        $id_news  = $args['id_news'];
        $new_item = NewsModel::where('idnews', $id_news)
                             ->first();
        $item = $new_item ? $new_item : 0;
        $this->view->getEnvironment()->addGlobal('item', $item);
        return $this->view->render($response, 'news/fullnews.twig'); 
    }
}