<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

/**
* Get user data from table users 
*/
class MessageModel extends Model
{
    /**
         * identification table in MySQL 
         * @var string
         */
        protected $table = 'messages';

        /**
         * Indicates if need use timestamps
         * @var boolean
         */
        public $timestamps = false;

        /**
         * connection name for the model 
         * @var string
         */
        //public $connection = 'connection_name';
    

        /**
         * set column for create row
         */
        protected $fillable = [
            'content',
            'cat',
            'discussion',
            'created_at'
        ];
}
