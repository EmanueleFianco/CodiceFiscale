<?php

require_once('Comune.class.php');
require_once('../DATA/Controlli.class.php');
/**
 * Person Class:
 *
 * This basic class is design to rapresent and storage
 * the most usefull information about people.
 */

class Persona {
	/**
	 * @var $nome:The person's$nome.
	 * @var $cognome:The person's cognome.
	 * @var $cf:A unique identification code, it depends form state to state, for example in the USA is called SSN.
	 * @var $nascita: The date of birth.
	 * @var $cittaorn: The city where it was born.
	 * 
	 */

  private $nome;
  private $cognome;
  private $nascita;
  private $comune;
  private $sesso;
  
  
/**
 * 
 * @param string $nome:$nome
 * @param string $cognome: cognome
 * @param string $nascita:Pass the birthday as a string "day/month/year".
 * @param string $cd:cBorn
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
      //----------------------------------------
      if (!Controlli::sololettere($citta)) {
        throw new Exception("Comune errato, inserire solo lettere dalla A alla Z", 8);
      } elseif (strlen($provincia) != 2 || !Controlli::sololettere($provincia)) {
        throw new Exception("La provincia è composta da solo 2 lettere dell'intervallo (A,Z)", 7);
      }
      $this->comune =& new Comune($citta,$provincia);

      //---------------------------------------
      if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso = $sesso;
      }
    }
  }
  
  
  public function setNome($nome) {
    $nome = trim(strtoupper($nome));
    if(!Controlli::sololettere($nome)) {
      throw new Exception("Nome errato, inserire solo lettere dalla A alla Z",3);
    } else {
  	  $this->nome = $nome;
    }
  }
  
  public function setCognome($cognome) {
    $cognome = trim(strtoupper($cognome));
    if(!Controlli::sololettere($cognome)) {
      throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z",2);
    } else {
  	  $this->cognome = $cognome;
    }
  }
  
  public function setNascita($day, $month, $year) {
    if (!checkdate($month, $day, $year)) {
      throw new Exception("Data non corretta", 6);
    } else {
      $this->nascita->setDate($year,$month,$day);
    }
  }

  public function setSesso($sesso) {
    $sesso = trim(strtoupper($sesso));
    if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso = $sesso;
      }
  }
  
  public function getNascita() {
    return $this->nascita;
  }
    
  public function getNome() {
  	return $this->nome;
  }
  
  public function getCognome() {
  	return $this->cognome;
  }
    
  public function getComune() {
  	return $this->comune;
  }
  
  public function getSesso() {
    return $this->sesso;
  }

  public function __toString() {
    $data = $this->nascita->format('d/m/Y');
    return "\nNome: $this->nome \nCognome: $this->cognome \nData di nascita: $data \nSesso: $this->sesso \n$this->comune";
  }
}
?>