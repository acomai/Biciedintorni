<!DOCTYPE html>
<html lang="it">
<!-- Gestisce la visualizzazione gite nell'applicativo di Bici e Dintorni.
	Consente l'iscrizione.  -->
<head>
  <!--  title>FIAB Torino Bici e Dintorni - gita - <?php echo $db->record['titolo']; ?></title>-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">

<?php
if($db->next_record())
{ 
	$ciscr = new db_local();
	if($ciscr->query("SELECT COUNT(*) AS niscr FROM iscrizioni WHERE idgita = '".$db->record['id']."';",true))
	{
		if($ciscr->next_record())
			$niscri = $ciscr->record['niscr'];
		else 
			echo "Errore vis_gita 'numero iscritti' iscr, query falsa.";
	}
	$ciscr->close();
	unset($ciscr);
	?><div id="tddata">Data: <?php echo substr($db->record['dataeora'],8,2)."/".substr($db->record['dataeora'],5,2)."/".substr($db->record['dataeora'],0,4);
									if($niscri > 0)
										echo ", <a href=\"index.php?iscrid=".$db->record['id']."\">Numero iscritti: $niscri</a>";
									/*else 
										echo ", Nessun iscritto a questa gita.";*/
									
makeHead("Bici e Dintorni - ".$db->record['titolo'],"","onload=\"init();\"");
?></div>

<div id="title" align="center"><?php echo $db->record['titolo']; ?></div>
<div id="tdresp" align="center">Capogita: <?php if ($db->record['email'] != '') {
        	 echo "<a href=\"mail.php?id=".$db->record['resp']."\" title\"Invia email al capogita\">".$db->record['nome']." ".$db->record['cognome']."</a>";
        }else
        	echo $db->record['nome']." ".$db->record['cognome'];
			
        if(($db->record['tel1'] <> '') && ($db->record['cell'] <> ''))
	{
        	$telcell = " Tel: ".$db->record['tel1']." / Cell: ".$db->record['cell'];
	}
        else
	{
		if($db->record['cell'] <> '')
			$telcell = " Cell: ".$db->record['cell'];
		if($db->record['tel1'] <> '')
			$telcell = " Tel: ".$db->record['tel1'];
	}
		if($telcell <> '')
        		echo $telcell;

        	?></div>
<div align="center">Tipo di gita: <span id="tdtipogita" align="center" style="color: #006600;"><?php
        	if($db->record['tipogita'] == 'B')
        		echo "Bici";
        	elseif ($db->record['tipogita'] == 'BT')
        		echo "Bici + Treno";
        	else 
        		echo "Vedi Descrizione";
         ?></span>  ||  Durata: <span id="tddurata" align="center" style="color: #006600;"><?php
         	echo $db->record['durata'];
         	if ($db->record['durata'] == 1)
         		echo " giorno";
         	else 
         		echo " giorni";
         ?></span><div>
 <form action="admin.php">
 <table id="Tviewgita" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
      	<td colspan="3"><input type="hidden" value='<?php echo $db->record['id']; ?>' name="iscr">&nbsp;</td>
        <td align="right"><button type="submit" style="color: #0000FF;">Iscriviti</button></td>
      </tr>
	  <tr>
      	<td class="title">Itinerario</td>
      	<td colspan="3"><div id="tditinerario"><?php echo $db->record['itinerario']; ?></div></td>
      </tr>
      <tr>
      	<td class="title">Descrizione</td>
      	<td colspan="3"><div id="tddescrizione"><?php echo $db->record['descrizione']; ?></div></td>
      </tr>
      <tr>
      	<td id="tddifficolta" class="title">Difficolt&agrave;</td>
      	<td id="tdkm" class="title">Km</td>
      	<td id="tdperc" class="title">Percentuale di sterrato</td>
        <td id="tdtipobici" class="title">Tipo di bici consigliata</td>
      </tr>
      <tr>
      	<td><?php
      		if($db->record['difficolta'] == 'U')
      			echo "Molto Facile";
        	elseif($db->record['difficolta'] == 'F')
        		echo "Facile";
        	elseif ($db->record['difficolta'] == 'M')
        		echo "Media";
        	elseif ($db->record['difficolta'] == 'D')
        		echo "Impegnativa";
			elseif ($db->record['difficolta'] == 'X')
				echo "Molto Impegnativa";
         ?></td>
        <td><?php echo $db->record['km']; ?></td>
        <td><?php echo $db->record['perc']." %"; ?></td>
        <td><?php
        	if($db->record['tipobici'] == 'T')
        		echo "Tutte";
        	elseif ($db->record['tipobici'] == 'V')
        		echo "Con cambio";
        	elseif ($db->record['tipobici'] == 'C')
        		echo "Da citt&agrave";
        	else
        		echo "MTB";
         ?></td>
	  </tr>
      <tr>
      	<td colspan="4" align="center" style="border: 0; color: #006600;">ALLA PARTENZA</td>
      </tr>
      <tr>
      	<td id="tdapl" class="title">Luogo di ritrovo</td>
      	<td id="tdora" class="title">Ora di ritrovo</td>
      	<td id="tdapt" class="title"><?php
        	if($db->record['tipogita'] == 'B')
        		echo "&nbsp;";
        	else 
        		echo "Numero del treno";
         ?></td>
      	<td id="tdmaxp" class="title">Numero max di partecipanti</td>
      </tr>
      <tr>
        <td><?php echo $db->record['apl']; ?></td>
        <td ><?php echo substr($db->record['dataeora'],11,2).":".substr($db->record['dataeora'],14,2);?></td>
        <td><?php
        	if($db->record['tipogita'] == 'B')
        		echo "&nbsp;";
        	else 
        		echo $db->record['apt'];
         ?></td>
        <td><?php 
        	if($db->record['maxp'] == '0')
        		echo "Nessun limite";
        	else 
        		echo $db->record['maxp'];
        	?></td>
      </tr>
      <tr>
        <td colspan="2" id="tdaas" class="title"><?php
        	if($db->record['tipogita'] == 'B')
        		echo "Luogo di arrivo";
        	else 
        		echo "Stazione di arrivo";
         ?></td>
        <td colspan="2" id="tdaao" class="title">Ora di arrivo prevista</td>
      </tr>
      <tr>
      	<td colspan="2"><?php echo $db->record['aas']; ?></td>
      	<td colspan="2"><?php echo substr($db->record['aao'],0,2).":".substr($db->record['aao'],3,2) ;?></td>
      </tr>
      <tr>
      	<td colspan="4" align="center" style="border: 0; color: #006600;">AL RITORNO</td>
      </tr>
      	<td id="tdrpl" class="title">Luogo di ritrovo</td>
      	<td id="tdrpo" class="title">Ora di ritrovo</td>
      	<td id="tdrpt" class="title"><?php
        	if($db->record['tipogita'] == 'B')
        		echo "&nbsp;";
        	else 
        		echo "Numero del treno";
         ?></td>
      	<td id="tdrao" class="title">Ora di arrivo</td>
      </tr>
      <tr>
        <td><?php echo $db->record['rpl']; ?></td>
        <td><?php echo substr($db->record['rpo'],0,2).":".substr($db->record['rpo'],3,2); ?></td>
        <td><?php
        	if($db->record['tipogita'] == 'B')
        		echo "&nbsp;";
        	else 
        		echo $db->record['rpt'];
         ?></td>
        <td><?php echo substr($db->record['rao'],0,2).":".substr($db->record['rao'],3,2); ?></td>
      </tr>
      <tr>
      	<td colspan="4" id="tdral" class="title" align="center">Luogo di arrivo</td>
      </tr>
      <tr>
      	<td colspan="4" align="center"><?php echo $db->record['ral']; ?></td>
      </tr>
      <tr>
      	<td colspan="4" align="center" style="border: 0; color: #006600;">&nbsp;</td>
      </tr>
      	<td colspan="3" id="tdnote" class="title">Note</td>
      	<td id="tdcosto" class="title">Costo</td>
      </tr>
      	<td colspan="3"><?php echo $db->record['note']; ?></td>
        <td><?php echo $db->record['costo']; ?>&euro;</td>
      </tr>
      <tr>
        <td id="tdfile" class="title" colspan="4" align="center">File allegato</td>
      </tr>
      <tr>
        <?php
        if($db->record['pathfile'])
        {
        ?><td colspan="4" align="center"><a target="_blank" title="File Allegato" href="<?php echo $db->record['pathfile']; ?>"><?php echo basename($db->record['pathfile']); ?></a></td><?php
        }else
        	echo "<td colspan=\"4\" align=\"center\">Nessun file allegato</td>\n";
         ?>
      </tr>
    </tbody>
  </table>
  </form>
<?php 
}
else 
{?>
	<div align="center" style="color: #FF0000">Errore vis_gita, query nulla.</div>
<?php 
}
?>
  </div>
 </body>
</html>
