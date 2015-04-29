<?php 
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');
require_once('UI/ViewForm.class.php');
require_once('UI/ViewFile.class.php');
require_once('UI/ViewShell.class.php');

/**
 * Classe Controllore per disaccoppiare le View con il Dominio.
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Federica Caruso
 * @package CodiceFiscale/Controller
 * 
 */

Class ControllerUI {

	/**
	 *
	 * Questo metodo richiama la view per input via form o file(caricato sempre da form)
	 *
	*/

	static function InputForm() {
		$view = new ViewForm();
		$view->setTemplate('InputForm.tpl');
	}

	/**
	 *
	 * Metodo richiamato quando viene premuto il tasto submit sulla form
	 * @throws Exception Se i campi della form non sono inseriti correttamente o se ne sono lasciati alcuni vuoti. Se il mime-type del file caricato è diverso da text/plain. Se si utilizza db per i codici del catasto potrebbe non riuscire la connessione al db e quindi lanciare un'eccezione.
	 *
	 */

	static function ElaboraForm() {
		try {
			$view = new ViewForm();
			if($_FILES['file']['size'] != 0) {
				if($_FILES['file']['type'] != 'text/plain') {
					throw new Exception("Si accettano solamente file contenente text/plain");
				} else {
					$originale = $_FILES['file']['tmp_name'];
					$dati = ViewFile::Input($originale);
					$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
					$codice = new CodiceFiscale($persona);
					$view->setDataIntoTemplate('persona',$persona);
					$view->setDataIntoTemplate('codice',$codice);
					$view->setTemplate('OutputForm.tpl');
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
				$view->setDataIntoTemplate('persona',$persona);
				$view->setDataIntoTemplate('codice',$codice);
				$view->setTemplate('OutputForm.tpl');
			} else {
				throw new Exception("Inserire correttamente tutti i campi richiesti");
			}
		} catch (Exception $e) {
			if ($e->getCode() == 2002) {
				$e = new Exception("Connessione al db non riuscita");
			}
			$view->setDataIntoTemplate('e',$e);
			$view->setTemplate('ErroreForm.tpl');
		}
	}

	/**
	 *
	 * Questo metodo permette di inserire gli input via file e si interfaccia con Domain
	 * @uses ViewFile::Input() Prende gli input da file
	 * @uses ViewFile::Output() Richiama l'output da shell
	 * @throws Exception Se il file di input non contiene tutte le informazioni necessarie oppure è formattato in maniera non conforme alle specifiche richieste. Se si utilizza db per i codici del catasto potrebbe non riuscire la connessione al db e quindi lanciare un'eccezione.
	 *
	*/

	static function InputFile() {
		include 'Utility/configInput.inc.php';
		try {
			$dati = ViewFile::Input($config['file']);
			$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
			$codice = new CodiceFiscale($persona);
			ViewFile::Output($persona,$codice);
		} catch (Exception $e) {
			if ($e->getCode() == 2002) {
				$e = new Exception("Connessione al db non riuscita");
			}
			print $e->getMessage() . "\n";
		}
	}	

	/**
	 *
	 * Questo metodo permette di inserire gli input via shell e si interfaccia con Domain
	 * @uses ViewShell::Input() Prende gli input da file
	 * @uses ViewFile::Output() Richiama l'output da shell
	 * @throws Exception Se i dati di input non sono conformi alle regole richieste. Se si utilizza db per i codici del catasto potrebbe non riuscire la connessione al db e quindi lanciare un'eccezione.
	 *
	*/

	static function InputShell() {
		try {
			$dati = ViewShell::Input();
			$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
			$codice = new CodiceFiscale($persona);
			ViewShell::Output($persona,$codice);
		} catch (Exception $e) {
			if ($e->getCode() == 2002) {
				$e = new Exception("Connessione al db non riuscita");
			}
			print $e->getMessage() . "\n";
		}
	}
}
?>