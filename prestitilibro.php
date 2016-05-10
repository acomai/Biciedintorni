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

require_once "lib/class.php";


if ($_GET['fun'] == 'viscart') {
    makeHead("Biblioteca->Cartina", "", "");
    vis_cart();
    makeTail();
    exit;
}

if ($_GET['fun'] == 'vislibro') {
    makeHead("Biblioteca->Libro", "", "");
    vis_libro();
    makeTail();
    exit;
}

if ($_GET['sez'] == 'cart') {
    makeHead("Biblioteca->Cartine", "", "");
    include_once "lib/db_mysql.php";
    $db = new db_local();
    $strqry = "SELECT cartine.*, nazioni.id as idnaz, nazioni.nome as nazione FROM cartine INNER JOIN nazioni ON cartine.idnazione=nazioni.id";
    if (is_numeric($_GET['idnaz'])) {
        $strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    }
    $db->query($strqry . $strWhere . " ORDER BY nazione,titolo");
    include_once "lib/html/listacart.php";
    makeTail();
    exit;
} elseif ($_GET['sez'] == 'libri') {
    makeHead("Biblioteca->Libri", "", "");
    include_once "lib/db_mysql.php";
    $db = new db_local();
    $strqry = "SELECT libri.*, nazioni.id as idnaz, nazioni.nome as nazione, argomenti.nome as argomento FROM (libri INNER JOIN nazioni ON libri.idnazione=nazioni.id) INNER JOIN argomenti ON libri.idarg=argomenti.id";
    if (is_numeric($_GET['idnaz'])) {
        $strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    }
    if (is_numeric($_GET['idarg'])) {
        if ($strWhere == '') { 
            $strWhere = " WHERE idarg = '" . $_GET['idarg'] . "'"; 
        }
        else {
            $strWhere = $strWhere . " AND idarg = '" . $_GET['idarg'] . "'"; 
        }
    }
    $db->query($strqry . $strWhere . " ORDER BY nazione,titolo");
    $ordinamento = "nazione";
    include_once "lib/html/listalibri.php";
    makeTail();
    exit;
} elseif ($_GET['sez'] == 'libri_anno') {
   	makeHead("Biblioteca->Libri", "", "");
    include_once "lib/db_mysql.php";
    $db = new db_local();
    $strqry = "SELECT libri.*, nazioni.id as idnaz, nazioni.nome as nazione, argomenti.nome as argomento FROM (libri INNER JOIN nazioni ON libri.idnazione=nazioni.id) INNER JOIN argomenti ON libri.idarg=argomenti.id";
    if (is_numeric($_GET['idnaz'])) {
    	$strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    }
   	if (is_numeric($_GET['idarg'])) {
   		if ($strWhere == '') {
            $strWhere = " WHERE idarg = '" . $_GET['idarg'] . "'";
    	}
    	else {
    		$strWhere = $strWhere . " AND idarg = '" . $_GET['idarg'] . "'";
    	}
   	}
    $db->query($strqry . $strWhere . " ORDER BY anno DESC,titolo");
    $ordinamento = "anno";
    include_once "lib/html/listalibri.php";
    makeTail();
    exit;
    } elseif ($_GET['sez'] == 'libri_titolo') {
    	makeHead("Biblioteca->Libri", "", "");
    	include_once "lib/db_mysql.php";
    	$db = new db_local();
    	$strqry = "SELECT libri.*, nazioni.id as idnaz, nazioni.nome as nazione, argomenti.nome as argomento FROM (libri INNER JOIN nazioni ON libri.idnazione=nazioni.id) INNER JOIN argomenti ON libri.idarg=argomenti.id";
    	if (is_numeric($_GET['idnaz'])) {
    		$strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    	}
    	if (is_numeric($_GET['idarg'])) {
    		if ($strWhere == '') {
    			$strWhere = " WHERE idarg = '" . $_GET['idarg'] . "'";
    		}
    		else {
    			$strWhere = $strWhere . " AND idarg = '" . $_GET['idarg'] . "'";
    		}
    	}
    	$db->query($strqry . $strWhere . " ORDER BY titolo");
    	$ordinamento = "titolo";
    	include_once "lib/html/listalibri.php";
    	makeTail();
    	exit;
    	} elseif ($_GET['sez'] == 'libri_autore') {
    		makeHead("Biblioteca->Libri", "", "");
    		include_once "lib/db_mysql.php";
    		$db = new db_local();
    		$strqry = "SELECT libri.*, nazioni.id as idnaz, nazioni.nome as nazione, argomenti.nome as argomento FROM (libri INNER JOIN nazioni ON libri.idnazione=nazioni.id) INNER JOIN argomenti ON libri.idarg=argomenti.id";
    		if (is_numeric($_GET['idnaz'])) {
    			$strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    		}
    		if (is_numeric($_GET['idarg'])) {
    			if ($strWhere == '') {
    				$strWhere = " WHERE idarg = '" . $_GET['idarg'] . "'";
    			}
    			else {
    				$strWhere = $strWhere . " AND idarg = '" . $_GET['idarg'] . "'";
    			}
    		}
    		$db->query($strqry . $strWhere . " ORDER BY autore, titolo");
    		$ordinamento = "autore";
    		include_once "lib/html/listalibri.php";
    		makeTail();
    		exit;
    		} elseif ($_GET['sez'] == 'libri_argomento') {
    			makeHead("Biblioteca->Libri", "", "");
    			include_once "lib/db_mysql.php";
    			$db = new db_local();
    			$strqry = "SELECT libri.*, nazioni.id as idnaz, nazioni.nome as nazione, argomenti.nome as argomento FROM (libri INNER JOIN nazioni ON libri.idnazione=nazioni.id) INNER JOIN argomenti ON libri.idarg=argomenti.id";
    			if (is_numeric($_GET['idnaz'])) {
    				$strWhere = " WHERE idnazione = '" . $_GET['idnaz'] . "'";
    			}
    			if (is_numeric($_GET['idarg'])) {
    				if ($strWhere == '') {
    					$strWhere = " WHERE idarg = '" . $_GET['idarg'] . "'";
    				}
    				else {
    					$strWhere = $strWhere . " AND idarg = '" . $_GET['idarg'] . "'";
    				}
    			}
    			$db->query($strqry . $strWhere . " ORDER BY argomento, titolo");
    			$ordinamento = "tipo";
    			include_once "lib/html/listalibri.php";
    			makeTail();
    			exit;
}
makeHead("Biblioteca", "", "");
?>
<div align="center">
<h4>FIAB Torino Bici e Dintorni - Biblioteca</h4>
<br>
<div style="color:blue;">Abbiamo una delle biblioteche sulla bici, la mobilità urbana e il cicloturismo più ricche in Italia.</div>
<p>I soci possono prendere a prestito i libri e le cartine,
<a href="http://www.biciedintorni.it/wordpress/contatti-2/"> in sede negli orari di apertura.</a></p></div>
<br>
<!-- <table width="40%" border="0" align="center" cellpadding="2">
	<tr align="center">
		<td><a href="biblioteca.php?sez=cart">Cartine</a> | </td> 
		<td>Libri ordinati per: </td>
		<td><a href="biblioteca.php?sez=libri_titolo">titolo</a> | </td>
		<td><a href="biblioteca.php?sez=libri_anno">anno pubblicazione</a> | </td>
		<td><a href="biblioteca.php?sez=libri_argomento">tipo</a> | </td>
		<td><a href="biblioteca.php?sez=libri_autore">autore</a> | </td>
		<td><a href="biblioteca.php?sez=libri">nazione</a></td>
	</tr>
	<tr align="center">
		<td>Ricerca nel titolo: <input id="titolo_parz" type="text" required> 
					<output id="demo"></output> <button type="button" onclick="cercaLibroPerTitolo()">Cerca</button></td>
	</tr>
</table>  -->
<p align="center"><a href="biblioteca.php?sez=cart">Cartine</a> | Libri ordinati per: <a href="biblioteca.php?sez=libri_titolo">titolo</a> | 
<a href="biblioteca.php?sez=libri_anno">anno pubblicazione</a> | <a href="biblioteca.php?sez=libri_argomento">tipo</a> | 
<a href="biblioteca.php?sez=libri_autore">autore</a> | <a href="biblioteca.php?sez=libri">nazione</a></p>
<p align="center">Ricerca nel titolo: <input id="titolo" type="text"> 
<button type="button" onclick="cercaLibroPerTitolo()">Cerca</button></p> 
<!-- <output id="demo"></output> -->
	


</div>
<br>
<script>

function cercaLibroPerTitolo() {
	//da fare.
	// Get the value of the input field with id="numb"
    titolo = document.getElementById("titolo").value;
    // inizializza output
    //document.getElementById("demo").innerHTML = "";
    // scrive in output l'input digitato
    //document.getElementById("demo").innerHTML = "termine digitato: " + titolo;
    //preparazione per richiamo funzione php con parametro cognome. 
	window.location.href = "libro_cerca_per_titolo.php?titolo=" + titolo;
}
</script>
<!--<div align= "right"><a href="admin.php" target="_parent"><img alt="Amministrazione" src="img/lucchetto.jpg" width="50" height="50"></a></div>-->
<?php  
// elenco argomenti
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
// Elenco delle tipologie di libro presenti in biblioteca
$sql = "SELECT nome, id FROM argomenti ORDER BY nome;" ;
$result = $conn->query($sql);
echo "<strong>Tipologie di libri: </strong>";
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$idarg = $row['id'];
		echo "<a href='libro_cerca_per_argomento.php?arg=$idarg'>". $row["nome"]. "</a>". " | ";
	}
} else {
	echo "0 results";
}

echo "<hr />";

// Elenco delle nazioni a cui si riferiscono libri presenti in biblioteca
$sql = "SELECT nome, id FROM nazioni ORDER BY nome;" ;
$result = $conn->query($sql);
echo "<strong>Nazioni su cui esistono libri nella nostra biblioteca: </strong>";
if ($result->num_rows > 0) {
	// output data of each row
	while ($row = $result->fetch_assoc()) {
		$idnaz = $row['id'];
		echo "<a href='libro_cerca_per_nazione.php?nazione=$idnaz'>". $row["nome"]. "</a>". " | ";
	}
} else {
	echo "0 results";
}

echo "<hr />";

makeTail();
exit;
?>



</body>
</html>