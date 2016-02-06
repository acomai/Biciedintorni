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
		<td><a href="biblioteca.php?sez=cart">Cartine</a></td> 
		<td><a href="biblioteca.php?sez=libri">Libri</a></td> 
	</tr>
</table>
</div>
<br>
<!--<div align= "right"><a href="admin.php" target="_parent"><img alt="Amministrazione" src="img/lucchetto.jpg" width="50" height="50"></a></div>-->
<?php  
makeTail();
exit;
?>
<table width="40%" border="1" align="center" cellpadding="2">
	<tr>
		<td colspan="7" style="color:green" align="center">GITE</td>
	</tr>
	<tr>
		<td class="data" width="13%">Data</td>
		<td class="facili" colspan="2">Facili</td> 
		<td class="medie" colspan="2">Medie</td> 
		<td class="difficili" colspan="2">Impegnative</td>
	</tr>
<?php
        require_once "lib/db_mysql.php";
        $db = new db_local();
if ($_GET['limit'] == '0') {
    $db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE(dataeora) >= CURDATE() AND approvata = 1 ORDER BY dataeora;"); 
}
else {
    $db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE(dataeora) >= CURDATE() AND approvata = 1 ORDER BY dataeora LIMIT 0,10 ;"); 
}
while ($db->next_record()) {
    /*if($db->record['data'] < time())
				continue;*/
    echo 
    "<tr>\n".
    "	<td class=\"data\">".date("d/m/Y", $db->record['data'])."</td>\n	";
    if ($db->record['difficolta'] == 'D') {
                echo
                "<td class=\"facili\" width=\"22%\">&nbsp;</td>\n	".
                "<td class=\"facili\" width=\"7%\">&nbsp;</td>\n	".
                "<td class=\"medie\" width=\"22%\">&nbsp;</td>\n	".
                "<td class=\"medie\" width=\"7%\">&nbsp;</td>\n	".
                "<td class=\"difficili\" width=\"22%\"><a class=\"difficili\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
                "<td class=\"difficili\" width=\"7%\">Km ".$db->record['km']."</td>\n".
                "</tr>\n"; 
    }
    elseif ($db->record['difficolta'] == 'M') {
        echo
        "<td class=\"facili\" width=\"22%\">&nbsp;</td>\n	".
        "<td class=\"facili\" width=\"7%\">&nbsp;</td>\n	".
        "<td class=\"medie\" width=\"22%\"><a class=\"medie\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
        "<td class=\"medie\" width=\"7%\">Km ".$db->record['km']."</td>\n	".
        "<td class=\"difficili\" width=\"22%\">&nbsp;</td>\n	".
        "<td class=\"difficili\" width=\"7%\">&nbsp;</td>\n".
        "</tr>\n"; 
    }
    else { 
        echo
        "<td class=\"facili\" width=\"22%\"><a class=\"facili\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
        "<td class=\"facili\" width=\"7%\">Km ".$db->record['km']."</td>\n	".
        "<td class=\"medie\" width=\"22%\">&nbsp;</td>\n	".
        "<td class=\"medie\" width=\"7%\">&nbsp;</td>\n	".
        "<td class=\"difficili\" width=\"22%\">&nbsp;</td>\n	".
        "<td class=\"difficili\" width=\"7%\">&nbsp;</td>\n".
        "</tr>\n"; 
    }
    //.date('d.m.Y H:i:s', $time);
}
    $db->close();
    ?>
</table>
<br>
<table width="90%" border=1 align="center" cellpadding="2">
	<tr>
		<td colspan="2" style="color:green" align="center">EVENTI</td>
	</tr>
		<tr>
			<td class="data" width="13%">Data</td>
			<td class="difficili">Titolo</td>
		</tr>
    <?php
    unset($db);
    require_once "lib/db_mysql.php";
    $db = new db_local();
    if ($_GET['limitev'] == '0') {
        $db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE DATE(dataeora) >= CURDATE() AND approvato = 1 ORDER BY dataeora;"); 
    }
    else {
        $db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE DATE(dataeora) >= CURDATE() AND approvato = 1 ORDER BY dataeora LIMIT 0,10 ;"); 
    }
    while ($db->next_record()) {
        echo 
        "<tr>\n".
        "	<td class=\"data\">".date("d/m/Y", $db->record['data'])."</td>\n	".
        "	<td class=\"difficili\"><a class=\"difficili\" href=\"index.php?evid=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
        "</tr>\n";
    }
    $db->close();
    ?>
	</table>
</div>
<br>
<div align= "right"><a href="admin.php" target="_parent"><img alt="Amministrazione" src="img/lucchetto.jpg" width="50" height="50"></a></div>
<?php  
makeTail();
?>
