<?php 

namespace App\Controllers;
use App\Models\UserModel;
use App\Pagination\Pagination;
use App\Models\BreedModel;
class CatsController extends Controller
{

    private $fields = [
            'name'          => true,
            'sex'           => true,
            'from_age'      => true,
            'to_age'        => true,
            'breed'         => true,
            'weight_from'   => true,
            'weight_to'     => true
    ];

   private $fieldsFrom = [
            'from_age'      => 'years',
            'weight_from'   => 'weight',
    ];


   private $fieldsTo = [
            'to_age'        => 'years',
            'weight_to'     => 'weight'
    ];

    public function getBreeds()
    {
        $breeds = BreedModel::get();
        $breeds = $breeds ? $breeds : false;
        $this->environment->addGlobal('breeds', $breeds);
    }

    public function showCats($request, $response, $args)
    {
        $environment = $this->environment = $this->view->getEnvironment();
        $this->getBreeds();

        $this->pagination->setCountPerPage(10);
        $skip = $this->pagination->getSkip();
        $take = $this->pagination->getTake();


        $queries = array_filter($request->getQueryParams(), 
                                function ($v, $k) { 
                                    return $v != '' && array_key_exists($k, $this->fields); 
                                },
                                ARRAY_FILTER_USE_BOTH);


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

        $cats = $cats->get();
        $count_cats = $cats->count();
        $this->pagination->setCountElements($count_cats);

        $cats = $cats ? $cats : false;
        $this->environment->addGlobal('currentPage', $this->pagination->getCurrentPage());
        $this->environment->addGlobal('countPage', $this->pagination->getCountPage());
        $environment->addGlobal('oldqueries', $queries);
        $environment->addGlobal('cats', $cats);
        return $this->view->render($response, 'cats/cats.twig');

    }
}