<html>
<body>
	<h1>Ricerca anagrafica per cognome</h1>
	
	<hr />


Cognome cercato: <strong><?php echo $_GET["cognome"]; ?></strong><br><br>
<?php

$cognome = $_GET["cognome"];

//ricerca su DB MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Biciedintorni";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// PROTOTIPO per ricerca anagrafiche non legata ad anno iscrizione
echo "<h1>Elenco Soci</h1>";
//$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE cognome = 'Agnese' LIMIT 0,5 ;" ;
$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE cognome = '$cognome' LIMIT 0,5 ;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
	// output data of each row
	echo "<tr>" .
			"<th>" . "id" . "</th>" .
			"<th>" . "nome" . "</th>" .
			"<th>" . "cognome" . "</th>" .
			"</tr>";
	while($row = $result->fetch_assoc()) {
		echo
		"<tr>" .
		"<td>" . $row["id"]. "</td>" .
		"<td>" . $row["nome"]. "</td>" .
		"<td>" . $row["cognome"]. "</td>" .
		"</tr>";
		//"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
	}
} else {
	echo "0 results";
}
echo "</table>";

// chiusura connessione SQL
$conn->close();

?><br>

<button type="button" onclick="javascript:location.href='anag_cerca.html'">Altra ricerca</button>
<button type="button" onclick="javascript:location.href='index_prova.php'">Avvio menu locale Bici e Dintorni</button>


</body>
</html> 