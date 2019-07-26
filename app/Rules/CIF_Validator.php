<?php

	namespace App\Rules;

	use Illuminate\Contracts\Validation\Rule;

	class CIF_Validator implements Rule
	{
		/**
		 * Create a new rule instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			//
		}

		/**
		 * Determine if the validation rule passes.
		 *
		 * @param  string $attribute
		 * @param  mixed $value
		 * @return bool
		 */
		public function passes($attribute, $value)
		{
			$cif = $value;
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

		/**
		 * Get the validation error message.
		 *
		 * @return string
		 */
		public function message()
		{
			return ':attribute nu este valid!';
		}
	}
