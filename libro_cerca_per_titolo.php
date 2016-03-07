<!DOCTYPE html>
<html lang="it">
<!-- Biblioteca di Bici e Dintorni.
Visualizzazione libri che contengono termine cercato  -->
<head>
  <title>FIAB Torino Bici e Dintorni - libro_cerca_per_titolo.php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">

	<div class="row">
		<div class="col-xs-12 text-center">FIAB Torino Bici e Dintorni - Ricerca libri - <a href="biblioteca.php">Menu Biblioteca</a></div>
	</div>
	<div class="row">
		<div class="col-xs-12">Termine cercato: <strong><?php echo $_GET["titolo"]; ?></strong></div>
	</div>
	<hr />

<?php

/**
 * Anag_cerca_per_cognome.php File Doc Comment
 *
 * PHP version 5.3
 * Programma che fornisce l'elenco dei libri nel db di
 * Bici e Dintorni che contengono il termine cercato (con iniziale maiuscola)
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */

$titolo = $_GET["titolo"];

//ricerca su DB MySQL
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

// Ricerca libri con termine cercato

//$sql = "SELECT id, titolo, anno, descrizione FROM libri WHERE titolo LIKE '%$titolo%' LIMIT 0,5 ;" ;
$sql = "SELECT id, titolo, anno, descrizione FROM libri WHERE titolo LIKE '%$titolo%';" ;

$result = $conn->query($sql);

// impostazione output
/*
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" .
    "<th align='left'>" . "id" . "</th>" .
    "<th align='left'>" . "Titolo" . "</th>" .
    "<th align='left'>" . "Anno" . "</th>" .
    "<th align='left'>" . "Descrizione" . "</th>" .
    "<th align='left'>" . " " . "</th>" .
    "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td><a href=\"biblioteca.php?fun=vislibro&amp;id=" . $row['id'] . "\">" . $row["titolo"]. "</a></td>" .
        "<td>" . $row["anno"]. "</td>" .
        "<td>" . $row["descrizione"]. "</td>" .
        "</tr>";
        //"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
    }
} else {
    echo "0 results";
}
echo "</table>";
*/

if ($result->num_rows > 0) {
	// output data of each row
	echo "<div class='row'>";
		echo "<div class='col-xs-1'>" . "id" . "</div>";
		echo "<div class='col-xs-4'>" . "Titolo" . "</div>";
		echo "<div class='col-xs-1'>" . "Anno" . "</div>";
		echo "<div class='col-xs-6'>" . "Descrizione" . "</div>";
	echo "</div>";
	while ($row = $result->fetch_assoc()) {
		echo "<div class='row'>";
		echo "<div class='col-xs-1'>" . $row["id"]. "</div>";
		echo "<div class='col-xs-4'>" . "<a href=\"biblioteca.php?fun=vislibro&amp;id=" . $row['id'] . "\">" . $row["titolo"]. "</a>" . "</div>";
		echo "<div class='col-xs-1'>" . $row["anno"]. "</div>";
		echo "<div class='col-xs-6'>" . $row["descrizione"]. "</div>";
		echo "</div>";
		//"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
	}
} else {
	echo "<div class='row'>";
		echo "<div class='col-xs-12'>" . "0 results" . "</div>";
	echo "</div>";
}


// chiusura connessione SQL 
$conn->close();

?><hr />
		<div class="row">
		<div class="col-xs-12 text-center">
				Pagina iniziale: <a href="http://www.biciedintorni.it/wordpress">FIAB Torino Bici e Dintorni</a> - <a href="mailto://info.biciedintorni.it">info@biciedintorni.it</a>
		</div>
		</div>
		
</div>
</body>
</html> 