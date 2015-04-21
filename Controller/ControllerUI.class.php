<?php 
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');
require_once('UI/ViewForm.class.php');
require_once('UI/ViewFile.class.php');
require_once('UI/ViewShell.class.php');

/**
 * Classe Controllore per disaccoppiare le View con il Dominio
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @package CodiceFiscale/Controller
 * 
 */

Class ControllerUI {

	/**
	 *
	 * Questo metodo richiama la view per input via form o file(caricato sempre da form)
	 * @uses ViewForm::Input() Rechiama l'interfaccia per l'input da form
	 *
	*/

	static function InputForm() {
		ViewForm::Input();
	}

	/**
	 *
	 * Metodo richiamato quando viene premuto il tasto submit sulla form
	 * @uses ViewForm::Input() Per richiamare la schermata di input da form
	 * @uses ViewForm::Output() Per richiamare la schermata di output
	 * @uses ViewForm::Errore() Html relativo alla stampa del messaggio d'errore
	 * @throws Exception Se i campi della form non sono inseriti correttamente o se ne sono lasciati alcuni vuoti. Se il mime-type del file caricato è diverso da text/plain
	 *
	 */

	static function ElaboraForm() {
		try {
			if($_FILES['file']['size'] != 0) {
				if($_FILES['file']['type'] != 'text/plain') {
					throw new Exception("Si accettano solamente file contenente text/plain");
				} else {
					$originale = $_FILES['file']['tmp_name'];
					$dati = ViewFile::Input($originale);
					$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
					$codice = new CodiceFiscale($persona);
					ViewForm::Output($persona,$codice);
				}
			} elseif ($_POST['cognome'] && $_POST['nome'] && $_POST['data'] && $_POST['sesso'] && $_POST['provincia'] && $_POST['comune']) {
				$nome=$_POST["nome"];
				$cognome=$_POST["cognome"];
				$data=$_POST["data"];
				$sesso=$_POST["sesso"];
				$provincia=$_POST["provincia"];
				$comune=$_POST["comune"];
				$persona = new Persona($nome,$cognome,$data,$comune,$provincia,$sesso);
				$codice = new CodiceFiscale($persona);
				ViewForm::Output($persona,$codice);
			} else {
				throw new Exception("Inserire correttamente tutti i campi richiesti");
			}
		} catch (Exception $e) {
			ViewForm::Errore($e);
			ViewForm::Input();
		}
	}

	/**
	 *
	 * Questo metodo permette di inserire gli input via file e si interfaccia con Domain
	 * @uses ViewFile::Input() Prende gli input da file
	 * @uses ViewFile::Output() Richiama l'output da shell
	 * @throws Exception Se il file di input non contiene tutte le informazioni necessarie oppure è formattato in maniera non conforme alle specifiche richieste
	 *
	*/


	static function InputFile() {
		try {
			$dati = ViewFile::Input("DATA/Dati.txt");
			$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
			$codice = new CodiceFiscale($persona);
			ViewFile::Output($persona,$codice);
		} catch (Exception $e) {
			print $e->getMessage() . "\n";
		}
	}	

	/**
	 *
	 * Questo metodo permette di inserire gli input via shell e si interfaccia con Domain
	 * @uses ViewShell::Input() Prende gli input da file
	 * @uses ViewFile::Output() Richiama l'output da shell
	 * @throws Exception Se i dati di input non sono conformi alle regole richieste
	 *
	*/


	static function InputShell() {
		try {
			$dati = ViewShell::Input();
			$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
			$codice = new CodiceFiscale($persona);
			ViewShell::Output($persona,$codice);
		} catch (Exception $e) {
			print $e->getMessage() . "\n";
		}
	}
}
?>