<?php

namespace App\Controllers\Profile;
use App\Controllers\Profile\StoriesController as SController;
use App\Models\UserModel;
/**
* 
*/
class ProfileController extends SController
{
    protected $environment;

    // this method without login is closed
    public function showProfile($request, $response)
    {
        $this->getCatStory();
        // bind data in view
        $this->environment->addGlobal('cat', $this->auth->user()->first());
        $this->environment->addGlobal('story', $this->story);
        $this->urlPaginationStory();
        
        // return view
        return $this->view->render($response, 'fullcat/fullcat.twig');
    }

    /**
     * show certain cat /profile/{id cat}
     * @param  [type] $request  [description]
     * @param  [type] $response [description]
     * @param  [type] $cat      id cat 
     * @return response         [description]
     */
    public function showCat($request, $response, $args)
    {
        $idcats = $args['cat'];
        $user = UserModel::where('idcats', $idcats);
        if ($user->count() != 0) {
            $this->getCatStory($idcats);
            $this->environment->addGlobal('cat', $user->first());
            $this->environment->addGlobal('story', $this->story);
            $this->urlPaginationStory();
            return $this->view->render($response, 'fullcat/fullcat.twig');
        } else {
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }

    public function urlPaginationStory()
    {
        $this->environment->addGlobal('nextStory', $this->pagination->getNextUrl());
        $this->environment->addGlobal('prevStory', $this->pagination->getPrevUrl());
    }
}