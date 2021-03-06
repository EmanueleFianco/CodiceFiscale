<?php
require_once('Comune.class.php');
require_once('Domain//Utility/Controlli.class.php');

/**
 *
 * Classe Persona che descrive l'entità Persona
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @author Gioele Cicchini
 * @author Federica Caruso
 * @package CodiceFiscale/Domain
 * 
 */

class Persona {

	/**
   *
	 * @var string $nome Il nome della persona.
	 * 
	 */

  private $nome;

  /**
   *
   * @var string $cognome Il cognome della persona.
   * 
   */


  private $cognome;

  /**
   *
   * @var string $nascita La data di nascita della persona in formato "gg/mm/aaaa".
   * 
   */

  private $nascita;

  /**
   *
   * @var Comune $comune Il comune di nascita della persona.
   * 
   */

  private $comune;

  /**
   *
   * @var string $sesso Il sesso della persona.
   * 
   */

  private $sesso;
  
  
/**
 * 
 * Costruttore di Persona
 * @throws Exception Se i parametri non sono tutte stringhe formattati secondo le regole descritte in Controlli::sololettere() per $nome, $cognome, $citta, $provincia e $sesso. $sesso inoltre deve essere "M" o "F". $nascita nel formato "gg/mm/aaaa".
 * @param string $nome
 * @param string $cognome
 * @param DateTime $nascita "gg/mm/aaaa".
 * @param string $citta
 * @param string $provincia
 * @param string $sesso "M" o "F".
 * @uses Controlli::sololettere() Per verificare la correttezza delle stringhe passate per parametro
 * @uses Controlli::formatodatavalido() Per verificare la correttezza del formato di $nascita "gg/mm/aaaa".
 * @uses Controlli::verificasesso() Per verificare la correttezza di $sesso "M" o "F".
 *
 */
 
  public function __construct($nome,$cognome,$nascita,$citta,$provincia,$sesso) {

    if (!is_string($nome) || !is_string($cognome) || !is_string($nascita) || !is_string($citta) || !is_string($provincia) || !is_string($sesso)) {
          throw new Exception("Errore nei dati", 1);
    } else {
      $nome = trim(strtoupper($nome));
      $cognome = trim(strtoupper($cognome));
      $nascita = trim($nascita);
      $citta = trim(strtoupper($citta));
      $provincia = trim(strtoupper($provincia));
      $sesso = trim(strtoupper($sesso));
      if(!Controlli::sololettere($nome)) {
      	throw new Exception("Nome errato, inserire solo lettere dalla A alla Z",3);
      } else {
        $this->nome = $nome;
      }
      if(!Controlli::sololettere($cognome)) {
        throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z",2);
      } else {
        $this->cognome = $cognome;
      }
      if (!Controlli::formatodatavalido($nascita)) {
        throw new Exception("Formato data errato, inserire gg/mm/aaaa", 4);
      } else {
        $this->nascita = DateTime::createFromFormat('d/m/Y', $nascita);
        if ($this->nascita->getLastErrors()['warning_count'] > 0) {
          throw new Exception("Data non corretta", 6);
        }
      }
      if (!Controlli::sololettere($citta)) {
        throw new Exception("Comune errato, inserire solo lettere dalla A alla Z", 8);
      } elseif (strlen($provincia) != 2 || !Controlli::sololettere($provincia)) {
        throw new Exception("La provincia è composta da solo 2 lettere dell'intervallo (A,Z)", 7);
      }
      $this->comune = new Comune($citta,$provincia);
      if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso = $sesso;
      }
    }
  }

  /**
   * Setta $nome come nome della Persona
   * @throws Exception Se $nome non rispetta le regole stabilite in Controlli::sololettere()
   * @param string $nome
   *
   */  
  
  public function setNome($nome) {
    $nome = trim(strtoupper($nome));
    if(!Controlli::sololettere($nome)) {
      throw new Exception("Nome errato, inserire solo lettere dalla A alla Z",3);
    } else {
  	  $this->nome = $nome;
    }
  }

  /**
   * Setta $cognome come cognome della Persona
   * @throws Exception Se $cognome non rispetta le regole stabilite in Controlli::sololettere()
   * @param string $cognome
   *
   */  
  
  public function setCognome($cognome) {
    $cognome = trim(strtoupper($cognome));
    if(!Controlli::sololettere($cognome)) {
      throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z",2);
    } else {
  	  $this->cognome = $cognome;
    }
  }

  /**
   * Setta $nascita come nascita della Persona
   * @throws Exception Se $nascita non è una data valida oppure è in formato diverso da "gg/mm/aaaa".
   * @param int $day Giorno di nascita
   * @param int $month Mese di nascita
   * @param int $year Anno di nascita
   *
   */  
  
  public function setNascita($day, $month, $year) {
    if (!checkdate($month, $day, $year)) {
      throw new Exception("Data non corretta", 6);
    } else {
      $this->nascita->setDate($year,$month,$day);
    }
  }

  /**
   * Setta $sesso come sesso della Persona
   * @throws Exception Se $sesso è diverso da "M" o "F".
   * @param string $sesso
   * @uses Controlli::verificasesso() Per verificare che $sesso sia "M" o "F".
   *
   */  

  public function setSesso($sesso) {
    $sesso = trim(strtoupper($sesso));
    if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso = $sesso;
      }
  }

  /**
   * 
   * @return DateTime Oggetto DateTime contenente la data di nascita della Persona in formato "gg/mm/aaaa".
   *
   */
  
  public function getNascita() {
    return $this->nascita;
  }

  /**
   * 
   * @return string Stringa contenente il nome della Persona.
   *
   */
    
  public function getNome() {
  	return $this->nome;
  }

  /**
   * 
   * @return string Stringa contenente il cognome della Persona.
   *
   */
  
  public function getCognome() {
  	return $this->cognome;
  }

  /**
   * 
   * @return Comune Restituisce il Comune di nascita della Persona.
   *
   */
    
  public function getComune() {
  	return $this->comune;
  }

  /**
   * 
   * @return string Stringa contenente il sesso della Persona.
   *
   */
  
  public function getSesso() {
    return $this->sesso;
  }

  public function getCitta()
  {
    return $this->comune->getCitta();
  }

  public function getProvincia()
  {
     return $this->comune->getProvincia();
  }

  /**
   * 
   * Override del "Magic Method" __toString(). Stampa tutti gli attributi.
   * @return string Stringa contenente gli attributi.
   *
   */

  public function __toString() {
    $data = $this->nascita->format('d/m/Y');
    return "\nNome: $this->nome \nCognome: $this->cognome \nData di nascita: $data \nSesso: $this->sesso \n$this->comune";
  }
}
?>