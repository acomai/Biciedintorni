<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Bici e Dintorni - Anagrafiche dei mai soci</title>
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
				<h1>Elenco anagrafiche senza iscrizioni in archivio Bici e Dintorni</h1>
			</header>


<button type="button" onclick="javascript:location.href='http://www.biciedintorni.it/application/admin.php?fun=modass'">Menu anagrafiche</button>
			


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

$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE a2007 = '0' && a2008 = '0' && a2009 = '0' 
        		 && a2010 = '0' && a2011 = '0' && a2012 = '0' && a2013 = '0'  && a2014 = '0' 
        		&& a2015 = '0' && a2016 = '0' ;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
	// output data of each row
	echo "<tr>" .
			"<th>" . "id" . "</th>" .
			"<th>" . "nome" . "</th>" .
			"<th>" . "cognome" . "</th>" .
			"<th>" . "Modifica" . "</th>" .
			"</tr>";
	while($row = $result->fetch_assoc()) {
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
