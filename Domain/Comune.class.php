<?php
include 'Persistenza/Persistenza.class.php';
/**
 *
 * Classe Comune che descrive l'entità Comune Italiano e si occupa del calcolo del Codice Istat relativo a tale Comune.
 * Settare se si utilizza file o db per cercare il Codice del Catasto nel file di configurazione "Utility/configInputCodiciCatasto.inc.php". In caso tale file non sia presente o non sia sttato nulla verrà fatto l'input da file.
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Gioele Cicchini
 * @author Federica Caruso
 * @package CodiceFiscale/Domain
 * 
 */

Class Comune {

	/**
	 * 
	 * @var string $citta 
	 * 
	 */

 	private $citta;

 	/**
 	 *
	 * @var string $provincia
	 * 
	 */

 	private $provincia;

 	/**
	 * 
	 * @var string $codice_istat Rappresenta il Codice Istat associato a $citta e $provincia
	 * 
	 */

 	private $codice_istat;

 	/**
	 * 
	 * @var string $file Contiene il percorso del file contenente la lista di corrispondenza Comune,Provincia --> Codice Istat
	 * 
	 */

 	private static $file = 'DATA/codici_comuni_italiani.txt';

 	/**
 	 *
	 * Costruttore di Comune
	 * @throws Exception Solamente se gli input sono sbagliati o se non si trova alcuna corrispondenza con nessun Codice Istat.
	 * @param string $citta
	 * @param string $provincia
	 * @uses Controlli::sololettere() Per verificare la correttezza delle stringhe passate per parametro
	 * @uses Persistenza::getCodiceCatasto Viene utilizzata in caso nel file di configurazione sia settato $config['Input'] = 'db';
	 *
	 */

 	public function __construct($citta,$provincia){
 		include 'Utility/configInputCodiciCatasto.inc.php';
 		$citta = trim($citta);
 		$provincia = trim($provincia);
 		if (!Controlli::sololettere($citta)) {
        throw new Exception("Comune errato, inserire solo lettere dalla A alla Z", 8);
      } else {
      	if (strlen($provincia) != 2 || !Controlli::sololettere($provincia)) {
        throw new Exception("La provincia è composta da solo 2 lettere dell'intervallo (A,Z)", 7);
      	} else {
      		if (isset($config) && $config['Input'] == 'db') {
      			$codice = Persistenza::getCodiceCatasto($provincia,$citta);
      			if (!$codice) {
      				throw new Exception("Controllare se la provincia e il comune sono esatti", 9);
      			} 
      		} else {
				$handle = fopen (Comune::$file, "r");
			    	$trovato = FALSE;
			    		do {

			        		$buffer = fgets($handle);   // legge una riga intera da file
			        		$buffer = rtrim($buffer);   // rimuove carattere di return a fine riga
			 
			        		list($codice, $comune, $prov) = explode(";", $buffer);  //Divide la stringa in 3 rispetto al separatore ";" usato nel file
			    			if ($comune == $citta && $prov == $provincia) {
			    				$trovato = TRUE;
			    			}
			    		} while (!$trovato && !feof($handle));
			    if (!$trovato) {
			    	fclose ($handle);  // The file pointed to by handle is closed.
			    	throw new Exception("Controllare se la provincia e il comune sono esatti", 9);
			    }
			    fclose ($handle);  // The file pointed to by handle is closed.
		    }
		    $this->codice_istat = $codice;
		    $this->citta = $citta;
		    $this->provincia = $provincia;
		}
	  }
	}

	/**
	 * 
	 * @return string Stringa contenente la città.
	 *
	 */

	public function getCitta(){
		return trim($this->citta);
	}

	/**
	 * 
	 * @return string Stringa contenente la provincia.
	 *
	 */

	public function getProvincia(){
		return trim($this->provincia);
	}

	/**
	 * 
	 * @return string Stringa contenente il Codice Istat.
	 *
	 */

	public function getCodiceIstat(){
		return trim($this->codice_istat);
	}

	/**
	 * 
	 * Override del "Magic Method" __toString(). Stampa tutti gli attributi.
	 * @return string Stringa contenente gli attributi.
	 *
	 */

	public function __toString() {
		return "Città: $this->citta \nProvincia: $this->provincia \nCodice Istat: $this->codice_istat";
	}
}
?>