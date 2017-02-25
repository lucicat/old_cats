<?php

namespace App\Controllers\Profile;
use App\Controllers\Controller;
use App\Models\StoriesModel;
/**
* 
*/
class StoriesController extends Controller
{

	protected function getStory($id_story=null, $cat=null)
	{
		// if our profile, than $cat are we
		$cat = !$cat ? $_SESSION['user'] : $cat;

		// get with id_story
		if ($id_story) {
			$story = StoriesModel::where('id_cat', $cat)
													 ->where('idstories', $id_story)->first();
			return $story ? $story : false;
		} else {
			$story = StoriesModel::where('id_cat', $cat)->first();
			return $story ? $story : false;
		}
	}


	protected function countStory($cat)
	{
		// if our profile, than $cat are we
		$cat = !$cat ? $_SESSION['user'] : $cat;

		$count = StoriesModel::where('id_cat', $cat)->count();
		return $count ? $count : false;
	}

	protected function paginationStory($count, $current, $environment)
	{
		$environment->addGlobal('right', ($current + 1) <= $count);
		$environment->addGlobal('left', ($current - 1) >= 1);
		return true;
	}
}
	
	// profile/2/1/(addstory/|delstory/|editstory)/(edituser)
		// true если нет значения - выдать первую историю 
	// true записать полученное значение
	// true посчитать истории
		// true если нет, то ничего не возвращать
	// получить запрошенную историю 
	// если нет запрошенной, то выдать первую
	// проверить, есть ли следующая и предыдущая история 
	// записать их в вид..