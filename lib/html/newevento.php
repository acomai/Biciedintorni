<div class="title_newevento" id="title"><h2>Nuovo Evento</h2></div>
<div class="mandatory_newevento"><br>I campi con * sono obbligatori.</div>
<form id="newevento" enctype="multipart/form-data" method="post" name="newevento" action="admin.php?fun=newevento">
  <table class="table_newevento" id="Tnewevento">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo*</td>
        <td id="texttitle_newevento"><input onchange="refreshtit();" onkeyup="refreshtit();" onkeydown="refreshtit();" id="titolo" maxlength="300" size="100" name="titolo"></td>
      </tr>
      <tr>
        <td id="tddata" class="title">Data evento*</td>
        <td>
        <select size="1" name="giorno" id="giorno">
        <?php
          	for($i=1;$i<=31;$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}
        ?>
        </select>
        <select size="1" name="mese" id="mese" onchange="javascript: caricaGiorni('giorno','mese','anno');">
          <?php
          	for($i=1;$i<=12;$i++)
          	{
          		echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          	}
          ?>
        </select>
        <select size="1" name="anno" id="anno" onchange="javascript: caricaGiorni('giorno','mese','anno');">
          <?php
          	/*for($i=1900;$i<date("Y");$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}*/
          	echo "<option selected>".date("Y")."</option>\n          ";
          	echo "<option>".(date("Y") + 1)."</option>\n          ";
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td id="tdora" class="title">Ora*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="ora" maxlength="2" size="2" name="ora" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('ora','h');" onmousedown="freccia(1,'frecciasu0');" onmouseup="freccia(0,'frecciasu0');" id="frecciasu0" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('ora','h');" onmousedown="freccia(1,'frecciagiu0');" onmouseup="freccia(0,'frecciagiu0');"  id="frecciagiu0" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="minuti" maxlength="2" size="2" name="minuti" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('minuti','m');" onmousedown="freccia(1,'frecciasu1');" onmouseup="freccia(0,'frecciasu1');" id="frecciasu1" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('minuti','m');" onmousedown="freccia(1,'frecciagiu1');" onmouseup="freccia(0,'frecciagiu1');"  id="frecciagiu1" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione*</td>
        <td><textarea cols="100" rows="2" id="descrizione" name="descrizione"></textarea></td>
      </tr>      <tr>      	<td id="tdfile" class="title">File Allegato (eventuali Cartina, foto, approfondimenti, ecc...)</td>        <td><input size="10" type="file" name="file"></td>      </tr>
      <tr>
        <td><button id="resetevento" name="reset" type="reset">Reset</button></td>
        <td align="right">
		<?php
		if($this->carica == "A")
		{ ?>
          <select size="1" name="approvato">
            <option value="0" selected>Non approvato</option>
            <option value="1">Approvato</option>
          </select>
        
        <?php
		}
		else
		  echo "L'evento dovr&agrave; essere approvato da un Amministratore ";
        ?> <input type="hidden" value='1' name="invio"><button id="salvaevento" type="button" onclick="return controllaFormEvento('admin.php?fun=newevento');">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>