<?php
	$mesi = array("1"=>"Gennaio","2"=>"Febbraio","3"=>"Marzo","4"=>"Aprile","5"=>"Maggio","6"=>"Giugno","7"=>"Luglio","8"=>"Agosto","9"=>"Settembre","10"=>"Ottobre","11"=>"Novembre","12"=>"Dicembre");
?>
<form id="bimbimbici" method="post" action="bimbimbici.php">
  <div align="center"><h2>Compilare una scheda per ogni bambino/bambina che si vuole iscrivere.</h2></div>
  <table align="center" style="text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td colspan="2" align="center">* i campi sono obbligatori per potersi iscrivere.</td>
      </tr>
      <tr>
        <td class="obbligatori">Nome del bambino/bambina*: </td>
        <td><input maxlength="50" size="25" name="nome"></td>
      </tr>
      <tr>
        <td class="obbligatori">Cognome*: </td>
        <td><input maxlength="50" size="25" name="cognome"></td>
      </tr>
      <tr>
        <td class="obbligatori">Data di nascita*: </td>
        <td>
        <span id="giorni"><select size="1" name="giorno">
        	<option selected="selected">--</option>
        <?php
          	for($i=1;$i<=31;$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}
        ?>
        </select></span>
        <select size="1" name="mese" onchange="javascript: caricaGiorni();">
        	<option selected="selected" value="0">-----</option>
          <?php
          	for($i=1;$i<=12;$i++)
          	{
          		echo '<option value="'.$i.'">'.$mesi[$i]."</option>\n          ";
          	}
          ?>
        </select>
        <select size="1" name="anno" onchange="javascript: caricaGiorni();">
        	<option selected="selected">--</option>
          <?php
          	for($i=1990;$i <= date("Y") - 2;$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}
          ?>
        </select>
        </td>
      </tr>	  <tr>        <td class="obbligatori">Telefono dei genitori*: </td>        <td><input maxlength="15" size="25" name="telefono"></td>      </tr>	  <tr>        <td class="obbligatori">Nome e Cognome dell'accompagnatore*: </td>        <td><input maxlength="100" size="25" name="nomeaccomp"></td>      </tr>
      <tr>
        <td class="obbligatori">Telefono dell'accompagnatore*: </td>
        <td><input maxlength="15" size="25" name="telaccomp"></td>
      </tr>
	  <tr>
        <td class="obbligatori">Indirizzo e Comune di residenza genitori*: </td>
        <td><input maxlength="100" size="25" name="comune"></td>
      </tr>
      <tr>
        <td>Email: </td>
        <td><input maxlength="100" size="25" name="email"></td>
      </tr>
	  <tr>
        <td class="obbligatori">Ho preso visione del regolamento*: </td>
		<td><input type='checkbox' name='regolamento' value='1'>Si</td>
      </tr>
      <tr>
        <td>Autorizzo il trattamento dei dati personali: </td>
		<td><input type='radio' checked name='privacy' value='1'>Si<input type='radio' name='privacy' value='0'>No</td>
      </tr>
      <tr>
        <td><button name="reset" type="reset">Reset</button></td>
        <td><button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
  <input type="hidden" value='1' name="bimbo">
</form>