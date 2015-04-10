<?php
require_once('Persona.class.php');
require_once('CodiceFiscale.class.php');
$handle = fopen ("../DATA/Dati.txt","r"); //Apertura del file con gli input
while (!feof($handle)) {
	$buffer = trim(fgets($handle)); //Legge una riga intera da file e toglie eventuali spazi e return all'inizio e alla fine della riga
	list($tipo,$info) = explode(":",$buffer); //Divide la riga in 2 rispetto al separatore ":"
	$dati[strtolower($tipo)] = trim(strtoupper($info)); //Inserisce l'informazione appena letta in un array
}
try {
	if (sizeof($dati) != 7 || !isset($dati['cognome']) || !isset($dati['nome']) || !isset($dati['data']) ||
		!isset($dati['sesso']) || !isset($dati['provincia']) || !isset($dati['comune'])) {
			throw new Exception("Errore nei dati", 1);
	}

/*
Si richiama la funzione per calcolare il codice fiscale
*/
	$persona = new persona($dati['nome'],$dati['cognome'],$dati['data'],$dati['comune'],$dati['provincia'],$dati['sesso']); 

	$codice_fiscale = new CodiceFiscale($persona);
	print "$persona \n $codice_fiscale";

} catch (Exception $e) {
	print $e->getMessage() . "\n";
} finally {
	fclose($handle);
}

/*print $persona->get_fiscale();
$persona->setNome("Mario");
$persona->setCognome("Fianco");
$persona->setData("14/05/1963", "F");
print $persona;
$persona->setSesso("M");
$persona->setProvinciacomune("fr","anagni");
print $persona;
$persona->setSesso("F");
print $persona;
$persona->setcLive("Como");
var_dump($persona);*/
?>