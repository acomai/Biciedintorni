<?php /* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<div id="title" align="center">Modifica Associato</div>
<br>
<form id="modass" method="post" action="admin.php?fun=modass&amp;save=1" name="modass">
  <table align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td>Matricola</td>
        <td><?php echo $db->record['id']; ?><input type="hidden" name="matricola" value="<?php echo $db->record['id']; ?>"></td>
      </tr>
      <tr>
        <td>Nome</td>
        <td><input id="nome" maxlength="50" size="20" name="nome" onchange="creaNick();" onkeyup="creaNick();" onkeydown="creaNick();" value="<?php echo $db->record['nome']; ?>"></td>
      </tr>
      <tr>
        <td>Cognome</td>
        <td><input id="cognome" maxlength="50" size="20" name="cognome" onchange="creaNick();" onkeyup="creaNick();" onkeydown="creaNick();" value="<?php echo $db->record['cognome']; ?>"></td>
      </tr>
      <tr>
        <td>Data di nascita</td>
        <td>
         	<select size="1" name="giornonasc" id="giornonasc">
         		<?php
          	for($i=1;$i<=31;$i++)
          	{
          		if ($i == substr($db->record['datanascita'],8,2))
          			echo "<option selected>".substr($db->record['datanascita'],8,2)."</option>";
          		else
          			echo "<option>".$i."</option>\n          ";
          	}
        ?>
        	</select>
        	<select size="1" name="mesenasc" id="mesenasc" onchange="javascript: caricaGiorni('giornonasc','mesenasc','annonasc');">
          		<?php
          	for($i=1;$i<=12;$i++)
          	{
          		if(substr($db->record['datanascita'],5,2) == $i)
          			echo '<option selected value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          		else
          			echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          	}
     ?>
        	</select>
        <select size="1" name="annonasc" id="annonasc" onchange="javascript: caricaGiorni('giornonasc','mesenasc','annonasc');">
          <?php
          	for($i=1900;$i<=date("Y");$i++)
          	{
          		if(substr($db->record['datanascita'],0,4) == $i)
          			echo "<option selected>".$i."</option>\n          ";
          		else
          			echo "<option>".$i."</option>\n          ";
          	}
          ?>
        </select></td>
      </tr>
      <tr>
        <td>Sesso</td>
        <td><?php
        		if($db->record['sesso'] == "M")
        			echo "<input checked=\"checked\" type=\"radio\" name=\"sesso\" value=\"M\">M<input type=\"radio\" name=\"sesso\" value=\"F\">F";
        		elseif($db->record['sesso'] == "F")
        				echo "<input type=\"radio\" name=\"sesso\" value=\"M\">M<input checked=\"checked\" type=\"radio\" name=\"sesso\" value=\"F\">F";
        			else 
        				echo "<input type=\"radio\" name=\"sesso\" value=\"M\">M<input type=\"radio\" name=\"sesso\" value=\"F\">F";
        ?></td>
      </tr>
      <tr>
        <td>Nome Utente</td>
        <td><input id="username" name="username" maxlength="50" size="20" value="<?php echo $db->record['user']; ?>"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input id="password" maxlength="20" size="20" name="password" value="<?php echo $db->record['pw']; ?>"></td>
      </tr>
      <tr>
        <td colspan="2">Inviare un'email al socio con il nome utente e la password?<br>
        	<input id="passmail" type="radio" name="passmail" value="1">Si<input id="passmail" type="radio" checked="checked" name="passmail" value="0">No
        </td>
      </tr>
      <tr>
        <td>Tipo Socio</td>
        <td>
        <select size="1" name="tiposocio" onchange="changeTiposocio()">
        <?php 
        	switch ($db->record['tiposocio'])
        	{
        		case "SO":
        			echo "<option selected value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
          		case "SS":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option selected value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        		case "SW":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option selected value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        		case "SJ":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option selected value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        		case "SG":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option selected value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        		case "SF":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option selected value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        		case "FA":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option selected value=\"FA\">Familiare di:</option>";
          			break;
        		case "AB":
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option selected value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
          		default:
          			echo "<option selected value=\"".$db->record['tiposocio']."\">++".$db->record['tiposocio']."++</option>";
        			echo "<option value=\"SO\">Socio Ordinario</option>";
          			echo "<option value=\"SS\">Socio Sostenitore</option>";
          			echo "<option value=\"SW\">Socio Web</option>";
          			echo "<option value=\"SJ\">Socio Junior</option>";
          			echo "<option value=\"SG\">Socio Giovane</option>";
          			echo "<option value=\"SF\">Socio Famiglia</option>";
          			echo "<option value=\"AB\">Amico della bicicletta</option>";
          			echo "<option value=\"FA\">Familiare di:</option>";
          			break;
        	}
          ?>
        </select><br>
        <?php 
        	$db2 = new db_local();
			$db2->query("SELECT id,cognome,nome from anagrafiche WHERE tiposocio = 'SF' AND approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY cognome,nome;");
			if($db->record['tiposocio'] == 'FA')
				echo "\t<select class=\"fam\" size=\"1\" name=\"idcapo\" id=\"idcapo\">\n";
			else 
				echo "\t<select class=\"fam\" style=\"display:none\" size=\"1\" name=\"associato\" id=\"associato\">\n";
			while($db2->next_record())
			{
				if($db->record['idcapo'] == $db2->record['id'])
					echo "\t\t\t<option selected value=\"".intval($db2->record['id'])."\">".$db2->record['cognome']." ".$db2->record['nome']."</option>\n";
				else 
					echo "\t\t\t<option value=\"".intval($db2->record['id'])."\">".$db2->record['cognome']." ".$db2->record['nome']."</option>\n";
			}
			echo "  	</select>";
			//$db2->close();
			unset($db2);
			?>
        </td>
      </tr>
      <tr>
        <td>Comune</td>
        <td><input maxlength="50" size="20" name="citta" value="<?php echo $db->record['citta']; ?>"></td>
      </tr>
      <tr>
        <td>CAP</td>
        <td><input maxlength="8" size="20" name="cap" value="<?php echo $db->record['cap']; ?>"></td>
      </tr>
      <tr>
        <td>Provincia</td>
        <td><input maxlength="50" size="20" name="prov" value="<?php echo $db->record['prov']; ?>"></td>
      </tr>
      <tr>
        <td>Indirizzo</td>
        <td><input maxlength="255" size="20" name="indirizzo" value="<?php echo $db->record['via']; ?>"></td>
      </tr>
      <tr>
        <td>Data iscrizione</td>
        <td>
        <select size="1" name="giornoisc" id="giornoisc">
        	<?php
          	for($i=1;$i<=31;$i++)
          	{
          		if ($i == substr($db->record['dataiscrizione'],8,2))
          			echo "<option selected>".substr($db->record['dataiscrizione'],8,2)."</option>";
          		else
          			echo "<option>".$i."</option>\n          ";
          	}
        ?>
        </select>
        <select size="1" name="meseisc" id="meseisc" onchange="javascript: caricaGiorni('giornoisc','meseisc','annoisc');">
          <?php
          	for($i=1;$i<=12;$i++)
          	{
          		if(substr($db->record['dataiscrizione'],5,2) == $i)
          			echo '<option selected value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          		else
          			echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          	}
          ?>
        </select>
        <select size="1" name="annoisc" id="annoisc" onchange="javascript: caricaGiorni('giornoisc','meseisc','annoisc');">
          <?php
          	for($i=1900;$i<=date("Y");$i++)
          	{
          		if(substr($db->record['dataiscrizione'],0,4) == $i)
          			echo "<option selected>".$i."</option>\n          ";
          		else
          			echo "<option>".$i."</option>\n          ";
          	}
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>telefono 1 privato</td>
        <td><input maxlength="15" size="20" name="tel1" value="<?php echo $db->record['tel1']; ?>"></td>
      </tr>
      <tr>
        <td>telefono 2 associazione</td>
        <td><input maxlength="15" size="20" name="tel2" value="<?php echo $db->record['tel2']; ?>"></td>
      </tr>
      <tr>
        <td>cellulare</td>
        <td><input maxlength="15" size="20" name="cell" value="<?php echo $db->record['cell']; ?>"></td>
      </tr>
      <tr>
        <td>email</td>
        <td><input maxlength="100" size="20" name="email" value="<?php echo $db->record['email']; ?>"></td>
      </tr>
      <tr>
        <td>carica</td>
        <td>
        <select size="1" name="carica">
        <?php 
        	switch ($db->record['carica'])
        	{
        		case "AS":
        			echo "<option selected value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
          		case "VS":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option selected value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        		case "VG":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option selected value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        		case "VA":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option selected value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        		case "S":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option selected value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        		case "C":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option selected value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        		case "A":
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option selected value=\"A\">Amministratore</option>";
          			break;
          		default:
        			echo "<option value=\"AS\">Associato</option>";
        			echo "<option value=\"VS\">Volontario Sede</option>";
        			echo "<option value=\"VG\">Volontario Giornalino</option>";
        			echo "<option value=\"VA\">Volontario</option>";
        			echo "<option value=\"S\">Segreteria</option>";
        			echo "<option value=\"C\">Capo Gita</option>";
        			echo "<option value=\"A\">Amministratore</option>";
          			break;
        	}
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>anno</td>
        <td><?php 
        	if ($db->record['a2007'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2007\" value=\"1\">2007 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2007\" value=\"1\">2007 ";
        	if ($db->record['a2008'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2008\" value=\"1\">2008 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2008\" value=\"1\">2008 ";
        	if ($db->record['a2009'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2009\" value=\"1\">2009<br>";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2009\" value=\"1\">2009<br>";
        	if ($db->record['a2010'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2010\" value=\"1\">2010 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2010\" value=\"1\">2010 ";
        	if ($db->record['a2011'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2011\" value=\"1\">2011 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2011\" value=\"1\">2011 ";
        	if ($db->record['a2012'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2012\" value=\"1\">2012<br>";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2012\" value=\"1\">2012<br>";
        	if ($db->record['a2013'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2013\" value=\"1\">2013 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2013\" value=\"1\">2013 ";
        	if ($db->record['a2014'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2014\" value=\"1\">2014 ";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2014\" value=\"1\">2014 ";
        	if ($db->record['a2015'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2015\" value=\"1\">2015";
        	else 
        		echo "<input type=\"checkbox\" name=\"a2015\" value=\"1\">2015";
        	if ($db->record['a2016'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2016\" value=\"1\">2016";
        	else
        		echo "<input type=\"checkbox\" name=\"a2016\" value=\"1\">2016";
        	if ($db->record['a2017'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2017\" value=\"1\">2017";
        	else
        		echo "<input type=\"checkbox\" name=\"a2017\" value=\"1\">2017";
        	if ($db->record['a2018'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2018\" value=\"1\">2018";
        	else
        		echo "<input type=\"checkbox\" name=\"a2018\" value=\"1\">2018";
        	if ($db->record['a2019'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2019\" value=\"1\">2019";
        	else
        		echo "<input type=\"checkbox\" name=\"a2019\" value=\"1\">2019";
        	if ($db->record['a2020'] == 1)
        		echo "<input checked type=\"checkbox\" name=\"a2020\" value=\"1\">2020";
        	else
        		echo "<input type=\"checkbox\" name=\"a2020\" value=\"1\">2020";
          ?></td>
      </tr>
      <tr>
        <td>Cauzione</td>
	<td><input <?php if ($db->record['cauzione']=='SI') echo "checked='checked'"; ?> type="radio" name="cauzione" value="SI">SI<input <?php if ($db->record['cauzione']=='NO') echo "checked='checked'"; ?> type="radio" name="cauzione" value="NO">NO  	  </td>
      </tr>
      <tr>
        <td>Note</td>
        <td><textarea cols="20" rows="4" name="note"><?php echo $db->record['note']; ?></textarea></td>
      </tr>
      <tr>
        <td>Approvato</td>
        <td>
        <select size="1" name="approvato">
        <?php 
        	if($db->record['approvato'] == 0)
        	{
        		echo "<option selected>0</option>";
        		echo "<option>1</option>";
        	}
          	else
          	{
          		echo "<option>0</option>";
          		echo "<option selected>1</option>";
          	}
         ?>
        </select>
        </td>
      </tr>
      <tr>
        <td><button name="reset" type="reset">Reset</button></td>
        <td><button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>