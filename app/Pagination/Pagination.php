<?php 

 namespace App\Pagination;

 class Pagination {
    /**
     * count elements on page 
     * @var integer
     */
    protected $countPerPage = 1;

    /**
     * path our uri
     * @var [string]
     */
    protected $path; 
    /**
     * count all elements from Dc
     * @var int
     */
    protected $countFromDB;

    /**
     * for binding in query
     * @var string
     */
    protected $query;

    /**
     * page from get guery on page
     * @var integer
     */
    protected $currentPage = 1;

    /**
     * generate next and prev url for pagination
     * @var [type]
     */
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


    /**
     * counts elements from db 
     * @param [int] $count 
     */
    public function setCountElements($count)
    {
        $this->countFromDB = $count;
        return true;
    }

    /**
     * count the pages which we have from sql query
     * @return [type] [description]
     */
    public function getCountPage()
    {
        return ceil($this->countFromDB / $this->countPerPage);
    }

    /**
     * set path for not to forget the search params 
     * @param [string] $path /profile/4
     */
    public function setPath($path)
    {
        $this->path = $path;
        return true;
    }

    /**
     * set current page from query
     * @param [int] $current page={somenumber}
     */
    public function setCurrentPage($current)
    {
        $this->currentPage = $this->isValidPageNumber($current) ? $current : 1;
        return true;
    }

    /**
     * get count the elements which we need to skip 
     * @return [int] count skip element
     */
    public function getSkip()
    {
        return $this->currentPage == 1 ? 0 : $this->currentPage * $this->countPerPage - 1;
    }

    /**
     * get count elements which we need to take
     * @return [int] count the elements on the page
     */
    public function getTake()
    {
        return $this->countPerPage;
    }

    /**
     * get url for next page
     * @return [type] [description]
     */
    public function getNextUrl()
    {
        if ($this->currentPage + 1 <= $this->getCountPage()) {
            return $this->path.'&page='.($this->currentPage + 1);
        } else {
            return false;
        }
    }

    public function getPrevUrl()
    {
        if ($this->currentPage - 1 > 0) {
            return $this->path.'&page='.($this->currentPage - 1);
        } else {
            return false;
        }
    }


 }