<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>fatture</title>
		<meta name="description" content="">
		<meta name="author" content="Adriano">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>

	<body>
		<div>
			<header>
				<h1>Prova lancio app Bici e Dintorni</h1>
			</header>
			<nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>

			<div>
				<a href="ElencoClienti.php">Elenco clienti</a> - Nuovo cliente<br />
				<a href="ElencoFatture.php">Elenco fatture</a>  - <a href="jsFattura.html">Nuova fattura</a> <br />
				profilo
				<?php echo 'While this is going to be parsed.'; ?>
			</div>

			<footer>
				<p>
					&copy; Copyright  by Adriano
				</p>
			</footer>
		</div>
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Fatture";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, rag_sociale, indirizzo, cap, comune, provincia, stato, cod_fiscale FROM Clienti";
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" . 
    "<th>" . "id" . "</th>" . 
    "<th>" . "Ragione sociale" . "</th>" .
	"<th>" . "Indirizzo" . "</th>" .
	"<th>" . "Cap" . "</th>" .
	"<th>" . "Comune" . "</th>" . 
	"<th>" . "Provincia" . "</th>" .
	"<th>" . "Stato" . "</th>" .
	"<th>" . "Codice fiscale" . "</th>" .
	"</tr>";
    while($row = $result->fetch_assoc()) {
        echo 
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td>" . $row["rag_sociale"]. "</td>" .
        "<td>" . $row["indirizzo"]. "</td>" .
        "<td>" . $row["cap"]. "</td>" .
        "<td>" . $row["comune"]. "</td>" .
        "<td>" . $row["provincia"]. "</td>" .
        "<td>" . $row["stato"]. "</td>" .
        "<td>" . $row["cod_fiscale"]. "</td>" .
        "</tr>";
        //"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
    }
} else {
    echo "0 results";
}
echo "</table>";

$conn->close();

?>		
<hr />
<?php
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


$sql = "SELECT id, titolo, tipogita, socio_2016 FROM gite WHERE YEAR(dataeora) = ".date("Y");
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" . 
    "<th>" . "id" . "</th>" . 
    "<th>" . "Titolo" . "</th>" .
	"<th>" . "Tipogita" . "</th>" .
	"<th>" . "Socio 2016" . "</th>" .
	"</tr>";
    while($row = $result->fetch_assoc()) {
        echo 
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td>" . $row["titolo"]. "</td>" .
        "<td>" . $row["tipogita"]. "</td>" .
        "<td>" . $row["2016"]. "</td>" .
        "</tr>";
        //"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
    }
} else {
    echo "0 results";
}
echo "</table>";

$conn->close();

?>		
	</body>
</html>
