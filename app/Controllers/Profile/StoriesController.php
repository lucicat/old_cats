<?php

namespace App\Controllers\Profile;
use App\Controllers\Controller;
use App\Models\StoriesModel;
use App\Controllers\Pagination; 
use Respect\Validation\Validator as v;

/**
* 
*/
class StoriesController extends Controller
{

    protected function getStory($cat=null)
    {
        // if our profile, than $cat are we
        $cat = $cat === null ? $_SESSION['user'] : $cat;
        $skip = $this->pagination->getSkip();
        $take = $this->pagination->getTake(); 
        
        $story = StoriesModel::where('id_cat', $cat)
                             ->skip($skip)
                             ->take($take)
                             ->first();
        return $story ? $story : false;
    }

    /**
     * show or no add fields
     * @param  int $cat from get 
     * @return bool      
     */
    protected function checkForAuth($cat)
    {
        return (int)$_SESSION['user'] == (int)$cat;
    }

    /**
     * add cat's story 
     * validation 
     * set in db 
     * @param [Request] $request  [description]
     * @param [Response] $response [description]
     */
    public function addStory($request, $response)
    {
        $validation = $this->validator->validate($request, [
            'title'     => v::notEmpty(),
            'content'   => v::notEmpty()
        ]);

        if ($validation->failed()) {
           return $response->withRedirect($this->router->pathFor('profile.show'));
        }

        $user = StoriesModel::create([
            'title'         => $request->getParam('title'),
            'content'       => $request->getParam('content'),
            'id_cat'        => $_SESSION['user']
        ]);

        return $response->withRedirect($this->router->pathFor('profile.show'));
    }

    /**
    * get view environment for subsequent binding
    * get story 
    * get count stories 
    * @param  [type] $id_story [description]
    * @param  [type] $cat      [description]
    * @return [type]           [description]
    */
    function getCatStory($cat = null)
    {
        $this->environment = $this->view->getEnvironment();
        $this->countStory($cat);
        $this->story = $this->getStory($cat);
    }


     protected function countStory($cat)
     {
     // if our profile, than $cat are we
        $cat = !$cat ? $_SESSION['user'] : $cat;

        $count = StoriesModel::where('id_cat', $cat)->count();
        $this->pagination->setCountElements($count);
        return $count ? $count : false;
    }
  
    // profile/2/1/(addstory/|delstory/|editstory)/(edituser)
}