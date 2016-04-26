<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Scarico da tabella cartine a tabella libri</title>
		<!-- Programma una tantum per recuperare le cartine dalla tabella a sè stante e inserirle 
		come occorrenze della tabella libri, con id argomento = "6" 
		Fatto girare il 26/4/2016 -->
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
				<h1>Scarico da tabella cartine a tabella libri</h1>
			</header>

<button type="button" onclick="javascript:location.href='anag_cerca.html'">Menu locale Bici e Dintorni</button>

<?php
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


$sql = "SELECT * FROM cartine;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
	// output data of each row

	while($row = $result->fetch_assoc()) {
		$id = $row["id"];
		$idnazione = $row["idnazione"];
		$titolo = $row["titolo"];
		$autore = $row["autore"];
		$lingua = $row["lingua"];
		$anno = $row["anno"];
		$editore = $row["editore"];
		$citta = $row["citta"];
		$sottotitolo = $row["sottotitolo"];
		$note = " Scala: ";
		$note .= $row["scala"];
		$scaffale = $row["scaffale"];
		$classificazione = $row["classificazione"];
		$descrizione = $row["descrizione"];
		$costo = $row["costo"];
		$idarg = 6;
		$pagine = 0;
		
		$sql2 = "INSERT INTO libri (titolo,sottotitolo,autore,editore,citta,anno,pagine,lingua,note,costo,scaffale,classificazione,descrizione,idnazione,idarg) 
				VALUES ('".$titolo."','".$sottotitolo."','".$autore."','".$editore."','".$citta."','".$anno."','".$pagine."','".$lingua."','".$note."','".$costo."','".$scaffale."','".$classificazione."','".$descrizione."','".$idnazione."','".$idarg."');";
		$result2 = $conn->query($sql2);
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
