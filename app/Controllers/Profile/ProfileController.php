<?php

namespace App\Controllers\Profile;
use App\Controllers\Profile\StoriesController as SController;
use App\Models\UserModel;
use App\Models\BreedModel;
/**
* 
*/
class ProfileController extends SController
{
    protected $environment;

    public function getBreeds()
    {
        $breeds = BreedModel::get();
        $breeds = $breeds ? $breeds : false;
        $this->environment->addGlobal('breeds', $breeds);
    }

    // this method without login is closed
    public function showProfile($request, $response)
    {
        $this->getCatStory();
        $this->getBreeds();
        // bind data in view
        
        $this->environment->addGlobal('cat', $this->auth->user()->first());
        $this->environment->addGlobal('story', $this->story);
        $this->environment->addGlobal('mainProfile', true);
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
            $this->getBreeds();
            $this->environment->addGlobal('cat', $user->first());
            $this->environment->addGlobal('story', $this->story);
            $this->environment->addGlobal('mainProfile', $this->checkForAuth($idcats));
            $this->urlPaginationStory();
            return $this->view->render($response, 'fullcat/fullcat.twig');
        } else {
            return $response->withRedirect($this->router->pathFor('home'));
        }
    }

    /**
     * bind into the view pagination urls 
     * @return [boolean] [description]
     */
    public function urlPaginationStory()
    {
        $this->environment->addGlobal('nextStory', $this->pagination->getNextUrl());
        $this->environment->addGlobal('prevStory', $this->pagination->getPrevUrl());
        return true;
    }
}