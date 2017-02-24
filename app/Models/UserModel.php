<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

/**
* Get user data from table users 
*/
class UserModel extends Model
{
	/**
		 * identification table in MySQL 
		 * @var string
		 */
		protected $table = 'cats';

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
			'name',
			'sex',
			'years',
			'password',
			'breed',
			'aboutme',
			'email',
			'weight'
		];
}