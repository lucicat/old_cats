<?php 

	namespace App\Middleware;

	/**
	* set CurrentPage
	* set QueryPage
	*/
	class PaginationMiddleware extends Middleware
	{
		public function __invoke($request, $response, $next) {
			$uri = $request->getUri();
			// unset page param from query
			$re = '/([0-9a-zA-Z=&]*)&(page=[0-9]{1,3})/';
			$str = $uri->getQuery();
			preg_match_all($re, $str, $matches);
			$query = $matches[1][0];
			$this->pagination->setPath($uri->getBaseUrl().'/'.$uri->getPath().'?'.$query);
			$this->pagination->setCurrentPage($request->getQueryParam('page'));
			return $next($request, $response);
		}
	}
