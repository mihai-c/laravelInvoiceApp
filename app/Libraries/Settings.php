<?php
	/**
	 * Created by PhpStorm.
	 * User: mihai
	 * Date: 8/1/2018
	 * Time: 9:22 PM
	 */

	namespace App\Libraries;

	use App\Setting;
	use Illuminate\Support\Facades\DB;

	class Settings
	{

		public static function get_value($key = Null)
		{
			if (is_null($key)) {
				return false;
			}
			$value = Setting::where('config_key', $key)->first();
			if ($value) {
				return $value;
			} else {
				return false;
			}
		}

		public static function get_all_values()
		{
			$settings = Setting::all();
			return $settings;
		}

		public static function get_invoice_number()
		{
			$options = '';
			$serial_list = DB::table('config_docs')->where('tip_document', '=', 'factura')
				->orderByDesc('default_document')->get();
			foreach ($serial_list as $serial) {
				$next = DB::table('invoices')
					->where('invoice_serial', $serial->serie_document)
					->orderByDesc('invoice_number')
					->first();
				if (!$next) {
					$number = $serial->numar_document;
				} else {
					if ($next->invoice_number[0] == '0') {
						$pad = strlen($next->invoice_number);
						$number = $next->invoice_number + 1;
						$number = str_pad($number, $pad, '0', STR_PAD_LEFT);
					} else {
						$number = $next->invoice_number + 1;
					}
				}
				$selected = $serial->default_document == 1 ? "selected" : " ";
				$options .= '<option value="' . $serial->serie_document . '|' . $number . '" ' . $selected . '>
            ' . $serial->serie_document . ' ' . $number . '</option>';
			}

			return $options;
		}

	}