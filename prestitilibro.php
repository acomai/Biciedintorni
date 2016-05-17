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
 * Prestitilibro.php File Doc Comment
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

//inizializzazione variabili libro e socio
$idlibro = " ";
$idsocio = " ";



//parametri connessione al DB
$servername = "62.149.150.56";
$username = "Sql145958";
$password = "c36d0fc2";
$dbname = "Sql145958_1";

//logica generale - distingue se è stata richiesta una visualizzazione, un prestito o una restituzione
if(isset($_POST['prestito']))
{
	$idlibro = $_POST['idlibro'];
	$idsocio = $_POST['idsocio'];
	prestito_libro($idlibro,$idsocio);
} elseif (isset($_POST['restituzione'])) {
	$idlibro = $_POST['idlibro'];
	restituzione_libro($idlibro);
} else {
	$idlibro = $_GET['id'];
	visualizzazione_libro();
}


function prestito_libro($in_libro, $in_socio) {
	
	$idlibro = $in_libro;
	$idsocio = $in_socio;
	
	//data del giorno corrente
	$oggi = date("Y/m/d");
	
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
	$sql = "INSERT into prestiti (idlibro, idassociato, dataprestito)
		VALUES ('".$idlibro."','".$idsocio."','".$oggi."');" ;
	$result = $conn->query($sql);
	
	// Nuova visualizzazione del libro, con la nuova situazione
	$pagina = 'prestitilibro.php?id=' . $idlibro;
	header("Refresh:3, url=$pagina");
	echo "<h3 style='color:red; text-align:center'>il prestito è stato registrato</h3><br><br>";
};

function restituzione_libro($in_libro) {
	
	$idlibro = $in_libro;
	
	//data del giorno corrente
	$oggi = date("Y/m/d");
	
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
	// Registrazione della restituzione
	$sql = "UPDATE prestiti SET datarestituzione = '".$oggi."' WHERE idlibro = '".$idlibro."' AND datarestituzione IS NULL;" ;
	$result = $conn->query($sql);
	
	// Nuova visualizzazione del libro, con la nuova situazione
	$pagina = 'prestitilibro.php?id=' . $idlibro;
	header("Refresh:3, url=$pagina");
	echo "<h3 style='color:red; text-align:center'>La restituzione è stata registrata</h3><br><br>";
};

function visualizzazione_libro() {

	
	$idlibro = $_GET['id'];
	
	echo "<h3>Libro</h3>";
	
	
	echo "id = ";
	
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
	
	// Ricerca del libro sul DB
	$sql = "SELECT id, titolo, autore, anno FROM libri WHERE id = $idlibro;" ;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$titolo = $row['titolo'];
			$autore = $row['autore'];
			$anno = $row['anno'];
			echo $idlibro . " - " . $titolo . " - " . $autore . " - " . $anno;
		}
	} else {
		echo "0 results";
	}
	
	echo "<hr />";
	
	// Ricerca dei prestiti del libro sul DB
	
	echo "<h3>Lista prestiti</h3>";
	
	// impostazione flag che indica se il libro risulta in prestito
	$inprestito = false;
	
	$sql = "SELECT * FROM prestiti WHERE idlibro = $idlibro ORDER BY dataprestito DESC;" ;
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$associato = $row['idassociato'];
			// trova nome e cognome del socio
			$sql2 = "SELECT id, nome, cognome FROM anagrafiche WHERE id = $associato";
			$result2 = $conn->query($sql2);
			while ($row2 = $result2->fetch_assoc()){
				$nomesocio = $row2['nome']; 
				$cognomesocio = $row2['cognome'];
			}
			$dataprestitodadb = strtotime($row['dataprestito']);
			$dataprestito = date("d M Y", $dataprestitodadb);
			
			//test per datarestituzione = null
			if (is_null($row['datarestituzione'])) {
				$datarestituzione = "da restituire";
				$inprestito = true;
			} else {
				$datarestituzionedadb = strtotime($row['datarestituzione']);
				$datarestituzione = date("d M Y", $datarestituzionedadb);
			}
					
			echo "- " . $associato . " - " . $nomesocio . " " . $cognomesocio . 
			" - " . $dataprestito . " - " . $datarestituzione . "<br>";
		}
	} else {
		echo "Nessun prestito per il libro";
	}
	
	echo "<hr />";
	
	// Elenco associati per selezionare chi intende prendere il libro in prestito
	if ($inprestito) {
		echo "<h3>Restituzione</h3>";
		echo "<form method='post' action='".htmlentities($_SERVER["PHP_SELF"])."?fun=restituzione'>";
		echo "<input type='hidden' name='idlibro' value=$idlibro>";
		echo "<input type='submit' name='restituzione' value='Segna come restituito'>";
		echo "</form>";
	} else {
		echo "<h3>Nuovo prestito</h3>";
		$sql = "SELECT id,cognome,nome from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY cognome,nome;";
		$result = $conn->query($sql);
		echo "<form method='post' action='".htmlentities($_SERVER["PHP_SELF"])."?fun=prestito'>";
		//echo "<form action='prestalibro.php' method='get'>";
		echo "<input type='hidden' name='idlibro' value=$idlibro>";
		echo "A chi? ";
		echo "<select name='idsocio'>\n";
		while ($row = $result->fetch_assoc())
		{
			echo "\t\t\t<option value=\"".intval($row['id'])."\">".$row['cognome']." ".$row['nome']."</option>\n";
		}
		echo "  	</select>";
		echo "<input type='submit' name='prestito' value='Presta'>";
		echo "</form>";
	}
}
?>



</body>
</html>