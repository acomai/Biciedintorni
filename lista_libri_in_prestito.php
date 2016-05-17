<!DOCTYPE html>
<html lang="it">
<!-- Gestione prestiti della biblioteca di Bici e Dintorni.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - Visualizzazione libri in prestito</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>

<?php
/**
 * lista_libri_in_prestito.php File Doc Comment
 *
 * PHP version 5.3
 * Visualizzazione dei libri in prestito nella biblioteca di Bici e Dintorni
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */
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

/* change character set to utf8 */
if (!$conn->set_charset("utf8")) {
	printf("Error loading character set utf8: %s\n", $conn->error);
	exit();
}

echo "<h3>Libri attualmente in prestito</h3>";

// Selezione dei libri in prestito
$sql = "SELECT * FROM prestiti, libri, anagrafiche WHERE libri.id = prestiti.idlibro  
		AND anagrafiche.id = prestiti.idassociato AND datarestituzione IS NULL ORDER BY dataprestito ASC;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$idlibro = $row['idlibro'];
		$titolo = $row['titolo'];
		$idassociato = $row['idassociato'];
		$nome = $row['nome'];
		$cognome = $row['cognome'];
		$user = $row['user'];
		$telefono = $row['tel1'];
		$email = $row['email'];
		$dataprestitodadb = strtotime($row['dataprestito']);
		$dataprestito = date("d-m-Y", $dataprestitodadb);
		
		//
		
		echo $idlibro . " - " . "<a href='prestitilibro.php?id=$idlibro'>" . $titolo . "</a> - prestato il "
			. $dataprestito. " a <a href='admin.php?fun=modass&id=$idassociato'>" . $nome . 
		" " . $cognome . "</a> - tel. " . $telefono . " - email <a href='mailto:$email'>" . $email . "</a><br>";
	}
} else {
	echo "0 results";
}

?>
</body>
</html>