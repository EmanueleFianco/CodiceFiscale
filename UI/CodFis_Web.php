<?php
try {
	if (!isset($_POST['cognome']) || !isset($_POST['nome']) || !isset($_POST['data']) ||
				!isset($_POST['sesso']) || !isset($_POST['provincia']) || !isset($_POST['comune'])) {
					throw new Exception("Errore nei dati", 1);
			}
		//Richiama il controllore passandogli gli input
		} catch (Exception $e) {
			print ("<html>
						<body bgcolor=".'0099FF'.">
							<h3 align=center >$e->getMessage()</h5>
						</body>
					</html>");
		}
?>