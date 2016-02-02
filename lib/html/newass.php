<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Bici e Dintorni - Inserimento nuovo socio</title>
		<meta name="description" content="">
		<meta name="author" content="Adriano">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">
	</head>
<?php 
/**
 *Newass.php File Doc Comment
 *
 * PHP version 5.3
 * Programma di front end per l'inserimento di una nuova anagrafica nel db di
 * Bici e Dintorni. Sviluppato da Antonino Di Bella.
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */
/* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<div id="title" align="center">Modifica Associato</div>
<br>
<form id="newass" method="post" action="admin.php?fun=newass&amp;save=1" name="newass">
  <table align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td>Matricola</td>
        <td><?php 
            $rsDB = new db_local();
        $rsDB->query("SHOW TABLE STATUS LIKE 'anagrafiche'");
        if ($rsDB->next_record()) {
            echo $rsDB->record['Auto_increment']; 
        }
        else { 
            echo "ERROR"; 
        }
        $rsDB->close();
        unset($rsDB); ?></td>
      </tr>
      <tr>
        <td>Nome</td>
        <td><input id="nome" maxlength="50" size="20" name="nome" onchange="creaNick();creaPass();" onkeyup="creaNick();creaPass();" onkeydown="creaNick();creaPass();"></td>
      </tr>
      <tr>
        <td>Cognome</td>
        <td><input id="cognome" maxlength="50" size="20" name="cognome" onchange="creaNick();" onkeyup="creaNick();" onkeydown="creaNick();"></td>
      </tr>
      <tr>
        <td>Data di nascita</td>
        <td>
         	<select size="1" name="giornonasc" id="giornonasc">
            <?php
            for ($i=1;$i<=31;$i++) {
                      echo "<option>".$i."</option>\n          "; 
            }
        ?>
        	</select>
        	<select size="1" name="mesenasc" id="mesenasc" onchange="javascript: caricaGiorni('giornonasc','mesenasc','annonasc');">
          		<?php
            for ($i=1;$i<=12;$i++) {
                  echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          "; 
            }
        ?>
        	</select>
        <select size="1" name="annonasc" id="annonasc" onchange="javascript: caricaGiorni('giornonasc','mesenasc','annonasc');">
            <?php
            for ($i=1900;$i<=date("Y");$i++) {
                  echo "<option>".$i."</option>\n          "; 
            }
            ?>
        </select></td>
      </tr>
      <tr>
        <td>Sesso</td>
        <td><input type="radio" name="sesso" value="M">M<input type="radio" name="sesso" value="F">F</td>
      </tr>
      <tr>
        <td>Nome Utente</td>
        <td><input id="username" name="username" maxlength="50" size="20"></td>
      </tr>
      <tr>
        <td>Password</td>
        <td><input id="password" maxlength="20" size="20" name="password"></td>
      </tr>
      <tr>
        <td colspan="2">Inviare un'email al socio con il nome utente e la password?<br>
        	<input id="passmail" type="radio" checked="checked" name="passmail" value="1">Si<input id="passmail" type="radio" name="passmail" value="0">No
        </td>
      </tr>
      <tr>
        <td>Tipo Socio</td>
        <td>
        <select size="1" name="tiposocio" onchange="changeTiposocio()">
        <?php 
        echo "<option selected value=\"SO\">Socio Ordinario</option>";
        echo "<option value=\"SS\">Socio Sostenitore</option>";
        echo "<option value=\"SW\">Socio Web</option>";
        echo "<option value=\"SJ\">Socio Junior</option>";
        echo "<option value=\"SG\">Socio Giovane</option>";
        echo "<option value=\"SF\">Socio Famiglia</option>";
        echo "<option value=\"AB\">Amico della bicicletta</option>";
        echo "<option value=\"FA\">Familiare di:</option>";
            ?>
        </select><br>
        <?php 
            $db2 = new db_local();
        $db2->query("SELECT id,cognome,nome from anagrafiche WHERE tiposocio = 'SF' AND approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY cognome,nome;");
        echo "\t<select class=\"fam\" style=\"display:none\" size=\"1\" name=\"associato\" id=\"associato\">\n";
        while ($db2->next_record())
        {
            echo "\t\t\t<option value=\"".intval($db2->record['id'])."\">".$db2->record['cognome']." ".$db2->record['nome']."</option>\n";
        }
        echo "  	</select>";
        $db2->close();    
        unset($db2);
    ?>
        </td>
      </tr>
      <tr>
        <td>Comune</td>
        <td><input maxlength="50" size="20" name="citta"></td>
      </tr>
      <tr>
        <td>CAP</td>
        <td><input maxlength="8" size="20" name="cap"></td>
      </tr>
      <tr>
        <td>Provincia</td>
        <td><input maxlength="50" size="20" name="prov"></td>
      </tr>
      <tr>
        <td>Indirizzo</td>
        <td><input maxlength="255" size="20" name="indirizzo"></td>
      </tr>
      <tr>
        <td>Data iscrizione</td>
        <td>
        <select size="1" name="giornoisc" id="giornoisc">
            <?php
            for ($i=1;$i<=31;$i++) {
                  echo '<option value="'.$i.'">'.$i."</option>\n          "; 
            }
            ?>
        </select>
        <select size="1" name="meseisc" id="meseisc" onchange="javascript: caricaGiorni('giornoisc','meseisc','annoisc');">
            <?php
            for ($i=1;$i<=12;$i++) {
                  echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          "; 
            }
            ?>
        </select>
        <select size="1" name="annoisc" id="annoisc" onchange="javascript: caricaGiorni('giornoisc','meseisc','annoisc');">
            <?php
            for ($i=date("Y");$i>=2010;$i--) {
                      echo "<option>".$i."</option>\n          "; 
            }
            ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>telefono 1 privato</td>
        <td><input maxlength="15" size="20" name="tel1"></td>
      </tr>
      <tr>
        <td>telefono 2 associazione</td>
        <td><input maxlength="15" size="20" name="tel2"></td>
      </tr>
      <tr>
        <td>cellulare</td>
        <td><input maxlength="15" size="20" name="cell"></td>
      </tr>
      <tr>
        <td>email</td>
        <td><input maxlength="100" size="20" name="email"></td>
      </tr>
      <tr>
        <td>carica</td>
        <td>
        <select size="1" name="carica">
        <?php 
        echo "<option selected value=\"AS\">Associato</option>";
        echo "<option value=\"VS\">Volontario Sede</option>";
        echo "<option value=\"VG\">Volontario Giornalino</option>";
        echo "<option value=\"VA\">Volontario</option>";
        echo "<option value=\"S\">Segreteria</option>";
        echo "<option value=\"C\">Capo Gita</option>";
        echo "<option value=\"A\">Amministratore</option>";
            ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>anno</td>
        <td><?php 
        if (date("Y") == 2007) {
            echo "<input checked type=\"checkbox\" name=\"a2007\" value=\"1\">2007 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2007\" value=\"1\">2007 "; 
        }
        if (date("Y") == 2008) {
            echo "<input checked type=\"checkbox\" name=\"a2008\" value=\"1\">2008 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2008\" value=\"1\">2008 "; 
        }
        if (date("Y") == 2009) {
            echo "<input checked type=\"checkbox\" name=\"a2009\" value=\"1\">2009<br>"; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2009\" value=\"1\">2009<br>"; 
        }
        if (date("Y") == 2010) {
            echo "<input checked type=\"checkbox\" name=\"a2010\" value=\"1\">2010 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2010\" value=\"1\">2010 "; 
        }
        if (date("Y") == 2011) {
            echo "<input checked type=\"checkbox\" name=\"a2011\" value=\"1\">2011 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2011\" value=\"1\">2011 "; 
        }
        if (date("Y") == 2012) {
            echo "<input checked type=\"checkbox\" name=\"a2012\" value=\"1\">2012<br>"; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2012\" value=\"1\">2012<br>"; 
        }
        if (date("Y") == 2013) {
            echo "<input checked type=\"checkbox\" name=\"a2013\" value=\"1\">2013 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2013\" value=\"1\">2013 "; 
        }
        if (date("Y") == 2014) {
            echo "<input checked type=\"checkbox\" name=\"a2014\" value=\"1\">2014 "; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2014\" value=\"1\">2014 "; 
        }
        if (date("Y") == 2015) {
            echo "<input checked type=\"checkbox\" name=\"a2015\" value=\"1\">2015"; 
        }
        else { 
            echo "<input type=\"checkbox\" name=\"a2015\" value=\"1\">2015"; 
        }
        if (date("Y") == 2016) {
            echo "<input checked type=\"checkbox\" name=\"a2016\" value=\"1\">2016"; 
        }
        else {
            echo "<input type=\"checkbox\" name=\"a2016\" value=\"1\">2016"; 
        }
        if (date("Y") == 2017) {
            echo "<input checked type=\"checkbox\" name=\"a2017\" value=\"1\">2017"; 
        }
        else {
            echo "<input type=\"checkbox\" name=\"a2017\" value=\"1\">2017"; 
        }
        if (date("Y") == 2018) {
            echo "<input checked type=\"checkbox\" name=\"a2018\" value=\"1\">2018"; 
        }
        else {
            echo "<input type=\"checkbox\" name=\"a2018\" value=\"1\">2018"; 
        }
        if (date("Y") == 2019) {
            echo "<input checked type=\"checkbox\" name=\"a2019\" value=\"1\">2019"; 
        }
        else {
            echo "<input type=\"checkbox\" name=\"a2019\" value=\"1\">2019"; 
        }
        if (date("Y") == 2020) {
            echo "<input checked type=\"checkbox\" name=\"a2020\" value=\"1\">2020"; 
        }
        else {
            echo "<input type=\"checkbox\" name=\"a2020\" value=\"1\">2020"; 
        }
            ?></td>
      </tr>
      <tr>
        <td>Cauzione</td>
        <td><input type="radio" name="cauzione" value="SI">SI<input checked='checked' type="radio" name="cauzione" value="NO">NO</td>
      </tr>
      <tr>
        <td>Note</td>
        <td><textarea cols="20" rows="4" name="note"></textarea></td>
      </tr>
      <tr>
        <td>Approvato</td>
        <td>
        <select size="1" name="approvato">
        	<option value="0">NO</option>
          	<option selected value="1">SI</option>
        </select>
        </td>
      </tr>
      <tr>
        <td><button name="reset" type="reset">Reset</button></td>
        <td><button type="submit" name="invio" onclick="sendemailpass();">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
</html>