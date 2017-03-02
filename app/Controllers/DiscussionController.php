<?php

namespace App\Controllers;
use Respect\Validation\Validator as v;
use App\Models\BreedModel;
use App\Models\DiscussionModel;
use App\Pagination\Pagination;

/**
*   show a themes 
*   add a themes 
*/
class DiscussionController extends Controller
{
    protected $environment;

    /**
     * show all themes 
     * show form for add the theme(only for authorizate cat)
     * @param  Request $request  
     * @param  Response $response 
     * @return View           
     */
    public function getThemes($request, $response)
    {
        // pagination settings
        $this->environment = $this->view->getEnvironment();
        $this->pagination->setCountPerPage(8);
        $skip = $this->pagination->getSkip();
        $take = $this->pagination->getTake();


        $themes = DiscussionModel::skip($skip)
                                 ->take($take)
                                 ->get();
        $count_themes = $themes->count();

        $this->pagination->setCountElements($count_themes);
        $this->environment->addGlobal('all_themes', $count_themes);
        $this->environment->addGlobal('themes', $themes);
        $this->environment
             ->addGlobal('currentPage', $this->pagination->getCurrentPage());
        $this->environment
             ->addGlobal('countPage', $this->pagination->getCountPage());
        $this->environment->addGlobal('checkAuth', $this->auth->check());
        return $this->view->render($response, 'discussion/themes.twig');
    }


    /**
     * validate the data 
     * insert the data
     * redirect path_for(themes)
     * @param [type] $request  [description]
     * @param [type] $response [description]
     */
    public function addTheme($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'title'         => v::noWhitespace()->notEmpty(),
            'description'   => v::noWhitespace()->notEmpty(),
        ]);
        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('themes'));
        }

        DiscussionModel::create([
            'title'         => $request->getParam('title'),
            'description'   => $request->getParam('description'),
            'creater'       => $_SESSION['user'],
        ]);


        return $response->withRedirect($this->router->pathFor('themes'));
    }


}