<?php

Class Comune {
 	private $citta;
 	private $provincia;
 	private $codice_istat;


 	function __construct(string $citta,string $provincia){
		$handle = fopen ("../DATA/codici_comuni_italiani.txt", "r");
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
	    
	    $this->codice_istat=$codice;
	    $this->citta=$citta;
	    $this->provincia=$provincia;


 	}


	function Get_Codice_Istat(){
		return $this->codice_istat;
	}

	public function __toString() {
		return "\ncittà: $this->$citta \ncomune:$this->provincia";
	}


}




?>