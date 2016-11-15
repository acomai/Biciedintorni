<div class="title_newgita" id="title"><h2>Nuova Gita</h2></div>
<div class="mandatory_newgita"><br>I campi con * sono obbligatori.</div>
<form id="frmnewgita" enctype="multipart/form-data" method="post" name="newgita" action="admin.php?fun=newgita">
  <table class="table_newgita" id="Tnewgita">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo*</td>
        <td colspan="3"><input onchange="refreshtit();" onkeyup="refreshtit();" onkeydown="refreshtit();" id="titolo" maxlength="300" size="100" name="titolo"></td>
      </tr>
      <tr>
        <td id="tddata" class="title">Data gita</td>
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
          	echo "<option";
			if (date("n")<=11)
				echo " selected";
			echo ">".date("Y")."</option>\n          ";
          	echo "<option";
			if (date("n")>11)
				echo " selected";
			echo ">".(date("Y") + 1)."</option>\n          ";
          ?>
        </select>
        </td>
        <td id="tdresp" class="title">Capogita</td>
        <td id="resp">
        <?php
        include_once("lib/db_mysql.php");
        $resp = new db_local();
        $resp->query("SELECT * FROM anagrafiche WHERE (carica = 'C' OR carica = 'A') AND id >= 1;");
        echo "\t<select onchange=\"newass();\" size=\"1\" name=\"resp\">\n";
        while($resp->next_record())
        {
        	if(intval($this->matricola) == intval($resp->record['id']))
        		$s = "selected";
        	echo "\t\t\t<option $s value=\"".$resp->record['id']."\">".$resp->record['nome']." ".$resp->record['cognome']."</option>\n";
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
            <option value="B" selected>Solo bici</option>
            <option value="BT">Bici + Treno</option>
            <option value="N">Vedi note</option>
            <option value="C">Camminata</option>
          </select>
        </td>
        <td id="tddifficolta" class="title">Difficolt&agrave;</td>
        <td>
          <select size="1" name="difficolta">
			<option value="U">Molto Facile</option>
			<option value="F">Facile</option>
			<option value="M">Media</option>
			<option value="D">Impegnativa</option>
			<option value="X">Molto Impegnativa</option>
          </select>
        </td>
      </tr>
      <tr>
        <td id="tddurata" class="title">Durata in giorni</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="durata" maxlength="2" size="2" name="durata" value="1"></td>
              <td class="title"><img alt="freccia" onclick="inc('durata');" onmousedown="freccia(1,'frecciasu');" onmouseup="freccia(0,'frecciasu');" id="frecciasu" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('durata');" onmousedown="freccia(1,'frecciagiu');" onmouseup="freccia(0,'frecciagiu');"  id="frecciagiu" src="img/frecciagiu.gif"></td>
            </tr>
          </table>
        </td>
        <td id="tdtipobici" class="title">Tipo di bici consigliata</td>
        <td>
          <select size="1" name="tipobici">
            <option value="T" selected>Tutte</option>
            <option value="V">Da viaggio</option>
            <option value="C">Da citt&agrave;</option>
            <option value="M">Mountain bike</option>
            <option value="N">No bici (camminata)</option>
          </select>
        </td>
      </tr>
      <tr>
        <td id="tdkm" class="title">Km totali*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="km" maxlength="5" size="5" name="km" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('km');" onmousedown="freccia(1,'frecciasu2');" onmouseup="freccia(0,'frecciasu2');" id="frecciasu2" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('km');" onmousedown="freccia(1,'frecciagiu2');" onmouseup="freccia(0,'frecciagiu2');"  id="frecciagiu2" src="img/frecciagiu.gif"></td>
            </tr>
          </table>
        </td>
        <td id="tdperc" class="title">Percentuale di sterrato</td>
        <td><input maxlength="3" size="3" name="perc" value="0"> %</td>
      </tr>
      <tr>
        <td id="tdmaxp" class="title">Numero massimo di partecipanti*</td>
        <td><input maxlength="5" size="5" name="maxp" id="maxp"><input onclick="dis('maxp','maxpinf')" name="maxpinf" type="checkbox" value="1" id="maxpinf">Senza limiti</td>
        <td id="tdcosto" class="title">Costo</td>
        <td><input maxlength="5" size="5" name="costo">&euro;</td>
      </tr>
      <tr>
      	<td colspan="4" align="center"><h2>PARTENZA</h2></td>
      </tr>
      <tr>
        <td id="tdapl" class="title">Ritrovo di partenza</td>
        <td><input maxlength="50" size="20" name="apl"></td>
        <td id="tdora" class="title">Ora di partenza*</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="apoh" maxlength="2" size="2" name="apoh" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('apoh','h');" onmousedown="freccia(1,'frecciasu0');" onmouseup="freccia(0,'frecciasu0');" id="frecciasu0" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('apoh','h');" onmousedown="freccia(1,'frecciagiu0');" onmouseup="freccia(0,'frecciagiu0');"  id="frecciagiu0" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="apom" maxlength="2" size="2" name="apom" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('apom','m');" onmousedown="freccia(1,'frecciasu1');" onmouseup="freccia(0,'frecciasu1');" id="frecciasu1" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('apom','m');" onmousedown="freccia(1,'frecciagiu1');" onmouseup="freccia(0,'frecciagiu1');"  id="frecciagiu1" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="treno">
        <td id="tdapt" class="title">Numero del treno</td>
        <td><input maxlength="10" size="10" name="apt"></td>
        <td id="tdaas1" class="title">Stazione ed ora di arrivo prevista</td>
        <td><input maxlength="50" size="20" name="aas"><br>
          <table border="0">
            <tr>
              <td><input id="aaoh" maxlength="2" size="2" name="aaoh" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaoh','h');" onmousedown="freccia(1,'frecciasu3');" onmouseup="freccia(0,'frecciasu3');" id="frecciasu3" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaoh','h');" onmousedown="freccia(1,'frecciagiu3');" onmouseup="freccia(0,'frecciagiu3');"  id="frecciagiu3" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="aaom" maxlength="2" size="2" name="aaom" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaom','m');" onmousedown="freccia(1,'frecciasu4');" onmouseup="freccia(0,'frecciasu4');" id="frecciasu4" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaom','m');" onmousedown="freccia(1,'frecciagiu4');" onmouseup="freccia(0,'frecciagiu4');"  id="frecciagiu4" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="nontreno">
      	<td id="tdaas2" class="title">Luogo di arrivo</td>
        <td><input maxlength="50" size="20" name="aas2"></td>
      	<td id="tdaao" class="title">Ora di arrivo prevista</td>
      	<td>
          <table border="0">
            <tr>
              <td><input id="aaoh2" maxlength="2" size="2" name="aaoh2" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('aaoh2','h');" onmousedown="freccia(1,'frecciasu32');" onmouseup="freccia(0,'frecciasu32');" id="frecciasu32" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('aaoh2','h');" onmousedown="freccia(1,'frecciagiu32');" onmouseup="freccia(0,'frecciagiu32');"  id="frecciagiu32" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="aaom2" maxlength="2" size="2" name="aaom2" value="0"></td>
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
        <td><input maxlength="50" size="20" name="rpl"></td>
        <td id="tdrpo" class="title">Ora di ritrovo</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="rpoh" maxlength="2" size="2" name="rpoh" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('rpoh','h');" onmousedown="freccia(1,'frecciasu5');" onmouseup="freccia(0,'frecciasu5');" id="frecciasu5" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('rpoh','h');" onmousedown="freccia(1,'frecciagiu5');" onmouseup="freccia(0,'frecciagiu5');"  id="frecciagiu5" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="rpom" maxlength="2" size="2" name="rpom" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('rpom','m');" onmousedown="freccia(1,'frecciasu6');" onmouseup="freccia(0,'frecciasu6');" id="frecciasu6" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('rpom','m');" onmousedown="freccia(1,'frecciagiu6');" onmouseup="freccia(0,'frecciagiu6');"  id="frecciagiu6" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr class="treno">
      	<td id="tdrpt" class="title">Numero del treno per il ritorno</td>
        <td><input class="treno" maxlength="10" size="10" name="rpt"></td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td id="tdral" class="title">Luogo previsto di termine gita</td>
        <td><input maxlength="50" size="20" name="ral"></td>
        <td id="tdrao" class="title">Ora prevista di termine gita</td>
        <td>
          <table border="0">
            <tr>
              <td><input id="raoh" maxlength="2" size="2" name="raoh" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('raoh','h');" onmousedown="freccia(1,'frecciasu7');" onmouseup="freccia(0,'frecciasu7');" id="frecciasu7" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('raoh','h');" onmousedown="freccia(1,'frecciagiu7');" onmouseup="freccia(0,'frecciagiu7');"  id="frecciagiu7" src="img/frecciagiu.gif"></td>
              <td>HH</td>
              <td><input id="raom" maxlength="2" size="2" name="raom" value="0"></td>
              <td class="title"><img alt="freccia" onclick="inc('raom','m');" onmousedown="freccia(1,'frecciasu8');" onmouseup="freccia(0,'frecciasu8');" id="frecciasu8" src="img/frecciasu.gif"><br><img alt="freccia" onclick="dec('raom','m');" onmousedown="freccia(1,'frecciagiu8');" onmouseup="freccia(0,'frecciagiu8');"  id="frecciagiu8" src="img/frecciagiu.gif"></td>
              <td>MM</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
      	<td colspan="2" id="tdfile" class="title">File Allegato (eventuali Cartina, foto, approfondimenti, ecc...)</td>
        <td colspan="2"><input size="10" type="file" name="file"></td>
      </tr>
      <tr>
        <td id="tditinerario" class="title">Itinerario<br>(caratteri disponibili <span align="center" id="cariti">200</span>)<br>Puoi inserire pi&uacute; caratteri di quelli indicati,<br>ma in fase di approvazione potr&agrave; essere tagliato qualche pezzo.</td>
        <td colspan="3"><textarea id="iti" onchange="refreshcar('cariti','iti');" onkeyup="refreshcar('cariti','iti');" onkeydown="refreshcar('cariti','iti');" cols="100" rows="2" name="itinerario"></textarea></td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione<br>(caratteri disponibili <span align="center" id="cardesc">350</span>)<br>Puoi inserire pi&uacute; caratteri di quelli indicati,<br>ma in fase di approvazione potr&agrave; essere tagliato qualche pezzo.</td>
        <td colspan="3"><textarea id="desc" onchange="refreshcar('cardesc','desc');" onkeyup="refreshcar('cardesc','desc');" onkeydown="refreshcar('cardesc','desc');" cols="100" rows="2" name="descrizione"></textarea></td>
      </tr>
      <tr>
        <td id="tdnote" class="title">Note</td>
        <td colspan="3"><textarea cols="100" rows="2" name="note"></textarea></td>
      </tr>
      <tr>
		<?php
		if($this->carica == "A")
		{ ?>
        <td align="center" colspan="3">
          <select size="1" name="approvata">
            <option value="0" selected>Non approvata</option>
            <option value="1">Approvata</option>
          </select>
        </td>
        <td <?php
		}
		else
		  echo "<td colspan=\"3\">La gita dovr&agrave; essere approvata da un Amministratore</td><td ";
        ?>align="right"><input type="hidden" value='1' name="invio"><button type="button" onclick="controllaFormGita('admin.php?fun=newgita');">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>