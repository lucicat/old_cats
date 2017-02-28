<?php 

 namespace App\Controllers\Pagination;

 class Pagination {
    /**
     * count elements on page 
     * @var integer
     */
    protected $countPerPage = 1;

    /**
     * count all elements from Dc
     * @var [integer]
     */
    protected $countFromDB;

    /**
     * query for binding in query
     * @var [type]
     */
    protected $query;

    /**
     * page from get guery on page
     * @var integer
     */
    protected $currentPage = 1;

    public $nextPage;
    public $preventPage;

    /**
     * Determine if the given value is a valid page number 
     * @param  [type]  $page [description]
     * @return boolean       [description]
     */
    public function isValidPageNumber($page) 
    {
        return $page >= 1 &&  filter_var($page, FILTER_VALIDATE_INT) !== false;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return true;
    }

    public function setCurrentPage($current)
    {
        $this->currentPage = isValidPageNumber($current) ? $current : 1;
        return true;
    }

    // set countPerPage (in controller) 
    // set countFromDB 
        // quantity fromdb/countPerPage
        // = quantity pagination link 
        // 
    

    // create middleware PaginationMiddleware
    // -> setParamPage()
    // -> setQuery()
    // - which will be get page param 
    // - get current query 

 }