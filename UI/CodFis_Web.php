<?php
require_once('../Domain/Persona.class.php');
require_once('../Domain/CodiceFiscale.class.php');


$nome=$_POST["Nome"];
$cognome=$_POST["Cognome"];
$data=$_POST["Data"];
$sesso=$_POST["Sesso"];
$provincia=$_POST["Provincia"];
$comune=$_POST["Comune"];


$persona = new Persona($nome,$cognome,$data,$comune,$provincia,$sesso);
    
	$codice_fiscale = new CodiceFiscale($persona);

	print "$persona\n$codice_fiscale\n";


?>