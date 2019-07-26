<?php
	/**
	 * Created by PhpStorm.
	 * User: mihai
	 * Date: 7/28/2018
	 * Time: 10:37 PM
	 */

	namespace App\Libraries;


	class CNP_Validator
	{
		public static function cnp($value)
		{
			// CNP must have 13 characters
			if (strlen($value) != 13) {
				return FALSE;
			}
			$cnp = str_split($value);
			unset($value);
			$hashTable = array(2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9);
			$hashResult = 0;
			// All characters must be numeric
			for ($i = 0; $i < 13; $i++) {
				if (!is_numeric($cnp[$i])) {
					return false;
				}
				$cnp[$i] = (int)$cnp[$i];
				if ($i < 12) {
					$hashResult += (int)$cnp[$i] * (int)$hashTable[$i];
				}
			}
			unset($hashTable, $i);
			$hashResult = $hashResult % 11;
			if ($hashResult == 10) {
				$hashResult = 1;
			}
			// Check Year
			$year = ($cnp[1] * 10) + $cnp[2];
			switch ($cnp[0]) {
				case 1  :
				case 2 :
					{
						$year += 1900;
					}
					break; // cetateni romani nascuti intre 1 ian 1900 si 31 dec 1999
				case 3  :
				case 4 :
					{
						$year += 1800;
					}
					break; // cetateni romani nascuti intre 1 ian 1800 si 31 dec 1899
				case 5  :
				case 6 :
					{
						$year += 2000;
					}
					break; // cetateni romani nascuti intre 1 ian 2000 si 31 dec 2099
				case 7  :
				case 8 :
				case 9 :
					{                // rezidenti si Cetateni Straini
						$year += 2000;
						if ($year > (int)date('Y') - 14) {
							$year -= 100;
						}
					}
					break;
				default :
					{
						return false;
					}
					break;
			}
			return ($year > 1800 && $year < 2099 && $cnp[12] == $hashResult);
		}

		public static function cnp_details($cnp)
		{
			$data = array(
				'cif' => $cnp,
				'denumire' => '',
				'numar_reg_com' => '',
				'adresa' => '',
				'telefon' => '',
				'city' => '',
			);
			$cod_judet = substr($cnp, 7, 2);

			switch ($cod_judet) {
				case 01:
					$judet = 'Alba';
					break;
				case 02:
					$judet = 'Arad';
					break;
				case 03:
					$judet = 'Arges';
					break;
				case 04:
					$judet = 'Bacau';
					break;
				case 05:
					$judet = 'Bihor';
					break;
				case 06:
					$judet = 'Bistrita-Nasaud';
					break;
				case 07:
					$judet = 'Botosani';
					break;
				case 08:
					$judet = 'Brasov';
					break;
				case 09:
					$judet = 'Braila';
					break;
				case 10:
					$judet = 'Buzau';
					break;
				case 11:
					$judet = 'Caras-Severin';
					break;
				case 12:
					$judet = 'Cluj';
					break;
				case 13:
					$judet = 'Constanta';
					break;
				case 14:
					$judet = 'Covasna';
					break;
				case 15:
					$judet = 'Dambovita';
					break;
				case 16:
					$judet = 'Dolj';
					break;
				case 17:
					$judet = 'Galati';
					break;
				case 18:
					$judet = 'Gorj';
					break;
				case 19:
					$judet = 'Hargita';
					break;
				case 20:
					$judet = 'Hunedoara';
					break;
				case 21:
					$judet = 'Ialomita';
					break;
				case 22:
					$judet = 'Iasi';
					break;
				case 23:
					$judet = 'Ilfov';
					break;
				case 24:
					$judet = 'Maramures';
					break;
				case 25:
					$judet = 'Mehedinti';
					break;
				case 26:
					$judet = 'Mures';
					break;
				case 27:
					$judet = 'Neamt';
					break;
				case 28:
					$judet = 'Olt';
					break;
				case 29:
					$judet = 'Prahova';
					break;
				case 30:
					$judet = 'Satu Mare';
					break;
				case 31:
					$judet = 'Salaj';
					break;
				case 32:
					$judet = 'Sibiu';
					break;
				case 33:
					$judet = 'Suceava';
					break;
				case 34:
					$judet = 'Teleorman';
					break;
				case 35:
					$judet = 'Timis';
					break;
				case 36:
					$judet = 'Tulcea';
					break;
				case 37:
					$judet = 'Vaslui';
					break;
				case 38:
					$judet = 'Valcea';
					break;
				case 39:
					$judet = 'Vrancea';
					break;
				case 40:
				case 41:
				case 42:
				case 43:
				case 44:
				case 45:
				case 46:
					$judet = 'Bucuresti';
					break;
				case 47:
					$judet = 'NULL';
					break;
				case 51:
					$judet = 'Calarasi';
					break;
				case 52:
					$judet = 'Giurgiu';
					break;
			}

			$data['judet'] = $judet;

			return $data;
		}

	}