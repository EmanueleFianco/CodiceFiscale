<?php
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');

/**
 * Classe ViewFile per gestire l'input da file
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Federica Caruso
 * @package CodiceFiscale/UI
 * 
 */

class ViewFile {

	/**
	 *
	 * Questo metodo prende gli input da file
	 * @param string $file Stringa contenente il path del file
	 * @return array $dati Contiene i dati della Persona
	 * @throws Exception Se le informazioni contenute nel file sono errate o non rispettano la formattazione
	 *
	 */

	static function Input($file) {
		try {
			if (!file_exists("$file")) {
				throw new Exception("File non esistente, controllare il path inserito in configInput.inc.php");
			} else {
				$handle = fopen ("$file","r"); //Apertura del file con gli input
				while (!feof($handle)) {
					$buffer = trim(fgets($handle)); //Legge una riga intera da file e toglie eventuali spazi e return all'inizio e alla fine della riga
					list($tipo,$info) = explode(":",$buffer); //Divide la riga in 2 rispetto al separatore ":"
					$dati[strtolower($tipo)] = trim(strtoupper($info)); //Inserisce l'informazione appena letta in un array
				}
				if (sizeof($dati) != 6 || !isset($dati['cognome']) || !isset($dati['nome']) || !isset($dati['data']) ||
					!isset($dati['sesso']) || !isset($dati['provincia']) || !isset($dati['comune'])) {
					throw new Exception("Errore nei dati", 1);
				}
			}
		} catch (Exception $e) {
			print $e->getMessage() . "\n";
		} finally {
			if (isset($handle)) {
				fclose($handle);
				return $dati;
			}
		}
	}

	/**
	 *
	 * Questo metodo visualizza l'output
	 *
	 */

	static function Output(Persona $persona, CodiceFiscale $codice) {
		print "$persona\n$codice\n\n";
	}
}
?>