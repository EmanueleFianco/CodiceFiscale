<?php

Class Comune {

 	private $citta;
 	private $provincia;
 	private $codice_istat;
 	private static $file = "../DATA/codici_comuni_italiani.txt";


 	public function __construct($citta,$provincia){
 		$citta = trim($citta);
 		$provincia = trim($provincia);
 		if (!Controlli::sololettere($citta)) {
        throw new Exception("Comune errato, inserire solo lettere dalla A alla Z", 8);
      } else {
      	if (strlen($provincia) != 2 || !Controlli::sololettere($provincia)) {
        throw new Exception("La provincia è composta da solo 2 lettere dell'intervallo (A,Z)", 7);
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
		    
		    $this->codice_istat = $codice;
		    $this->citta = $citta;
		    $this->provincia = $provincia;
		}
	  }
	}

	public function GetCodiceIstat(){
		return trim($this->codice_istat);
	}

	public function __toString() {
		return "Città: $this->citta \nComune: $this->provincia";
	}
}
?>