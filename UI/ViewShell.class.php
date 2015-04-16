<?php
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');

class ViewShell {

	static function Input() {
		$handle = fopen ("php://stdin","r"); //Standard input
		print "Calcolo Codice Fiscale \n";
		print "Cognome: "; //Inizio inserimento dati
		$dati['cognome'] = fgets($handle);
		print "Nome: ";
		$dati['nome'] = fgets($handle);
		print "Data di nascita (gg/mm/aaaa): ";
		$dati['data'] = fgets($handle);
		print "Sesso (m,f): ";
		$dati['sesso'] = fgets($handle);
		print "Provincia di nascita: ";
		$dati['provincia'] = fgets($handle);
		print "Comune di nascita: ";
		$dati['comune'] = fgets($handle); //Fine inserimento dati

		try {
			if (sizeof($dati) != 6 || !isset($dati['cognome']) || !isset($dati['nome']) || !isset($dati['data']) ||
				!isset($dati['sesso']) || !isset($dati['provincia']) || !isset($dati['comune'])) {
					throw new Exception("Errore nei dati", 1);
			}
		} catch (Exception $e) {
			print $e->getMessage() . "\n";
		} finally {
			fclose($handle);
		}
		return $dati;
	}

	static function Output(Persona $persona, CodiceFiscale $codice) {
		print "$persona\n$codice\n\n";
	}
}
?>