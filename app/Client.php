<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Client extends Model
	{
		protected $fillable = [
			'id',
			'code',
			'company',
			'cif',
			'attr_fiscal',
			'reg',
			'address',
			'judet',
			'city',
			'zip',
			'contact_person',
			'phone',
			'email',
			'country',
			'iban',
			'banca',
			'logo',
			'user_id'
		];

		public function invoices()
		{
			return $this->hasMany('App\Invoice');
		}
	}
