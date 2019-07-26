<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Invoice extends Model
	{
		protected $fillable = [
			'id',
			'invoice_serial',
			'invoice_number',
			'invoice_total',
			'invoice_currency',
			'exchange_currency',
			'exchange_rate',
			'invoice_comments',
			'invoice_notes',
			'invoice_date',
			'payment_date',
			'invoice_status',
			'client_name',
			'client_name',
			'client_id',
			'client_cif',
			'client_reg',
			'client_iban',
			'client_banca',
			'client_address',
			'client_judet',
			'client_city',
			'client_zip',
			'client_email',
			'invoice_issuer',
			'invoice_delegat',
			'delegat_cnp',
			'delegat_ci',
			'invoice_shipping_number',
			'delivery_car',
			'shipping_on',
			'shipping_at'
		];

		public function client()
		{
			return $this->belongsTo('App\Client');
		}
	}
