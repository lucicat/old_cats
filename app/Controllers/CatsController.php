<?php 

namespace App\Controllers;
use App\Models\UserModel;
use App\Pagination\Pagination;
use App\Models\BreedModel;

class CatsController extends Controller
{
    /**
     * the fields which we need
     * @var array
     */
    private $fields = [
            'name'          => true,
            'sex'           => true,
            'from_age'      => true,
            'to_age'        => true,
            'breed'         => true,
            'weight_from'   => true,
            'weight_to'     => true
    ];

    /**
     * fields from input
     * @var array
     */
    private $fieldsFrom = [
            'from_age'      => 'years',
            'weight_from'   => 'weight',
    ];

    /**
     * fields to input
     * @var array
     */
    private $fieldsTo = [
            'to_age'        => 'years',
            'weight_to'     => 'weight'
    ];

    /**
     * get list breeds 
     * @return true 
     */
    public function getBreeds()
    {
        $breeds = BreedModel::get();
        $breeds = $breeds ? $breeds : false;
        $this->environment->addGlobal('breeds', $breeds);
        return true;
    }

    /**
     * show cats
     * - get list of the breeds 
     * - set the pagination's settings 
     * - filter our query for empty and need* 
     * - generate the query to the DB 
     * - 
     * @param  Request  $request  
     * @param  Response $response 
     * @param  array    $args     
     * @return view           
     */
    public function showCats($request, $response, $args)
    {
        $environment = $this->environment = $this->view->getEnvironment();
        $this->getBreeds();

        $queries = array_filter($request->getQueryParams(), 
                                function ($v, $k) { 
                                    return $v != '' && array_key_exists($k, $this->fields); 
                                },
                                ARRAY_FILTER_USE_BOTH);
        // set the pagination settings 
        $this->pagination->setCountPerPage(10);
        $skip = $this->pagination->getSkip();
        $take = $this->pagination->getTake();
        
        // generate the query 
        $cats = UserModel::skip($skip);
        $cats->take($take);
        foreach ($queries as $key => $value) {
            if (array_key_exists($key, $this->fieldsFrom)) {
                $cats->where($this->fieldsFrom[$key], '>=', $value);
            } else if (array_key_exists($key, $this->fieldsTo)) {
                $cats->where($this->fieldsTo[$key], '<=', $value);
            } else {
                $cats->where($key, $value);
            }
        }
        // get the resault and count it
        $cats = $cats->get();
        $count_cats = $cats->count();
        $cats = $cats ? $cats : false;
        
        // bind our data
        $this->pagination->setCountElements($count_cats);
        $this->environment->addGlobal('currentPage', $this->pagination->getCurrentPage());
        $this->environment->addGlobal('countPage', $this->pagination->getCountPage());
        $environment->addGlobal('oldqueries', $queries);
        $environment->addGlobal('cats', $cats);
        return $this->view->render($response, 'cats/cats.twig');

    }
}