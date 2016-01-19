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
				<p> <a href="anag_cerca.html">Ricerca anagrafica per cognome</a>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>

			<div>
				<a href="ElencoClienti.php">Elenco clienti</a> - Nuovo cliente<br />
				<a href="ElencoFatture.php">Elenco fatture</a>  - <a href="jsFattura.html">Nuova fattura</a> <br />
				profilo
				
			</div>
<p>Digitare cognome: <input id="cognome" type="text"> <output id="demo"></output></p>

 <!-- PROVVISORIO: bisogna selezionare il cliente da una lista -->
<p>Digitare numero cliente: <input id="cliente" type="number"> <output id="demo2"></output></p>	

<button type="button" onclick="verificaAnagrafica()">Calcola</button>
<button type="button" onclick="esci()">Esci</button>



<script>
function esci() {
	//sostituisce la finestra con una di saluto. Così comunque non funziona (lo script rimane attivo).
	var myWindow = window.open("", "_self");
    myWindow.document.write("<p>Arrivederci.</p>");
}

function verificaAnagrafica() {
	//da fare.
	// Get the value of the input field with id="numb"
    cognome = document.getElementById("cognome").value;
    // inizializza output
    document.getElementById("demo").innerHTML = "";
    // scrive in output l'input digitato
    document.getElementById("demo").innerHTML = "cognome digitato: " + x;
}
</script>

<h1>Elenco Gite</h1>

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


$sql = "SELECT id, titolo, tipogita FROM gite LIMIT 0,10 ;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" . 
    "<th>" . "id" . "</th>" . 
    "<th>" . "titolo" . "</th>" .
	"<th>" . "tipogita" . "</th>" .
	"</tr>";
    while($row = $result->fetch_assoc()) {
        echo 
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td>" . $row["titolo"]. "</td>" .
        "<td>" . $row["tipogita"]. "</td>" .
        "</tr>";
        //"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
    }
} else {
    echo "0 results";
}
echo "</table>";

// PROTOTIPO per ricerca anagrafiche non legata ad anno iscrizione
echo "<h1>Elenco Soci</h1>";
$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE cognome = 'Agnese' LIMIT 0,5 ;" ;
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

// Elenco soci senza iscrizioni
echo "<h1>Elenco Soci senza iscrizioni</h1>";
$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE a2007 = '0' && a2008 = '0' && a2009 = '0' 
        		 && a2010 = '0' && a2011 = '0' && a2012 = '0' && a2013 = '0'  && a2014 = '0' 
        		&& a2015 = '0'  ;" ;
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




$conn->close();

?>
			<footer>
				<p>
					&copy; Copyright  by Adriano
				</p>
			</footer>
		</div>
		

	</body>
</html>
