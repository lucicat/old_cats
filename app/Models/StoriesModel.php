<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

/**
* Get user data from table users 
*/
class StoriesModel extends Model
{
	/**
		 * identification table in MySQL 
		 * @var string
		 */
		protected $table = 'stories';

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
			'content',
			'id_cat',
		];
}