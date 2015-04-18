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
	 * Questo metodo permette di inserire gli input via form e si interfaccia con Domain
	 *
	*/

	static function InputForm() {
		

		if(!empty($_FILES)){
			if($_FILES['file']['type']=='text/plain'){
				$originale = $_FILES['file']['tmp_name'];
				$copia = "DATA/".$_FILES['file']['name'];
				unlink('DATA/Dati.txt');
				move_uploaded_file($originale,$copia);
				rename($copia,'DATA/Dati.txt');
				$dati=ViewFile::input();
				$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
				$codice = new CodiceFiscale($persona);
				ViewForm::Output($persona,$codice);
			}
			else{
				print "Errore nei dati";  // da gestire l'errore
			}

		}

		else{

		try {
			if (!empty($_POST)) {
				if (!isset($_POST['cognome']) || !isset($_POST['nome']) || !isset($_POST['data']) ||
				!isset($_POST['sesso']) || !isset($_POST['provincia']) || !isset($_POST['comune'])) {
					throw new Exception("Errore nei dati", 1);
			}
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
				ViewForm::Input();
			}	
		} catch (Exception $e) {
			ViewForm::Errore($e);
			ViewForm::Input();
		}

			}
	}

	/**
	 *
	 * Questo metodo permette di inserire gli input via file e si interfaccia con Domain
	 *
	*/


	static function inputFile() {
		try {
			$dati = ViewFile::Input();
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
	 *
	*/


	static function inputShell() {
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