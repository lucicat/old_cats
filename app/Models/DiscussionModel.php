<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

/**
* Get user data from table users 
*/
class DiscussionModel extends Model
{
    /**
         * identification table in MySQL 
         * @var string
         */
        protected $table = 'discussions';

        /**
         * Indicates if need use timestamps
         * @var boolean
         */
        public $timestamps = true;

        /**
         * connection name for the model 
         * @var string
         */
        //public $connection = 'connection_name';
    

        /**
         * set column for create row
         */
        protected $fillable = [
            'title',
            'creater',
            'count_cats',
            'description'
        ];
}
