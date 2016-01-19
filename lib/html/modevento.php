<?php if($db->next_record())
{ 
	?>
<div class="title_modevento" id="title"><h2><?php echo $db->record['titolo']; ?></h2></div>
<div class="mandatory_modevento"><br>I campi con * sono obbligatori.</div>
<form id="modevento" enctype="multipart/form-data" method="post" name="modevento" action="admin.php">
  <table class="table_modevento" id="Tmodevento">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo*</td>
        <td id="texttitle_modevento"><input onchange="refreshtit();" onkeyup="refreshtit();" onkeydown="refreshtit();" id="titolo" maxlength="300" size="100" name="titolo" value="<?php echo $db->record['titolo']; ?>"></td>
      </tr>
      <tr>
        <td id="tddata" class="title">Data evento*</td>
        <td>
        <select size="1" name="giorno" id="giorno">
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
      </tr>
      <tr>
        <td id="tdora" class="title">Ora*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="ora" maxlength="2" size="2" name="ora" value="<?php echo substr($db->record['dataeora'],11,2); ?>"></td>
              <td class="title"><img alt="freccia" onclick="inc('ora','h');" onmousedown="freccia(1,'frecciasu0');" onmouseup="freccia(0,'frecciasu0');" id="frecciasu0" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('ora','h');" onmousedown="freccia(1,'frecciagiu0');" onmouseup="freccia(0,'frecciagiu0');"  id="frecciagiu0" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="minuti" maxlength="2" size="2" name="minuti" value="<?php echo substr($db->record['dataeora'],14,2); ?>" ></td>
              <td class="title"><img alt="freccia" onclick="inc('minuti','m');" onmousedown="freccia(1,'frecciasu1');" onmouseup="freccia(0,'frecciasu1');" id="frecciasu1" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('minuti','m');" onmousedown="freccia(1,'frecciagiu1');" onmouseup="freccia(0,'frecciagiu1');"  id="frecciagiu1" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione*</td>
        <td><textarea cols="100" rows="2" name="descrizione"><?php echo $db->record['descrizione']; ?></textarea></td>
      </tr>      <tr>        <td id="tdfile" class="title">File Allegato (eventuali Cartina, foto, approfondimenti, ecc...)</td>        <td><?php        if($db->record['pathfile'])        {        ?><a title="File Allegato" target="_blank" href="<?php echo $db->record['pathfile']; ?>">[<?php echo basename($db->record['pathfile']); ?>]</a> oppure <input name="elimg" type="checkbox" value="1" id="elimg">Elimina File Allegato<br>oppure sostituiscilo<?php        }         ?><input size="10" type="file" name="file"></td>      </tr>
      <tr>
		<?php
		if($this->carica == "A")
		{ ?>
        <td align="center">
          <select size="1" name="approvato">
          <?php
          if ($db->record['approvato'] == 0)
          { ?>
            <option value="0" selected>Non approvato</option>
            <option value="1">Approvato</option>
          <?php }
          else 
          { ?>
          	<option value="0">Non approvato</option>
            <option value="1" selected>Approvato</option>
          <?php } ?>
          </select>
        </td>
        <td <?php
		}
		else
		  echo "<td>L'evento dovr&agrave; essere approvato da un Amministratore</td><td ";
        ?>align="right"><input type="hidden" value='<?php echo $db->record['id'];?>' name="invio"><button id="invio" type="button" onclick="return controllaFormEvento('admin.php?fun=modevento');">Invio</button></td>
                           
      </tr>
    </tbody>
  </table>
</form>
<?php 
}
else 
{?>
	<div align="center" style="color: #FF0000">Errore modevento, query nulla.</div>
<?php
 mail("dibella.antonino@gmail.com","Modifica evento Applicazione Bici&Dintorni non autorizzata.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare un evento ma non &egrave; autorizzato a farlo.\n".
				"-----\nFile: user.php\nRoutine: modevento (Visualizzazione).\n-----\nID Evento: ".$id."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pass);
}
?>