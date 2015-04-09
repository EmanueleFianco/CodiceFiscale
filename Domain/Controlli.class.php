<?php

/**
 * A basic class that implements some controls.
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Gioele Cicchini
 * 
 */

class Controlli {
	
	/**
	 * check the string passed has only char inside.
	 * @param string $stringa string to check
	 * @return boolean TRUE if it hasn't a number
	 *
	 */

	static function sololettere($stringa) {
		$stringa = str_split($stringa, 1);
		foreach ($stringa as $k => $val) {
			if (!((ord($val) >= 65 && ord($val) <= 90) || ord($val) == 32 || ord($val) == 39)) {
				return FALSE;
			}
		}
		return TRUE;
	}

	/**
	 * check the date passed is in the valid format day/month/year
	 * @param string $data
	 * @return boolean TRUE if the string passed is valid 
	 */

	static function formatodatavalido($data) {
		if (!(48 <= ord($data{0}) && ord($data{0}) <= 57) || !(48 <= ord($data{1}) && ord($data{1}) <= 57) || $data{2} != "/" ||
		    !(48 <= ord($data{3}) && ord($data{3}) <= 57) || !(48 <= ord($data{4}) && ord($data{4}) <= 57) || $data{5} != "/" ||
		    !(48 <= ord($data{6}) && ord($data{6}) <= 57) || !(48 <= ord($data{7}) && ord($data{7}) <= 57) ||
			!(48 <= ord($data{8}) && ord($data{8}) <= 57) || !(48 <= ord($data{9}) && ord($data{9}) <= 57) || strlen($data) != 10) {
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * check the string passed is valid, M (male) or F (female)
	 * @param string $sesso the sex to check
	 * @return boolean TRUE if the  is valid
	 * 
	 */

	static function verificasesso($sesso) {
		if ($sesso != "M" && $sesso != "F") {
			return FALSE;
		}
		return TRUE;
	}
}
?>