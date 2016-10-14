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
		<!-- Uso di Bootstrap per rendere la pagina responsive -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	</head>

	<body>
		<div class="container-fluid">
			<header>
				<h1>Elenco soci dell'anno successivo a quello in corso</h1>
			</header>

				<button class="btn" type="button" onclick="javascript:location.href='http://www.biciedintorni.it/application/admin.php?fun=modass'">Menu anagrafiche</button>



			


<?php
/**
 * Anag_ecc File Doc Comment
 *
 * PHP version 5.3
 * Programma che fornisce l'elenco completo delle anagrafiche nel db di
 * Bici e Dintorni che sono iscritte per l'anno successivo a quello in corso
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */

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

$sql = "SELECT id, nome, cognome FROM anagrafiche WHERE a2017 = '1' ORDER BY cognome, nome;" ;
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


$conn->close();

?>
			<footer>
				<hr />
				<button class="btn" type="button" onclick="javascript:location.href='http://www.biciedintorni.it/application/admin.php?fun=modass'">Menu anagrafiche</button>
				<p>
					<a href="http://www.biciedintorni.it/wordpress">FIAB Torino Bici e Dintorni - Home page</a>
				</p>
			</footer>
		</div>
		

	</body>
</html>
