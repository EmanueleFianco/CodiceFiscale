<?php
require_once('Controlli.class.php');
require_once('Comune.class.php');
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
	 * @var $cBorn: The city where it was born.
	 * 
	 */

  private $nome;
  private $cognome;
  private $nascita;
  private $comune;
 
  private $sesso;
  
  
/**
 * 
 * @param string $n:$nome
 * @param string $s: cognome
 * @param string $bd:Pass the birthday as a string "day/month/year".
 * @param string $cd:cBorn
 */
 
  function __construct($n,$s,$bd,$cb,$pb,$sesso) {

    if (!is_string($n) || !is_string($s) || !is_string($bd) || !is_string($cb) || !is_string($pb) || !is_string($sesso)) {
          throw new Exception("Errore nei dati", 1);
    } else {
      if(!Controlli::sololettere($n)) {
      	throw new Exception("Nome errato, inserire solo lettere dalla A alla Z",3);
      } else {
        $this->nome=$n;
      }
      if(!Controlli::sololettere($s)) {
        throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z",2);
      } else {
        $this->cognome=$s;
      }
      if (!Controlli::formatodatavalido($bd)) {
        throw new Exception("Formato data errato, inserire gg/mm/aaaa", 4);
      } else {
        $this->nascita = DateTime::createFromFormat('d/m/Y', $bd);
        if ($this->nascita->getLastErrors()['warning_count'] > 0) {
          throw new Exception("Data non corretta", 6);
        }
      }
      //----------------------------------------
      if (!Controlli::sololettere($cb)) {
        throw new Exception("Comune errato, inserire solo lettere dalla A alla Z", 8);
      } else {
        $citta=$cb;
      }


      if (strlen($pb) != 2 || !Controlli::sololettere($pb)) {
        throw new Exception("La provincia è composta da solo 2 lettere dell'intervallo (A,Z)", 7);
      } else {
        $prov=$pb;
      }

      $this->comune = new Comune($citta,$prov);

      //---------------------------------------
      if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso=$sesso;
      }
      }
    }
  
  
  public function set_nome($nome) {
    $nome = trim(strtoupper($nome));
    if(!Controlli::sololettere($nome)) {
      throw new Exception("Nome errato, inserire solo lettere dalla A alla Z",3);
    } else {
  	  $this->nome=$nome;
    }
  }
  
  public function set_cognome($cognome) {
    $cognome = trim(strtoupper($cognome));
    if(!Controlli::sololettere($cognome)) {
      throw new Exception("Cognome errato, inserire solo lettere dalla A alla Z",2);
    } else {
  	  $this->cognome=$cognome;
    }
  }
  
  public function set_nascita($day, $month, $year) {
    if (!checkdate($month, $day, $year)) {
      throw new Exception("Data non corretta", 6);
    } else {
      $this->nascita->setDate($year,$month,$day);
    }
  }
    


  public function setsesso($sesso) {
    $sesso = trim(strtoupper($sesso));
    if (!Controlli::verificasesso($sesso)) {
        throw new Exception("Sesso errato, inserire M o F", 5);
      } else {
        $this->sesso=$sesso;
      }
  }
  
  public function get_Nascita() {
    $data = $this->nascita->format('d/m/Y');
    
  	return $data;
  }
    
  public function get_Nome() {
  	return $this->nome;
  }
  
  public function get_Cognome() {
  	return $this->cognome;
  }
    
  public function get_Comune() {
  	return $this->comune;
  }
  
  public function get_Sesso() {
    return $this->sesso;
  }

  public function __toString() {
    $data = $this->nascita->format('d/m/Y');
    return "\nNome: $this->$nome \nCognome: $this->cognome \nData di nascita: $data \nSesso: $this->sesso \n$this->comune\n";
  }
  public function getCodiceIstat(){
    return $this->comune->Get_Codice_Istat();

  }

}
?>