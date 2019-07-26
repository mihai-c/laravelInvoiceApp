<?php
	/**
	 * Created by PhpStorm.
	 * User: mihai
	 * Date: 8/21/2018
	 * Time: 12:30 PM
	 */

	namespace App\Libraries;

	use App\Client;


	class Clients
	{
		public static function get_list()
		{
			$list = Client::all();
			return $list;
		}

	}