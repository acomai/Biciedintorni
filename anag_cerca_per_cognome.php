<html>
<body>
	<h1>Ricerca anagrafica per cognome</h1>
	
	<hr />


Cognome cercato: <strong><?php echo $_GET["cognome"]; ?></strong><br><br>
<?php

/**
 * Anag_cerca_per_cognome.php File Doc Comment
 *
 * PHP version 5.3
 * Programma che fornisce l'elenco delle anagrafiche nel db di
 * Bici e Dintorni per il cognome cercato (con iniziale maiuscola)
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */

$cognome = $_GET["cognome"];

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

// PROTOTIPO per ricerca anagrafiche non legata ad anno iscrizione
echo "<h1>Elenco Soci</h1>";
//$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE cognome = 'Agnese' LIMIT 0,5 ;" ;
$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE cognome = '$cognome' LIMIT 0,5 ;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" .
    "<th align='left'>" . "id" . "</th>" .
    "<th align='left'>" . "Nome" . "</th>" .
    "<th align='left'>" . "Cognome" . "</th>" .
    "<th align='left'>" . " " . "</th>" .
    "</tr>";
    while ($row = $result->fetch_assoc()) {
        echo
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td>" . $row["nome"]. "</td>" .
        "<td>" . $row["cognome"]. "</td>" .
        "<td><a href=\"admin.php?fun=modass&id=".$row['id']."\">Modifica</a></td>" .
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
		<footer>
				<hr />
				<button type="button" onclick="javascript:location.href='http://www.biciedintorni.it/application/anag_cerca.html'">Altra ricerca</button>
				<button type="button" onclick="javascript:location.href='http://www.biciedintorni.it/application/admin.php?fun=modass'">Menu anagrafiche</button>
				<p>
					<a href="http://www.biciedintorni.it/wordpress">FIAB Torino Bici e Dintorni - Home page</a>
				</p>
			</footer>


</body>
</html> 