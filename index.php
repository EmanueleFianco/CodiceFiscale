<html>
<body bgcolor="0099FF">

<h3 align=center >Calcolo Codice Fiscale</h5>
<form action="UI/CodFis_Web.php" method="post">

<table border="1">
	<tr>
			<td>Nome</td>
			<td><input type="text" name="Nome"><br></td>
	</tr>
	<tr>
			<td>Cognome</td>
			<td><input type="text" name="Cognome"><br></td>
	</tr>
	<tr>
			<td>Data dd/mm/yy</td>
			<td><input type="text" name="Data"><br></td>
	</tr>
	<tr  >
		<td>
			Sesso
		</td>
		<td align="center">
			F<input type="radio" name="Sesso" value="F" checked>
			M<input type="radio" name="Sesso" value="M">
		</td>
	</tr>
	<tr>
			<td>Provincia</td>
			<td><input type="text" name="Provincia"><br></td>
	</tr>
	<tr>
			<td>Comune</td>
			<td><input type="text" name="Comune"><br></td>
	</tr>

 	<tr>
 	<td align =center><input type="submit"></td>
 	</tr>
 
</table>
</form>

</body>
</html> 