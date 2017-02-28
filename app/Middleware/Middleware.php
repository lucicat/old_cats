<?php 

namespace App\Middleware;

class Middleware 
{
	public $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	public function __get($name)
	{
		return $this->container->{$name};
	}
}