
<?php
require_once('Domain/Utility/Controlli.class.php');
require_once('Persona.class.php');

/**
 * Classe CodiceFiscale che descrive l'entità Codice Fiscale italiano. Data una Persona in input genera il rispettivo Codice Fiscale.
 * @link http://en.wikipedia.org/wiki/Italian_fiscal_code_card click for more information...
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Federica Caruso
 * @package CodiceFiscale/Domain
 * 
 */

class CodiceFiscale {

	/**
	 * 
	 * @var string $codice Stringa contenente il Codice Fiscale.
	 * 
	 */

	private $codice;

	/**
	 *
	 * Costruttore di Codice Fiscale data una Persona.
	 * @throws Exception Se la Persona non rispetta i requisiti base. Tali requisiti comunque sono garantiti in quanto nella classe Persona sono implementati controlli per evitare input errati.
	 * @param Persona $persona Oggetto Persona di cui calcolare il Codice Fiscale.
	 *
	 */

	public function __construct(Persona $persona) {
		$this->codice = CodiceFiscale::calcolacodice($persona);
	}

	/**
	 *
	 * Questo è un metodo statico che richiama al suo interno altri metodi statici al fine di calcolare il Codice Fiscale della Persona.
	 * @param Persona $persona Oggetto Persona di cui calcolare il Codice Fiscale.
	 * @return string Contenente il Codice Fiscale della Persona.
	 *
	 */

	static function calcolacodice(Persona $persona) {
	
		/*Di seguito si richiamano le varie funzioni che contribuiscono
		al calcolo del CF.*/


		$cognome = CodiceFiscale::calcoloconsonanti($persona->getCognome(), "cognome");
		$nome = CodiceFiscale::calcoloconsonanti($persona->getNome(),"nome");
		$data = CodiceFiscale::calcolodata($persona->getNascita(),$persona->getSesso());
		$comune = $persona->getComune()->getCodiceIstat();
		$controllo = CodiceFiscale::calcolocontrollo("$cognome" . "$nome" . "$data" . "$comune");

		

		return trim($cognome . $nome . $data . $comune . $controllo);
	}

	/**
	 *
	 * Tale funzione estrae dal cognome o dal nome le 3 lettere per il codice fiscale secondo le regole definite per il CF.
	 * @param string $app Contiene il nome o il cognome della Persona di cui calcolare il Codice Fiscale
	 * @param string $tipo Contiene "nome" o "cognome" a seconda del dato passato in $app.
	 * @throws Exception Se $app non rispetta le regole defini in Controlli::sololettere().
	 * @uses Controlli::sololettere() Per verificare la correttezza delle stringhe passate per parametro
	 *
	 */

	static function calcoloconsonanti($app, $tipo) {
		$app = trim(strtoupper($app));
		if (!Controlli::sololettere($app)) {
			if ($tipo == "cognome") {
				throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z", 2);
			} else {
				throw new Exception("Nome errato, inserire solo lettere dalla A alla Z", 3);
			}
		}
		$vocali = array("A","E","I","O","U"," ","'");
		$consonanti = array("B","C","D","F","G","H","J","K","L","M","N","P","Q","R","S","T","V","W","X","Y","Z"," ","'");
		$cons = trim(str_replace($vocali,"",$app)); //Sostituisce in $app i valori contenuti nell'array $vocali con ""
		$voc = trim(str_replace($consonanti,"",$app)); //Sostituisce in $app i valori contenuti nell'array $consonanti con ""
		$ris = trim("$cons" . "$voc"); //Concatena consonanti + vocali della stringa $app
		if (strlen($ris)<3) { //Se la lunghezza di $ris<3 
				do {
					$ris = $ris . "X"; //Si concatenano delle "X" alla stringa $ris finchè la sua lunghezza è minore di 3
				} while (strlen($ris)<3);
		} elseif (strlen($ris)>3 && $tipo == "cognome") { //Se la lunghezza di $ris>3 e si è passato un cognome allora
			$ris = substr($ris, 0 , 3 );					//si prendono i primi 3 caratteri della stringa $ris
		} elseif (strlen($ris)>3 && $tipo == "nome") { //Se la lunghezza di $ris>3 e si è passato un nome allora
			if (strlen($cons)>3) {						//Si verifica se le consonanti formanti il nome siano più di 3
				$ris = $ris{0} . $ris{2} . $ris{3};		//Se si allora si prende il 1°,3°,4° carattere di $ris (sicuramente consonanti)
			} else {
				$ris = substr($ris, 0 , 3);				//Altrimenti si prendono i primi 3 caratteri
			}
		}
		return trim($ris);
	}

	/**
	  *
	  * Tale metodo calcola i 5 caratteri rappresentativi della data di nascita secondo le specifiche del Codice Fiscale.
	  * @throws Exception Se $sesso è diverso da "M" o "F".
	  * @param DateTime $data Oggetto DateTime contenente la data di nascita della Persona in formato "gg/mm/aaaa".
	  * @param string $sesso Contiene il sesso della Persona.
	  * @return string Contiene i 5 caratteri rappresentativi della data di nascita secondo le specifiche del Codice Fiscale. Esempio: $sesso="M" e $data = "03/09/1993" --> "93P03"
	  *
	  */

	static function calcolodata($data, $sesso) {
		if (!Controlli::verificasesso($sesso)) {
			throw new Exception("Sesso errato, inserire M o F", 5);
		}
		
		$anno = $data->format('y'); //Si prendono le ultime 2 cifre dell'anno di nascita
		$listamesi = array('1' => "A", //Si crea un array dove ci sono le corrispondenze tra mesi e lettere
						   '2' => "B",
						   '3' => "C",
						   '4' => "D",
						   '5' => "E",
						   '6' => "H",
						   '7' => "L",
						   '8' => "M",
						   '9' => "P",
						   '10' => "R",
						   '11' => "S",
						   '12' => "T");
		$mese = $data->format('n');
		$mese = "$listamesi[$mese]"; //Si trasforma il mese nella lettera corrispondente

		if ($sesso == "F") { //Se il sesso è femminile allora si aggiunge 40 al giorno di nascita
			$giorno = 40 + $data->format('j');
		} else {
			$giorno = $data->format('d');
		}
	
		return trim("$anno" . "$mese" . "$giorno"); //Si restituisce il risultato nel formato previsto dal CF
	}

	/**
	  *
	  * Tale metodo calcola l'ultimo carattere di controllo del Codice Fiscale.
	  * @param string $codice Contiene i primi 15 caratteri del CodiceFiscale della Persona.
	  * @return string Restituisce il 16esimo carattere del Codice Fiscale secondo le specifiche del Codice Fiscale.
	  *
	  */

	static function calcolocontrollo($codice) {
		$dispari = array('0' => 1, //Creazione tabella conversione per caratteri in posizione dispari
						 '1' => 0,
						 '2' => 5,
						 '3' => 7,
						 '4' => 9,
						 '5' => 13,
						 '6' => 15,
						 '7' => 17,
						 '8' => 19,
						 '9' => 21,
						 'A' => 1,
						 'B' => 0,
						 'C' => 5,
						 'D' => 7,
						 'E' => 9,
						 'F' => 13,
						 'G' => 15,
						 'H' => 17,
						 'I' => 19,
						 'J' => 21,
						 'K' => 2,
						 'L' => 4,
						 'M' => 18,
						 'N' => 20,
						 'O' => 11,
						 'P' => 3,
						 'Q' => 6,
						 'R' => 8,
						 'S' => 12,
						 'T' => 14,
						 'U' => 16,
						 'V' => 10,
						 'W' => 22,
						 'X' => 25,
						 'Y' => 24,
						 'Z' => 23);
		$pari = array('0' => 0,  //Creazione tabella conversione per caratteri in posizione spari
					  '1' => 1,
					  '2' => 2,
					  '3' => 3,
					  '4' => 4,
					  '5' => 5,
					  '6' => 6,
					  '7' => 7,
					  '8' => 8,
					  '9' => 9,
					  'A' => 0,
					  'B' => 1,
					  'C' => 2,
					  'D' => 3,
					  'E' => 4,
					  'F' => 5,
					  'G' => 6,
					  'H' => 7,
					  'I' => 8,
					  'J' => 9,
					  'K' => 10,
					  'L' => 11,
					  'M' => 12,
					  'N' => 13,
					  'O' => 14,
					  'P' => 15,
					  'Q' => 16,
					  'R' => 17,
					  'S' => 18,
					  'T' => 19,
					  'U' => 20,
					  'V' => 21,
					  'W' => 22,
					  'X' => 23,
					  'Y' => 24,
					  'Z' => 25);
		$resti = array('0' => "A", //Creazione tabella conversione del resto
					   '1' => "B",
					   '2' => "C",
					   '3' => "D",
					   '4' => "E",
					   '5' => "F",
					   '6' => "G",
					   '7' => "H",
					   '8' => "I",
					   '9' => "J",
					   '10' => "K",
					   '11' => "L",
					   '12' => "M",
					   '13' => "N",
					   '14' => "O",
					   '15' => "P",
					   '16' => "Q",
					   '17' => "R",
					   '18' => "S",
					   '19' => "T",
					   '20' => "U",
					   '21' => "V",
					   '22' => "W",
					   '23' => "X",
					   '24' => "Y",
					   '25' => "Z");
		$i = 1;
		$somma = 0;
		while ($i <= 15) {
			if ($i % 2 == 0) { //Si controlla se siamo su un carattere pari o dispari
				$somma = $somma + $pari[$codice{$i - 1}]; //Se pari si utilizza la tabella di corrispondenza dei pari
			} else {
				$somma = $somma + $dispari[$codice{$i - 1}]; //Se dispari si utilizza la tabella di corrispondenza dei dispari
			}
			$i += 1;
		}
		$resto = $somma % 26; //Si calcola il resto della divisione
		return $resti[$resto]; //Si restituisce il carattere di controllo relativo al valore del resto ottenuto
	}

	/**
     * 
     * @return string Stringa contenente il Codice Fiscale di Persona.
     *
     */

	public function getCodice() {
		return trim($this->codice);
	}

	/**
     * 
     * Override del "Magic Method" __toString(). Stampa tutti gli attributi.
     * @return string Stringa contenente gli attributi.
     *
     */

	public function __toString() {
		return trim("Codice Fiscale: $this->codice");
	}

}
?>