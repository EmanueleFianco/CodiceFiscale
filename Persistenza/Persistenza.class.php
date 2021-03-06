<?php

/**
 *
 * Quasta classe si interfaccia con un db. Impostare i parametri di connessione al db nel file di configurazione "config.inc.php"
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Gioele Cicchini
 * @author Federica Caruso
 * @package CodiceFiscale/Persistenza
 *
 */

class Persistenza {

	/**
	 *
	 * Metodo statico che formula una query a db e restituisce il codice del catasto relativo ai parametri passati
	 * @param string $provincia
	 * @param string $comune
	 *
	 */

	static function getCodiceCatasto($provincia,$comune) {
		require('config.inc.php');
		$col = "$dbms:host=".$config[$dbms]['host'].";dbname=".$config[$dbms]['database'];
		$db = new PDO($col, $config[$dbms]['user'], $config[$dbms]['password']);
		$sql = "SELECT codice FROM codici WHERE provincia = '$provincia' and comune = '$comune'";
		$interrogazione = $db->prepare($sql);
		$interrogazione->execute();
		$risultato = $interrogazione->fetchColumn();
		unset($db);
		if (isset($risultato)) {
			return $risultato;
		} else {
			return FALSE;
		}
	}
}
?>