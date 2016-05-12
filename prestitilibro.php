<!DOCTYPE html>
<html lang="it">
<!-- Gestione prestiti della biblioteca di Bici e Dintorni.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - Gestione prestiti</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<?php
/**
 * Prestitilibro.php File Doc Comment
 *
 * PHP version 5.3
 * Gestione dei prestiti per la biblioteca di Bici e Dintorni
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */
$idlibro = $_GET['id'];

echo "id libro = ";

//parametri connessione al DB
$servername = "62.149.150.56";
$username = "Sql145958";
$password = "c36d0fc2";
$dbname = "Sql145958_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// Ricerca del libro sul DB
$sql = "SELECT id, titolo, autore, anno FROM libri WHERE id = $idlibro;" ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$titolo = $row['titolo'];
		$autore = $row['autore'];
		$anno = $row['anno'];
		echo $idlibro . " - " . $titolo . " - " . $autore . " - " . $anno;
	}
} else {
	echo "0 results";
}

echo "<hr />";

// Ricerca dei prestiti del libro sul DB
$sql = "SELECT * FROM prestiti WHERE idlibro = $idlibro ORDER BY dataprestito DESC;" ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$associato = $row['idassociato'];
		// trova nome e cognome del socio
		$sql2 = "SELECT id, nome, cognome FROM anagrafiche WHERE id = $associato";
		$result2 = $conn->query($sql2);
		while ($row2 = $result2->fetch_assoc()){
			$nomesocio = $row2['nome']; 
			$cognomesocio = $row2['cognome'];
		}
		$dataprestitodadb = strtotime($row['dataprestito']);
		$dataprestito = date("d/M/Y", $dataprestitodadb);
		$datarestituzionedadb = strtotime($row['datarestituzione']);
		$datarestituzione = date("d/M/Y", $datarestituzionedadb);
		// inserire test per datarestituzione = null
		echo "prestito a: " . $associato . " - " . $nomesocio . " " . $cognomesocio . 
		" - dal: " . $dataprestito . " - al: " . $datarestituzione . "<br>";
	}
} else {
	echo "Nessun prestito per il libro";
}

echo "<hr />";

// Elenco associati per selezionare chi intende prendere il libro in prestito
$sql = "SELECT id,cognome,nome from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY cognome,nome;";
$result = $conn->query($sql);
echo "<form action='prestalibro.php' method='get'>";
echo "<input type='hidden' name='idlibro' value=$idlibro>";
echo "chi vuole prenderlo in prestito? ";
echo "<select name='socio'>\n";
while ($row = $result->fetch_assoc())
{
	echo "\t\t\t<option value=\"".intval($row['id'])."\">".$row['cognome']." ".$row['nome']."</option>\n";
}
echo "  	</select>";
echo "<input type='submit' value='Presta'>";
echo "</form>";
?>



</body>
</html>