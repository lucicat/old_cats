<?php

namespace App\Controllers\Profile;
use App\Controllers\Controller;
use App\Models\StoriesModel;
use App\Controllers\Pagination; 
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