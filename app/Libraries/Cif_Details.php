<?php
	/**
	 * Created by PhpStorm.
	 * User: mihai
	 * Date: 7/28/2018
	 * Time: 10:24 PM
	 */

	namespace App\Libraries;


	class Cif_Details
	{
		public static function valid_cif($cif)
		{
			if (!is_int($cif)) {
				$cif = strtoupper($cif);
				if (strpos($cif, 'RO') === 0) {
					$cif = substr($cif, 2);
				}
				$cif = (int)trim($cif);
			}

			// daca are mai mult de 10 cifre sau mai putin de 6, nu-i valid
			if (strlen($cif) > 10 || strlen($cif) < 2) {
				return false;
			}
			// numarul de control
			$v = 753217532;

			// extrage cifra de control
			$c1 = $cif % 10;
			$cif = (int)($cif / 10);

			// executa operatiile pe cifre
			$t = 0;
			while ($cif > 0) {
				$t += ($cif % 10) * ($v % 10);
				$cif = (int)($cif / 10);
				$v = (int)($v / 10);
			}

			// aplica inmultirea cu 10 si afla modulo 11
			$c2 = $t * 10 % 11;

			// daca modulo 11 este 10, atunci cifra de control este 0
			if ($c2 == 10) {
				$c2 = 0;
			}
			return $c1 === $c2;
		}

		public static function get_details($cif = NULL)
		{
			if (is_null($cif)) {
				return FALSE;
			} else {
				/*$ch	= curl_init();

				curl_setopt($ch, CURLOPT_URL, "https://api.openapi.ro/api/companies/".$cif);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);

				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "x-api-key:  WLR2b7iyKWoktDsdsixSz9h5J54TBNrtmTsxwdD7Q_bbF3fZkA"
	));

				$response = curl_exec($ch);
				curl_close($ch);*/
				$response = '{"ultima_prelucrare":"2018-05-22","ultima_declaratie":"2018-05-17","tva_la_incasare":[],"tva":null,"telefon":"0740847048","stare":"INREGISTRAT din data 16 Mai 2016","radiata":false,"numar_reg_com":"J40/6938/2016","meta":{"updated_at":"2018-06-11T13:28:19.007121","last_changed_at":"2018-05-23T23:25:06.543929"},"judet":"Municipiul București","impozit_profit":null,"impozit_micro":"2016-05-17","fax":null,"denumire":"Alaskan Global Network S.R.L.","cod_postal":null,"cif":"36086038","adresa":"B-dul Basarabia, 256g, București, Sect 3","act_autorizare":null,"accize":null}';
				$response = json_decode($response);
				return $response;
			}
		}
	}