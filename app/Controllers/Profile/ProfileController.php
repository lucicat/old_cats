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
		
		// return view
		return $this->view->render($response, 'fullcat/fullcat.twig');
	}

	public function showCat($request, $response, $cat)
	{
		$user = UserModel::where('idcats', $cat);
		if ($user->count() != 0) {
			$this->getCatStory(null, $cat);
			$this->environment->addGlobal('cat', $user->first());
			$this->environment->addGlobal('story', $this->story);
			return $this->view->render($response, 'fullcat/fullcat.twig');
		} else {
			return $response->withRedirect($this->router->pathFor('home'));
		}
	}

	public function getCatStory($id_story=null, $cat=null)
	{
		$this->environment = $this->view->getEnvironment();
		// get story..false if no
		$this->story = $this->getStory($id_story, $cat);
		// to know count story in our profile
		$count_stories = $this->countStory($cat);
		// $show_add_story = $this->auth->check() && $this->auth->user()->first()->idcats == $cat; 
		$this->environment->addGlobal('current', $this->story->idstories);
		// get pagination data, see SController->paginationStory(..)
		$this->paginationStory($count_stories, $this->story->idstories, $this->environment);
	}


	public function showCatWStory($request, $response, $args)
	{
		$cat = $args['cat'];
		$story = $args['story'];

		$user = UserModel::where('idcats', $cat);
		if ($user->count() != 0) {
			$this->getCatStory($story, $cat);
			$this->environment->addGlobal('cat', $user->first());
			$this->environment->addGlobal('story', $this->story);
			return $this->view->render($response, 'fullcat/fullcat.twig');
		} else {
			return $response->withRedirect($this->router->pathFor('home'));
		}
	}
}