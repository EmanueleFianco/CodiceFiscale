<html>
<head>
	<link type="text/css"
           rel ="stylesheet"
           href= "Utility/graficaoutput.css"
      >
</head>
	<body bgcolor="0099FF">
		<h3 align=center ><b>Risultato</b></h3>
		<table>
			<tr>
				<td>Nome &nbsp</td>
				<td> {$persona->getNome()} <br></td>
			</tr>
			<tr>
				<td>Cognome &nbsp</td>
				<td> {$persona->getCognome()} <br></td>
			</tr>
			<tr>
				<td>Data dd/mm/yy &nbsp </td>
				<td> {$persona->getNascita()->format('d/m/Y')} <br></td>
			</tr>
			<tr>
				<td>Sesso M/F &nbsp</td>
				<td> {$persona->getSesso()} <br></td>
			</tr>
			<tr>
				<td>Provincia &nbsp</td>
				<td> {$persona->getComune()->getProvincia()} <br></td>
			</tr>
			<tr>
				<td>Comune &nbsp</td>
				<td> {$persona->getComune()->getCitta()} <br></td>
			</tr>
			<tr>
				<td>Codice Fiscale &nbsp</td>
				<td> {$codice->getCodice()} <br></td>
			</tr>
			
		</table>
		<div id="credits">
		   <p>
		   	  Design and develop by:  Fabio Di Sabatino-Emanuele Fianco-Gioele Cicchini-Federica Caruso.

		   </p>
	</body>
</html>