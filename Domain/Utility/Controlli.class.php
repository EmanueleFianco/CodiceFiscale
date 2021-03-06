<?php

/**
 *
 * Libreria di controlli generali dei vari parametri passati in input dall'utente
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Gioele Cicchini
 * @author Federica Caruso
 * @package CodiceFiscale/Domain/Utility
 * 
 */

class Controlli {
	
	/**
	 *
	 * Controlla se la stringa passata per parametro è composta da sole lettere maiuscole, spazi e apostrofi.
	 * @param string $stringa Stringa da controllare
	 * @return boolean TRUE se $stringa rispetta le condizioni
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
	 *
	 * Controlla se la stringa $data passata per parametro è scritta nel formato "gg/mm/aaaa".
	 * @param string $data Stringa da controllare
	 * @return boolean TRUE se $data rispetta le condizioni
	 *
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
	 *
	 * Controlla se la stringa $sesso passata per parametro è "M" o "F"
	 * @param string $sesso Stringa da controllare
	 * @return boolean TRUE se $sesso rispetta le condizioni
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