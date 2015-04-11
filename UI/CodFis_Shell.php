<?php
require_once('../Domain/Persona.class.php');
require_once('../Domain/CodiceFiscale.class.php');
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

	$persona = new Persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']);
    
	$codice_fiscale = new CodiceFiscale($persona);

	print "$persona\n$codice_fiscale\n";

} catch (Exception $e) {
	print $e->getMessage() . "\n";
} finally {
	fclose($handle);
}
?>