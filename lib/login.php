<?php

include_once(dirname(__FILE__)."/class.php");
$mesi = array("1"=>"Gennaio","2"=>"Febbraio","3"=>"Marzo","4"=>"Aprile","5"=>"Maggio","6"=>"Giugno","7"=>"Luglio","8"=>"Agosto","9"=>"Settembre","10"=>"Ottobre","11"=>"Novembre","12"=>"Dicembre");

$azzera = ''.
"<script type=\"text/javascript\">\n".
"			function azzera()\n".
"			{\n".
"				el = prendiElementoDaTuttiId('nota');\n".
"				el.style.display = 'none';\n".
"				el = prendiElementoDaTuttiId('login');\n".
"				el.style.display = 'none';\n".
"			}\n".
"			function vis(par)\n".
"			{\n".
"				if (par == 1)\n".
"				{\n".
"					el = prendiElementoDaTuttiId('nota');\n".
"					el.style.display = 'none';\n".
"					el = prendiElementoDaTuttiId('login');\n".
"					el.style.display = '';\n".
"				}\n".
"				else\n".
"				{\n".
"					el = prendiElementoDaTuttiId('login');\n".
"					el.style.display = 'none';\n".
"					el = prendiElementoDaTuttiId('nota');\n".
"					el.style.display = '';\n".
"				}\n".
"			}\n".
"		</script>";

if (($dove == "admin.php") && (!$_GET['iscr']))
	$area = "Login Amministrazione";
elseif ($_GET['iscr'])
{
	$area = "Login Amministrazione";
	$dove = "admin.php?iscr=".$_GET['iscr'];
	makeHead($area,$azzera,"onload=\"azzera()\"");
	}else {
	$area = "Login";
	$dove = "index.php?iscr=".$_GET['iscr'];
	makeHead($area,$azzera,"onload=\"azzera()\"");
}
if (is_numeric($_GET['iscr']))
{
?>
<div style="height:600px; font-weight: bold;font-size:12px;" align="center" id="scelta">
	Prima di proseguire, scegli una
	<br>
	tra le seguenti opzioni:
	<br><br><br>
	<table>
	<tbody align="left">
	<tr><td><input name="radio" type="radio" onclick="vis(1)"> Sono un socio.</td></tr>
	<tr><td><input name="radio" type="radio" onclick="vis(0)"> Non sono un socio.</td></tr>
	</tbody>
	</table>
<div id="nota" align="center" style="display:none;">
<center><h3>Note</h3></center>
<table align="center">
	<tr>
		<td valign="top">1)&nbsp;&nbsp;&nbsp;</td>
		<td>L'iscrizione di un non socio alla gita comporta una maggiorazione di 5 euro, se non diversamente 
		specificato nella scheda della gita.
   		</td>
	</tr>
	<tr>
		<td valign="top">2)&nbsp;&nbsp;&nbsp;</td><td>Per le gite con trasporto (bici + treno oppure bici + bus) e/o 
		con pernottamento il saldo della quota va versato entro le ore 18,30 del venerdì precedente alla gita, presso 
		la sede di via Andorno 35/b a Torino, oppure con bonifico (IBAN IT27T0760101000000033663105, indicando nella 
		causale "iscrizione alla gita XXXXXX").<br><br>
		Per le gite che non richiedono trasporto né pernottamento la quota gita, maggiorata di 5 euro per i non soci,
		può essere versata al Capogita prima della partenza.</td>
	</tr>
	<tr>
		<td valign="top">3)&nbsp;&nbsp;&nbsp;</td><td>Il non socio deve in ogni caso contattare appena possibile il Capogita, per email o per 
		telefono, e comunque prima di procedere al pagamento della quota.</td>
	</tr>
	<tr>
		<td colspan="2">
			<form id="nonsocio" method="post" action="<?php echo $dove; ?>">
			  <table align="center" style="text-align: left;" border="0" cellpadding="2" cellspacing="2">
			    <tbody>
			      <tr>
			        <td colspan="2">* i campi con asterisco sono obbligatori.</td>
			      </tr>
			      <tr>
			        <td class="obbligatori">Nome*: </td>
			        <td><input maxlength="50" size="20" tabindex="1" name="nome"></td>
			      </tr>
			      <tr>
			        <td class="obbligatori">Cognome*: </td>
			        <td><input maxlength="50" size="20" tabindex="2" name="cognome"></td>
			      </tr>
			      <tr>
			        <td class="obbligatori">Telefono*: </td>
			        <td><input maxlength="15" size="20" tabindex="9" name="tel1"></td>
			      </tr>
			      <tr>
			        <td class="obbligatori">Email*: </td>
			        <td><input maxlength="100" size="20" tabindex="11" name="email"></td>
			      </tr>
			      <tr>
			        <td>Indirizzo: </td>
			        <td><input maxlength="255" size="20" tabindex="5" name="indirizzo"></td>
			      </tr>
			      <tr>
			        <td>Cellulare: </td>
			        <td><input maxlength="15" size="20" tabindex="9" name="cell"></td>
			      </tr>
			      <tr>
			        <td>Sesso: </td>
			        <td><input type="radio" tabindex="3" name="sesso" value="M">M<input type="radio" tabindex="3" name="sesso" value="F">F</td>
			      </tr>
			      <tr>
			        <td>Comune: </td>
			        <td><input maxlength="50" size="20" tabindex="5" name="comune"></td>
			      </tr>
			      <tr>
			        <td>CAP: </td>
			        <td><input maxlength="8" size="20" tabindex="5" name="cap"></td>
			      </tr>
			      <tr>
			        <td>Provincia: </td>
			        <td><input maxlength="50" size="20" tabindex="5" name="prov"></td>
			      </tr>
			      <tr>
			        <td>Data di nascita: </td>
			        <td>
			        <span id="giorni"><select tabindex="6" size="1" name="giorno">
			        	<option selected="selected">--</option>
			        <?php
			          	for($i=1;$i<=31;$i++)
			          	{
			          		echo "<option>".$i."</option>\n          ";
			          	}
			        ?>
			        </select></span>
			        <select tabindex="7" size="1" name="mese" onchange="javascript: caricaGiorni();">
			        	<option selected="selected" value="0">-----</option>
			          <?php
			          	for($i=1;$i<=12;$i++)
			          	{
			          		echo '<option value="'.$i.'">'.$mesi[$i]."</option>\n          ";
			          	}
			          ?>
			        </select>
			        <select tabindex="8" size="1" name="anno" onchange="javascript: caricaGiorni();">
			        	<option selected="selected">--</option>
			          <?php
			          	for($i=1900;$i<date("Y");$i++)
			          	{
			          		echo "<option>".$i."</option>\n          ";
			          	}
			          	echo "<option>".date("Y")."</option>\n          ";
			          ?>
			        </select>
			        </td>
			      </tr>
			      <tr>
			        <td><button tabindex="16" name="reset" type="reset">Reset</button></td>
			        <td><button type="submit" tabindex="15" name="invio">Invio</button></td>
			      </tr>
			    </tbody>
			  </table>
			  <input type="hidden" value='1' name="nonsocio">
			</form>
		  </td>
	</tr>
</table>
</div>

<?php
}
?>
<div id="login">
<center><h3><?php echo $area; ?></h3></center>
<div align="center" style="font-style: italic;"><h3>Gestione Gite ed Eventi - Interfaccia di autenticazione</h3></div><br>
<table align="center" cellpadding="0" cellspacing="0">
	<tr>
  		<td colspan="2" align="center"><br><img src="img/infologin.jpg" title="Dovete loggarvi" alt="Dovete loggarvi"><br><br></td>
  	</tr>
	<tr>
  		<td width="177px" height="268px" background="img/sfondologin_left.jpg">&nbsp;</td>
  		<td class="intestazionel" width="281px" height="268px" align="center" background="img/sfondologin_right.jpg">
		  <form name="login" method="post" action="<?php echo $dove; ?>">
			<table align="center">
			  <tr>
				<td align="right">Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right"><input class="inp" type="text" size="20" name="entered_user" maxlength="50"></td>
			  </tr>
			  <tr>
				<td align="right">Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			  </tr>
			  <tr>
				<td align="right"><input class="inp" type="password" size="20" name="entered_password" maxlength="20"></td>
			  </tr>
			  <tr>
				<td align="right">
					<button type="submit" style="background: #e5e5dd; width:90px;height:30px;border:none;outline: none;"><img alt="Entra" src="img/entra.jpg"></button>
					<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
				</td>
			  </tr>
			  <tr>
			  	<td align="right"><a style="text-decoration:none;" href="http://www.biciedintorni.it/index.php?option=com_contact&task=view&contact_id=1&Itemid=11">Se riscontrate problemi di accesso,<br>cliccate [qui] e scrivete al WebMaster.</a><br><br></td>
			  </tr>
			  <tr>
    			<td colspan="2" align="right"><a style="text-decoration:none;" href="http://www.biciedintorni.it/wordpress/">Torna alla Home Page del sito.</a></td>
  			  </tr>
			  <tr>
    			<td colspan="2" align="right"><a style="text-decoration:none;" href="http://www.biciedintorni.it/application/admin.php?reqpass=1">Hai dimenticato la password? [clicca qui].</a></td>
  			  </tr>
			</table>
		  </form>
	  	  <? echo $message; ?>
		</td>
	</tr>
</table>
</div>

<?php
if (is_numeric($_GET['iscr']))
{
	echo "</div>";
}
 makeTail(); ?>