<?php
	include_once("lib/class.php");
	
	
	if($_GET['fun'] == 'creadoc')
	{
		require_once('lib/clsMsDocGenerator.php');
		require_once("lib/db_mysql.php");
    	$db = new db_local();
    	//ANNO CORRENTE
    	//$db->query("SELECT anagrafiche.id as 'resp',nome,cognome,tel1,email,gite.*,UNIX_TIMESTAMP(dataeora) as 'data' FROM anagrafiche, gite WHERE YEAR(dataeora) = ".date("Y")." AND anagrafiche.id = gite.idresp AND approvata = 1 ORDER BY dataeora;");
    	//ANNO CORRENTE e FUTURI
    	$db->query("SELECT anagrafiche.id as 'resp',nome,cognome,tel1,email,gite.*,UNIX_TIMESTAMP(dataeora) as 'data' FROM anagrafiche, gite WHERE YEAR(dataeora) >= ".date("Y")." AND anagrafiche.id = gite.idresp AND approvata = 1 ORDER BY dataeora;");
    	$doc = new clsMsDocGenerator();
    	//$doc->addParagraph('Elenco gite approvate '.date("Y"), array('text-align' => 'center', 'font-size' => '16pt', 'font-weight' => 'bold'));
    	$doc->addParagraph('Elenco gite approvate 2010', array('text-align' => 'center', 'font-size' => '16pt', 'font-weight' => 'bold'));
    	$doc->addParagraph('');
    	$doc->addParagraph('');
    	while ($db->next_record()) {
		    $doc->startTable(array('align' => 'center','width' => '10cm'));
		    //$aligns = array('center','center');
		    $doc->addParagraph($giorni[date("w",$db->record['data'])]." ".substr($db->record['dataeora'],8,2)." ".$mesi[date("n",$db->record['data'])]." - ".$db->record['titolo']."<br><br>", array('font-weight' => 'bold','font-size' => '18px','font-family' => 'Comic Sans MS','width' => '10cm'));
		    $cols = array();
		    $strCol = "Itinerario:<br>";
		    $strCol .= $db->record['itinerario']."<br>".$db->record['descrizione'];
		    $cols[] = $strCol;
		    $strCol = "<br>";
		    if($db->record['tipogita'] == 'B')
        		$strCol .= "Bici";
        	elseif ($db->record['tipogita'] == 'BT')
        		$strCol .= "Bici + Treno";
        	else 
        		$strCol .= "Vedi Descrizione";
		    $strCol .= "<br>";
		    $strCol .= "km ".$db->record['km'];
		    $strCol .= "<br>";
		    if($db->record['perc'])
		    {
		    	$strCol .= "(sterrato: ".$db->record['perc']." %)";
		    	$strCol .= "<br>";
		    }
		    $strCol .= "Difficolt&agrave;: ";
		    if($db->record['difficolta'] == 'U')
      			$strCol .= "Molto Facile";
        	elseif($db->record['difficolta'] == 'F')
        		$strCol .= "Facile";
        	elseif ($db->record['difficolta'] == 'M')
        		$strCol .= "Media";
			elseif ($db->record['difficolta'] == 'D')
        		$strCol .= "Impegnativa";
        	elseif ($db->record['difficolta'] == 'X')
        		$strCol .= "Molto Impegnativa";
		    $strCol .= "<br>";
		    $strCol .= "Capogita:<br>";
		    $strCol .= $db->record['nome']." ".$db->record['cognome'];
		    $strCol .= "<br>";
		    $strCol .= "Bici consigliata:";
		    if($db->record['tipobici'] == 'T')
        		$strCol .= "Tutte";
        	elseif ($db->record['tipobici'] == 'V')
        		$strCol .= "Con cambio";
        	elseif ($db->record['tipobici'] == 'C')
        		$strCol .= "Da citt&agrave";
        	else
        		$strCol .= "MTB";
		    $cols[] = $strCol;
		    $aligns = array('justify', 'center'); 
		    $doc->addTableRow($cols, $aligns, "", array('font-family' => 'Arial','width' => '10cm'));
		    //$doc->addTableRow($cols, $aligns, "", array('font-weight' => 'bold'));
		    unset($cols);
		    $doc->endTable();
		    $doc->addParagraph('<br>');
		}
	    $doc->output('Lista gite approvate '.date("Y").'.doc');
	    exit;
	}
	if(is_numeric($_GET['evid']))
	{
		makeHead("Evento","","onload=\"init();\"");
		vis_evento();
		makeTail();
		exit;
	}
	if(is_numeric($_GET['id']))
	{
		vis_gita();
		makeTail();
		exit;
	}
	/*elseif (is_numeric($_GET['iscr']))
	{
		makeHead("Iscrizione");
		iscr_gita();
		makeTail();
		exit;
	}*/
	elseif (is_numeric($_GET['iscrid']))
	{
		include_once("lib/db_mysql.php");
    	$db = new db_local();
    	$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM anagrafiche,iscrizioni WHERE anagrafiche.id = iscrizioni.idassociato AND iscrizioni.idresp <> CONCAT(iscrizioni.idassociato,'-NS') AND iscrizioni.idgita = '".$_GET['iscrid']."' ORDER BY data,anagrafiche.nome;");
		include_once("lib/html/listaisc.php");
		exit;
	}
	makeHead("Gite ed Eventi","","onload=\"init();\"");
?>
<div align="center">
<br>
	<div style="color:blue; font-size:16px;">Ecco l'elenco delle prossime gite</div>
	<div style="color:blue;">
		<a style="font-size:16px;" href="index.php?limit=0" title="Elenco gite <?php echo date("Y");?>">[Visualizza tutte le gite del <?php echo date("Y");?>]</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php if(date("m") >= 11) { ?>
		<a style="font-size:16px;" href="index.php?limit=<?php echo (date("Y")+1); ?>" title="Elenco gite <?php echo (date("Y")+1);?>">[Visualizza tutte le gite del <?php echo (date("Y")+1);?>]</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>
		<a style="font-size:16px;" href="index.php?fun=creadoc" title="Crea Un documento Doc con tutte le gite approvate.">[Scarica doc promemoria gite <?php echo date("Y");?>]</a>
	</div>
	<div style="color:blue;font-size:16px;">Prossime Gite:</div>
  <table width="90%" border=1 align="center" cellpadding="2">
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
    	include_once("lib/db_mysql.php");
    	$db = new db_local();
    	if(isset($_GET['limit']) && $_GET['limit'] == '0')
    		$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE YEAR(dataeora) = ".date("Y")." AND approvata = 1 ORDER BY dataeora;");
		elseif(isset($_GET['limit']))
			$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE YEAR(dataeora) = ".((int)$_GET['limit'])." AND approvata = 1 ORDER BY dataeora;");
    	else
    		$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE(dataeora) >= CURDATE() AND approvata = 1 ORDER BY dataeora LIMIT 0,10 ;");
    	while ($db->next_record()) {
    		/*if($db->record['data'] < time())
    			continue;*/
    		echo 
    		"<tr>\n".
    		"	<td class=\"data\">".date("d/m/Y",$db->record['data'])."</td>\n	";
    		if($db->record['difficolta'] == 'D' || $db->record['difficolta'] == 'X')
    			echo
    			"<td class=\"facili\" width=\"22%\">&nbsp;</td>\n	".
				"<td class=\"facili\" width=\"7%\">&nbsp;</td>\n	".
				"<td class=\"medie\" width=\"22%\">&nbsp;</td>\n	".
				"<td class=\"medie\" width=\"7%\">&nbsp;</td>\n	".
				"<td class=\"difficili\" width=\"22%\"><a class=\"difficili\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
    			"<td class=\"difficili\" width=\"7%\">Km ".$db->record['km']."</td>\n".
				"</tr>\n";
			elseif ($db->record['difficolta'] == 'M')
					echo
    				"<td class=\"facili\" width=\"22%\">&nbsp;</td>\n	".
					"<td class=\"facili\" width=\"7%\">&nbsp;</td>\n	".
					"<td class=\"medie\" width=\"22%\"><a class=\"medie\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
    				"<td class=\"medie\" width=\"7%\">Km ".$db->record['km']."</td>\n	".
					"<td class=\"difficili\" width=\"22%\">&nbsp;</td>\n	".
					"<td class=\"difficili\" width=\"7%\">&nbsp;</td>\n".
					"</tr>\n";
			else 
				echo
				"<td class=\"facili\" width=\"22%\"><a class=\"facili\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n	".
				"<td class=\"facili\" width=\"7%\">Km ".$db->record['km']."</td>\n	".
				"<td class=\"medie\" width=\"22%\">&nbsp;</td>\n	".
				"<td class=\"medie\" width=\"7%\">&nbsp;</td>\n	".
				"<td class=\"difficili\" width=\"22%\">&nbsp;</td>\n	".
				"<td class=\"difficili\" width=\"7%\">&nbsp;</td>\n".
				"</tr>\n";
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
    	include_once("lib/db_mysql.php");
    	$db = new db_local();
    	if($_GET['limitev'] == '0')
    		$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE DATE(dataeora) >= CURDATE() AND approvato = 1 ORDER BY dataeora;");
    	else
    		$db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE DATE(dataeora) >= CURDATE() AND approvato = 1 ORDER BY dataeora LIMIT 0,10 ;");
    	while ($db->next_record())
		{
    		echo 
    		"<tr>\n".
    		"	<td class=\"data\">".date("d/m/Y",$db->record['data'])."</td>\n	".
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
