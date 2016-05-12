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
 * Presta.php File Doc Comment
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
$idlibro = $_GET["idlibro"];
$idsocio = $_GET["socio"];
$oggi = date("Y/m/d");
echo "Libro cercato: <strong>" . $_GET["idlibro"] . "</strong> - Socio: <strong>" . 
$_GET["socio"] . "</strong> in data " . $oggi; 

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
// Registrazione del prestito
$sql = "INSERT into prestiti (idlibro, idassociato, dataprestito, datarestituzione)
VALUES ('".$idlibro."','".$idsocio."','".$oggi."','".$oggi."');" ;
$result = $conn->query($sql);



?>
</body>
</html>