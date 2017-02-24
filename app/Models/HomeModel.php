<?php 
	namespace App\Models;
	use \Illuminate\Database\Eloquent\Model;

	/**
	* HomeModel which use homecontroller 
	*/
	class HomeModel extends Model
	{
		/**
		 * identification table in MySQL 
		 * @var string
		 */
		protected $table = 'home_news';

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

	}
 ?>