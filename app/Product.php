<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Product extends Model
	{
		protected $fillable = [
			'id',
			'sku',
			'product_name',
			'price',
			'client_price',
			'weight',
			'currency',
			'description',
			'product_um',
			'client_id',
			'default_img'
		];

		public function client()
		{
			return $this->belongsTo('App\Client');
		}

		public function invoice()
		{
			return $this->belongsToMany('App\Invoice');
		}

		public function images()
		{
			return $this->hasMany('App\Gallery');
		}
	}
