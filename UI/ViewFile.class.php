<?php
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');

class ViewFile {

	static function Input() {
		$handle = fopen ("DATA/Dati.txt","r"); //Apertura del file con gli input
		while (!feof($handle)) {
			$buffer = trim(fgets($handle)); //Legge una riga intera da file e toglie eventuali spazi e return all'inizio e alla fine della riga
			list($tipo,$info) = explode(":",$buffer); //Divide la riga in 2 rispetto al separatore ":"
			$dati[strtolower($tipo)] = trim(strtoupper($info)); //Inserisce l'informazione appena letta in un array
		}
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