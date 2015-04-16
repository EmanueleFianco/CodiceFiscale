<?php 
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');
require_once('UI/ViewForm.class.php');
require_once('UI/ViewFile.class.php');
require_once('UI/ViewShell.class.php');

Class ControllerUI {

	static function InputForm() {
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