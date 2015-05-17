<?php
require_once('Domain/Persona.class.php');
Class ControllerSession
{

	static function login ()
	{
           session_start();
           if(isset($_SESSION['cf']))
           	  return true;
           else
           	  return false;
	}


	static function justCalc()
	{ 
    $persona = new Persona($_SESSION['nome'],$_SESSION['cognome'],$_SESSION['data'],$_SESSION['comune'],$_SESSION['provincia'],$_SESSION['sesso']);
		$dati=array('persona'=>$persona,'codice'=>$_SESSION['cf']);			
		return  $dati;
	}
    
    static function newSession($persona,$codice)
    {
    	session_start();
    	$_SESSION['nome']=$persona->getNome();
    	$_SESSION['cognome']=$persona->getCognome();
    	$_SESSION['data']=$persona->getNascita()->format('d/m/Y');
    	$_SESSION['sesso']=$persona->getSesso();
    	$_SESSION['comune']=$persona->getCitta();
    	$_SESSION['provincia']=$persona->getProvincia();
    	$_SESSION['cf']=$codice;



    }

}
?>