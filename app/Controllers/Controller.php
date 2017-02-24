<?php
	namespace App\Controllers;
	/** 
	 * parent Controller which realize common functional 
	 * it allows child Controllers to pull containers short way..
	 * $this->{name container}->{other property...}->...
	 */
	class Controller {
		/*
		 * @var Container
		 */
		public $container;
		
		/*
		 * set container in Controller
		 * @param $container Container 
		 * @return void
		 */
		public function __construct($container) 
		{
			$this->container = $container;
		}
		/*
		 * not write example: $this->container->view
		 * @param container name
		 * @return instance container 
		 */
		public function __get($name) 
		{
			return $this->container->{$name};
		}
	}
?>