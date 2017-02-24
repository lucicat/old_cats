<?php

namespace App\Controllers\Profile;
use App\Controllers\Profile\StoriesController as SController;

/**
* 
*/
class ProfileController extends SController
{
	public function showProfile($request, $response)
	{
		$this->view->getEnvironment()->addGlobal('cat', $this->auth->user()->first());
		return $this->view->render($response, 'fullcat/fullcat.twig');
		// $name = $this->auth->user()->first()->name;
		// $years = $this->auth->user()->first()->years;
		// $sex = $this->auth->user()->first()->sex;
		// $weight = $this->auth->user()->first()->weight;
		// $about = $this->auth->user()->first()->aboutme;

	}
}