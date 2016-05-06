<!DOCTYPE html>
<html lang="it">
<!-- Gestisce la modifica di una gita nell'applicativo di Bici e Dintorni. -->
<head>
  <title>FIAB Torino Bici e Dintorni - gita</title>
  <meta charset="utf-8">
</head>
<body>

<?php
/**
 * Modgita.php File Doc Comment
 *
 * PHP version 5.3
 * Programma che gestisce l'interazione utente per modificare una gita
 *
 * @category Programma
 * @package  Root
 * @author   Antonino Di Bella, modificato da Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */
if($db->next_record())
{ 
	?>
<div class="title_modgita" id="title"><h2>Modifica Gita</h2></div>
<div class="mandatory_modgita"><br>I campi con * sono obbligatori.</div>
<form id="modgita" enctype="multipart/form-data" method="post" name="modgita" action="admin.php?fun=modgita">
  <table class="table_modgita" id="Tmodgita">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo*</td>
        <td colspan="3"><input id="titolo" maxlength="300" size="100" name="titolo" value="<?php echo $db->record['titolo']; ?>"></td>
      </tr>
      <tr>
        <td id="tddata" class="title">Data gita</td>
        <td><select size="1" name="giorno" id="giorno">
        	<option selected><?php echo substr($db->record['dataeora'],8,2); ?></option>
        </select>
        <select size="1" name="mese" id="mese" onchange="javascript: caricaGiorni('giorno','mese','anno');">
          <?php
          	for($i=1;$i<=12;$i++)
          	{
          		if(substr($db->record['dataeora'],5,2) == $i)
          			echo '<option selected value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          		else 
          			echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          	}
          ?>
        </select>
        <select size="1" name="anno" id="anno" onchange="javascript: caricaGiorni('giorno','mese','anno');">
          <?php
          	if(substr($db->record['dataeora'],0,4) == date("Y"))
          	{
          		echo "<option selected>".date("Y")."</option>\n          ";
          		echo "<option>".(date("Y") + 1)."</option>\n          ";
          	}
          	else
          	{
          		echo "<option>".date("Y")."</option>\n          ";
          		echo "<option selected>".(date("Y") + 1)."</option>\n          ";
          	}
          ?>
        </select>
        </td>
        <td id="tdresp" class="title">Capogita</td>
        <td id="resp">
        	<?php
        include_once("lib/db_mysql.php");
        $resp = new db_local();
        $resp->query("SELECT * FROM anagrafiche WHERE (carica = 'C' OR carica = 'A') AND id >= 1 ORDER BY nome;");
        echo "\t<select onchange=\"newass();\" size=\"1\" name=\"resp\">\n";
        while($resp->next_record())
        {
        	if(intval($db->record['idresp']) == intval($resp->record['id']))
        		$s = "selected ";
        	echo "\t\t\t<option ".$s."value=\"".intval($resp->record['id'])."\">".$resp->record['nome']." ".$resp->record['cognome']."</option>\n";
        	$s = "";
        }
        ?>
        	</select>
        </td>
      </tr>
      <tr>
        <td id="tdtipogita" class="title">Tipo di gita</td>
        <td>
        	<select onchange="cambiaTipogita();" size="1" name="tipogita">
        	<?php
        		if($db->record['tipogita'] == 'B')
        		{ ?>
        			<option value="B" selected>Solo bici</option>
        			<option value="BT">Bici + Treno</option>
            		<option value="N">Vedi note</option>
            		<option value="C">Camminata</option>
        	<?php }
        		elseif ($db->record['tipogita'] == 'BT')
        			{ ?>
        			<option value="B">Solo bici</option>
        			<option value="BT" selected>Bici + Treno</option>
            		<option value="N">Vedi note</option>
            		<option value="C">Camminata</option>
        	<?php }
        		elseif ($db->record['tipogita'] == 'C')
        			{ ?>
        	        <option value="B">Solo bici</option>
        	        <option value="BT">Bici + Treno</option>
        	        <option value="N">Vedi note</option>
        	        <option value="C" selected>Camminata</option>
        	<?php }
        			else 
        			{ ?>
        			<option value="B">Solo bici</option>
        			<option value="BT">Bici + Treno</option>
            		<option value="N" selected>Vedi note</option>
            		<option value="C">Camminata</option>
        	<?php }  ?>
          </select>
        </td>
        <td id="tddifficolta" class="title">Difficolt&agrave;</td>
        <td>
          <select size="1" name="difficolta">
			<option value="U" <?php echo ($db->record['difficolta'] == 'U'?'selected':'');?>>Molto Facile</option>
			<option value="F" <?php echo ($db->record['difficolta'] == 'F'?'selected':'');?>>Facile</option>
			<option value="M" <?php echo ($db->record['difficolta'] == 'M'?'selected':'');?>>Media</option>
			<option value="D" <?php echo ($db->record['difficolta'] == 'D'?'selected':'');?>>Impegnativa</option>
			<option value="X" <?php echo ($db->record['difficolta'] == 'X'?'selected':'');?>>Molto Impegnativa</option>
          </select>
        </td>
      </tr>
      <tr>
        <td id="tddurata" class="title">Durata in giorni</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="durata" maxlength="2" size="2" name="durata" value="<?php echo $db->record['durata']; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('durata');" onmousedown="freccia(1,'frecciasu');" onmouseup="freccia(0,'frecciasu');" id="frecciasu" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('durata');" onmousedown="freccia(1,'frecciagiu');" onmouseup="freccia(0,'frecciagiu');"  id="frecciagiu" src="img/frecciagiu.gif"></td>
            </tr>
          </table>
        </td>
        <td id="tdtipobici" class="title">Tipo di bici consigliata</td>
        <td>
          <select size="1" name="tipobici">
			<option value="T" <?php echo ($db->record['tipobici'] == 'T'?'selected':'');?>>Tutte</option>
			<option value="V" <?php echo ($db->record['tipobici'] == 'V'?'selected':'');?>>Con Cambio</option>
			<option value="C" <?php echo ($db->record['tipobici'] == 'C'?'selected':'');?>>Citt&agrave;</option>
			<option value="M" <?php echo ($db->record['tipobici'] == 'M'?'selected':'');?>>MTB</option>
			<option value="N" <?php echo ($db->record['tipobici'] == 'N'?'selected':'');?>>No bici (camminata)</option>
          </select>
        </td>
      </tr>
      <tr>
        <td id="tdkm" class="title">Km totali*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="km" maxlength="5" size="5" name="km" value="<?php echo $db->record['km']; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('km');" onmousedown="freccia(1,'frecciasu2');" onmouseup="freccia(0,'frecciasu2');" id="frecciasu2" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('km');" onmousedown="freccia(1,'frecciagiu2');" onmouseup="freccia(0,'frecciagiu2');"  id="frecciagiu2" src="img/frecciagiu.gif"></td>
            </tr>
          </table>
        </td>
        <td id="tdperc" class="title">Percentuale di sterrato</td>
        <td><input maxlength="3" size="3" name="perc" value="<?php echo $db->record['perc']; ?>"> %</td>
      </tr>
      <tr>
        <td id="tdmaxp" class="title">Numero massimo di partecipanti*</td>
        <td><?php 
        	if($db->record['maxp'] == '0')
        	{ ?>
        		<input maxlength="5" size="5" name="maxp" id="maxp" style="display: none"><input onclick="dis('maxp','maxpinf')" name="maxpinf" type="checkbox" value="1" id="maxpinf" checked>Senza limiti
        	<?php }
        	else
        	{ ?>
        		<input maxlength="5" size="5" name="maxp" id="maxp" value="<?php echo $db->record['maxp']; ?>"><input onclick="dis('maxp','maxpinf')" name="maxpinf" type="checkbox" value="1" id="maxpinf">Senza limiti
        	<?php }
        	?></td>
        <td id="tdcosto" class="title">Costo</td>
        <td><input maxlength="5" size="5" name="costo" value="<?php echo $db->record['costo']; ?>">&euro;</td>
      </tr>
      <tr>
      	<td colspan="4" align="center"><h2>ANDATA</h2></td>
      </tr>
      <tr>
        <td id="tdapl" class="title">Ritrovo di partenza</td>
        <td><input maxlength="50" size="20" name="apl" value="<?php echo $db->record['apl']; ?>"></td>
        <td id="tdora" class="title">Ora di ritrovo*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="apoh" maxlength="2" size="2" name="apoh" value="<?php echo substr($db->record['dataeora'],11,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('apoh','h');" onmousedown="freccia(1,'frecciasu0');" onmouseup="freccia(0,'frecciasu0');" id="frecciasu0" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('apoh','h');" onmousedown="freccia(1,'frecciagiu0');" onmouseup="freccia(0,'frecciagiu0');"  id="frecciagiu0" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="apom" maxlength="2" size="2" name="apom" value="<?php echo substr($db->record['dataeora'],14,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('apom','m');" onmousedown="freccia(1,'frecciasu1');" onmouseup="freccia(0,'frecciasu1');" id="frecciasu1" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('apom','m');" onmousedown="freccia(1,'frecciagiu1');" onmouseup="freccia(0,'frecciagiu1');"  id="frecciagiu1" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="nontreno">
      	<td id="tdaas1" class="title">Luogo di arrivo</td>
        <td><input maxlength="50" size="20" name="aas" value="<?php if($db->record['tipogita'] == 'B') echo $db->record['aas']; else echo ""; ?>"></td>
        <td id="tdaao" class="title">Ora di arrivo prevista</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="aaoh" maxlength="2" size="2" name="aaoh" value="<?php if($db->record['tipogita'] == 'B') echo substr($db->record['aao'],0,2); else echo "00"; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaoh','h');" onmousedown="freccia(1,'frecciasu3');" onmouseup="freccia(0,'frecciasu3');" id="frecciasu3" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaoh','h');" onmousedown="freccia(1,'frecciagiu3');" onmouseup="freccia(0,'frecciagiu3');"  id="frecciagiu3" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="aaom" maxlength="2" size="2" name="aaom" value="<?php if($db->record['tipogita'] == 'B') echo substr($db->record['aao'],3,2); else echo "00"; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaom','m');" onmousedown="freccia(1,'frecciasu4');" onmouseup="freccia(0,'frecciasu4');" id="frecciasu4" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaom','m');" onmousedown="freccia(1,'frecciagiu4');" onmouseup="freccia(0,'frecciagiu4');"  id="frecciagiu4" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="treno">
        <td id="tdapt" class="title">Numero del treno</td>
        <td><input maxlength="10" size="10" name="apt" value="<?php echo $db->record['apt']; ?>"></td>
        <td id="tdaas2" class="title">Stazione ed ora di arrivo</td>
        <td><input maxlength="50" size="20" name="aas2" value="<?php if($db->record['tipogita'] != 'B') echo $db->record['aas']; else echo ""; ?>">
        	<br>
        	<table border="0">
        	<tr>
              <td><input id="aaoh2" maxlength="2" size="2" name="aaoh2" value="<?php if($db->record['tipogita'] != 'B') echo substr($db->record['aao'],0,2); else echo "00"; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaoh2','h');" onmousedown="freccia(1,'frecciasu32');" onmouseup="freccia(0,'frecciasu32');" id="frecciasu32" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaoh2','h');" onmousedown="freccia(1,'frecciagiu32');" onmouseup="freccia(0,'frecciagiu32');"  id="frecciagiu32" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="aaom2" maxlength="2" size="2" name="aaom2" value="<?php if($db->record['tipogita'] != 'B') echo substr($db->record['aao'],3,2); else echo "00"; ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaom2','m');" onmousedown="freccia(1,'frecciasu42');" onmouseup="freccia(0,'frecciasu42');" id="frecciasu42" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaom2','m');" onmousedown="freccia(1,'frecciagiu42');" onmouseup="freccia(0,'frecciagiu42');"  id="frecciagiu42" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          	</table>
        </td>
      </tr>
      <tr>
      	<td colspan="4" align="center"><h2>RITORNO</h2></td>
      </tr>
      <tr>
        <td id="tdrpl" class="title">Luogo di ritrovo per il ritorno</td>
        <td><input maxlength="50" size="20" name="rpl" value="<?php echo $db->record['rpl']; ?>"></td>
        <td id="tdrpo" class="title">Ora di ritrovo</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="rpoh" maxlength="2" size="2" name="rpoh" value="<?php echo substr($db->record['rpo'],0,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('rpoh','h');" onmousedown="freccia(1,'frecciasu5');" onmouseup="freccia(0,'frecciasu5');" id="frecciasu5" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('rpoh','h');" onmousedown="freccia(1,'frecciagiu5');" onmouseup="freccia(0,'frecciagiu5');"  id="frecciagiu5" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="rpom" maxlength="2" size="2" name="rpom" value="<?php echo substr($db->record['rpo'],3,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('rpom','m');" onmousedown="freccia(1,'frecciasu6');" onmouseup="freccia(0,'frecciasu6');" id="frecciasu6" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('rpom','m');" onmousedown="freccia(1,'frecciagiu6');" onmouseup="freccia(0,'frecciagiu6');"  id="frecciagiu6" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="treno">
        <td id="tdrpt" class="title"><p class="treno">Numero del treno per il ritorno<p></td>
        <td><input class="treno" maxlength="10" size="10" name="rpt" value="<?php echo $db->record['rpt']; ?>"></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td id="tdral" class="title">Luogo previsto di termine gita</td>
        <td><input maxlength="50" size="20" name="ral" value="<?php echo $db->record['ral']; ?>"></td>
        <td id="tdrao" class="title">Ora prevista di termine gita</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="raoh" maxlength="2" size="2" name="raoh" value="<?php echo substr($db->record['rao'],0,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('raoh','h');" onmousedown="freccia(1,'frecciasu7');" onmouseup="freccia(0,'frecciasu7');" id="frecciasu7" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('raoh','h');" onmousedown="freccia(1,'frecciagiu7');" onmouseup="freccia(0,'frecciagiu7');"  id="frecciagiu7" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="raom" maxlength="2" size="2" name="raom" value="<?php echo substr($db->record['rao'],3,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('raom','m');" onmousedown="freccia(1,'frecciasu8');" onmouseup="freccia(0,'frecciasu8');" id="frecciasu8" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('raom','m');" onmousedown="freccia(1,'frecciagiu8');" onmouseup="freccia(0,'frecciagiu8');"  id="frecciagiu8" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td colspan="2" id="tdfile" class="title">File Allegato (eventuali Cartina, foto, approfondimenti, ecc...)</td>
        <td colspan="2"><?php
        if($db->record['pathfile'])
        {
        ?><a title="File Allegato" target="_blank" href="<?php echo $db->record['pathfile']; ?>">[<?php echo basename($db->record['pathfile']); ?>]</a> oppure <input name="elimg" type="checkbox" value="1" id="elimg">Elimina File Allegato<br>oppure sostituiscilo<?php
        }
         ?><input size="10" type="file" name="file"></td>
      </tr>
      <tr>
        <td id="tditinerario" class="title">Itinerario<br>(caratteri disponibili <span align="center" id="cariti">200</span>)<br>Puoi inserire più caratteri di quelli indicati,<br>ma in fase di approvazione potr&agrave; essere tagliato qualche pezzo.</td>
        <td colspan="3"><textarea id="iti" onchange="refreshcar('cariti','iti');" onkeyup="refreshcar('cariti','iti');" onkeydown="refreshcar('cariti','iti');" cols="100" rows="2" name="itinerario"><?php echo $db->record['itinerario']; ?></textarea></td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione<br>(caratteri disponibili <span align="center" id="cardesc">350</span>)<br>Puoi inserire più caratteri di quelli indicati,<br>ma in fase di approvazione potr&agrave; essere tagliato qualche pezzo.</td>
        <td colspan="3"><textarea id="desc" onchange="refreshcar('cardesc','desc');" onkeyup="refreshcar('cardesc','desc');" onkeydown="refreshcar('cardesc','desc');" cols="100" rows="2" name="descrizione"><?php echo $db->record['descrizione']; ?></textarea></td>
      </tr>
      <tr>
        <td id="tdnote" class="title">Note</td>
        <td colspan="3"><textarea cols="100" rows="2" name="note"><?php echo $db->record['note']; ?></textarea></td>
      </tr>
      <tr>
		<?php
		if($this->carica == "A")
		{ ?>
        <td align="center" colspan="3">
          <select size="1" name="approvata">
          <?php
          if ($db->record['approvata'] == 0)
          { ?>
            <option value="0" selected>Non approvata</option>
            <option value="1">Approvata</option>
          <?php }
          else 
          { ?>
          	<option value="0">Non approvata</option>
            <option value="1" selected>Approvata</option>
          <?php } ?>
          </select>
        </td>
        <td <?php
		}
		else
		  echo "<td colspan=\"3\">La gita dovr&agrave; essere approvata da un Amministratore</td><td ";
        ?>align="right"><input type="hidden" value='<?php echo $db->record['id'];?>' name="invio"><button type="button" onclick="controllaFormGita('admin.php?fun=modgita');">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
<?php 
}
else 
{?>
	<div align="center" style="color: #FF0000">Errore modgita, query nulla.</div>
<?php
 mail("dibella.antonino@gmail.com","Modifica gita Applicazione Bici&Dintorni non autorizzata.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare una gita ma non � autorizzato a farlo.\n".
				"-----\nFile: user.php\nRoutine: modgita (Visualizzazione).\n-----\nID Gita: ".$id."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pass);
}
?>
 </body>
</html>