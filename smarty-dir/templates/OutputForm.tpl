<html>
	<body bgcolor="0099FF">
		<h3 align=center >Risultato</h5>
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
	</body>
</html>