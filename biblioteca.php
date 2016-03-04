<!DOCTYPE html>
<html lang="it">
<!-- Punto di accesso alla biblioteca di Bici e Dintorni.
Reimpostare, con liste per nazione, argomento, autore, titolo, editore, data  -->
<head>
  <title>FIAB Torino Bici e Dintorni - biblioteca.php</title>
  <meta charset="utf-8">
</head>
<body>

<?php
/**
 * Biblioteca.php File Doc Comment
 *
 * PHP version 5.3
 * Punto di accesso alla biblioteca di Bici e Dintorni
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
    			include_once "lib/html/listalibri.php";
    			makeTail();
    			exit;
}
makeHead("Biblioteca", "", "");
?>
<div align="center">
<br>
<div style="color:blue;">In questa sezione sono elencati le cartine e i libri 
catalogati in biblioteca.<br>Si possono prendere a prestito in sede negli
orari di apertura....vi auguriamo una buona lettura.</div>
<br>
<table width="40%" border="0" align="center" cellpadding="2">
	<tr align="center">
		<td><a href="biblioteca.php?sez=cart">Cartine</a> | </td> 
		<td><a href="biblioteca.php?sez=libri">Libri per nazione</a> | </td>
		<td><a href="biblioteca.php?sez=libri_anno">Libri per data pubblicazione</a> | </td> 
		<td><a href="biblioteca.php?sez=libri_titolo">Libri per titolo</a> | </td>
		<td><a href="biblioteca.php?sez=libri_autore">Libri per autore</a> | </td> 
		<td><a href="biblioteca.php?sez=libri_argomento">Libri per argomento</a></td>
		
	</tr>
</table>
</div>
<br>
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

$sql = "SELECT id, nome FROM argomenti ORDER BY nome;" ;
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
	// output data of each row
	echo "<tr>" .
			"<th align='left'>" . "id" . "</th>" .
			"<th align='left'>" . "Argomenti" . "</th>" .
			"</tr>";
	while ($row = $result->fetch_assoc()) {
		echo
		"<tr>" .
		"<td>" . $row["id"]. "</td>" .
		"<td>" . $row["nome"]. "</td>" .
		//"<td><a href=\"admin.php?fun=modass&id=".$row['id']."\">Modifica</a></td>" .
		"</tr>";
		//"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
	}
} else {
	echo "0 results";
}
echo "</table>";

makeTail();
exit;
?>

</body>
</html>