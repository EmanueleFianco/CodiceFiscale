<?php
require_once('Domain/Persona.class.php');
require_once('Domain/CodiceFiscale.class.php');

/**
 * Classe ViewForm per gestire l'input da form
 * @author Gioele Cicchini
 * @author Emanuele Fianco
 * @author Fabio Di Sabatino
 * @package CodiceFiscale/UI
 * 
 */

class ViewForm {

	/**
	 *
	 * Questo metodo prende gli input da form
	 *
	 */

	static function Input() {
		print ("<html>
					<body bgcolor=".'0099FF'.">

						<h3 align=center >Calcolo Codice Fiscale</h5>
						<form method=".'post'." enctype = ".'multipart/form-data'.">
							<table >
								<tr>
										<td>Nome</td>
										<td><input type=".'text'." name=".'nome'."><br></td>
								</tr>
								<tr>
										<td>Cognome</td>
										<td><input type=".'text'." name=".'cognome'."><br></td>
								</tr>
								<tr>
										<td>Data dd/mm/yy</td>
										<td><input type=".'text'." name=".'data'."><br></td>
								</tr>
								<tr  >
									<td>
										Sesso
									</td>
									<td align=".'center'.">
										F<input type=".'radio'." name=".'sesso'." value=".'F'." checked>
										M<input type=".'radio'." name=".'sesso'." value=".'M'.">
									</td>
								</tr>
								<tr>
										<td>Provincia</td>
										<td><input type=".'text'." name=".'provincia'."><br></td>
								</tr>
								<tr>
										<td>Comune</td>
										<td><input type=".'text'." name=".'comune'."><br></td>
								</tr>

								<tr>
								<td>Aggiunta file <br> prioritario rispetto  <br> a form </td>
								<td><input type=".'file'." name=".'file'."></td>
								</tr>


							 	<tr>
							 	<td align =center><input type=".'submit'."></td>
							 	</tr>


							 
							</table>
						</form>
					</body>
				</html> ");
		
	}

	/**
	 *
	 * Questo metodo visualizza gli output su browser
	 *
	 */

	static function Output(Persona $persona, CodiceFiscale $codice) {
		print ("<html>
					<body bgcolor=".'0099FF'.">
						<h3 align=center >Risultato</h5>
						<table>
							<tr>
								<td>Nome &nbsp</td>
								<td>".$persona->getNome()."<br></td>
							</tr>
							<tr>
								<td>Cognome &nbsp</td>
								<td>".$persona->getCognome()."<br></td>
							</tr>
							<tr>
								<td>Data dd/mm/yy &nbsp </td>
								<td>".$persona->getNascita()->format('d/m/Y')."<br></td>
							</tr>
							<tr>
								<td>Sesso M/F &nbsp</td>
								<td>".$persona->getSesso()."<br></td>
							</tr>
							<tr>
								<td>Provincia &nbsp</td>
								<td>".$persona->getComune()->getProvincia()."<br></td>
							</tr>
							<tr>
								<td>Comune &nbsp</td>
								<td>".$persona->getComune()->getCitta()."<br></td>
							</tr>
							<tr>
								<td>Codice Fiscale &nbsp</td>
								<td>".$codice->getCodice()."<br></td>
							</tr>
						</table>
					</body>
				</html>");
	}

	/**
	 *
	 * Questo metodo visualizza il messaggio di errore su browser in caso ci sia stato
	 *
	 */

	static function Errore(Exception $e) {
		print ("<html>
					<body bgcolor=".'0099FF'.">
							<h3 align=center >".$e->getMessage().".</h5>
					</body>
				</html>");
	}
}

?>