<?php /* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<!DOCTYPE html>
<html lang="it">
<!-- Gestisce l'inserimento di un libro nell'applicativo di Bici e Dintorni.
	Ci si arriva dall'area riservata, con profilo amministratore.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - Inserimento libro biblioteca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<div align="center"><strong>FIAB Torino Bici e Dintorni - Inserimento Libro</strong>
<script>
    document.write(' - <a href="' + document.referrer + '">Indietro</a>');
</script></div>
<br>
<form id="newlibro" method="post" action="admin.php?fun=newlibro&amp;save=1" name="newlibro">
  <table align="center" style="text-align: left;" border="0" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td><strong>Titolo</strong></td>
        <td><input id="titolo" maxlength="50" size="50" name="titolo" required></td>
      </tr>
      <tr>
        <td><strong>Sottotitolo</strong></td>
        <td><input id="sottotitolo" maxlength="50" size="50" name="sottotitolo"></td>
      </tr>
      <tr>
        <td><strong>Autore</strong></td>
        <td><input id="autore" maxlength="50" size="50" name="autore"></td>
      </tr>
      <tr>
        <td><strong>Editore</strong></td>
        <td><input id="editore" maxlength="50" size="50" name="editore"></td>
      </tr>
      <tr>
        <td><strong>Citt&agrave;</strong></td>
        <td><input id="citta" maxlength="50" size="50" name="citta"></td>
      </tr>
      <tr>
        <td><strong>Anno</strong></td>
        <td><input id="anno" name="anno" maxlength="4" size="4"></td>
      </tr>
      <tr>
        <td><strong>Descrizione</strong></td>
        <td><textarea name="descrizione" rows="5" cols="48"></textarea></td>
      </tr>
      <tr>
        <td><strong>Nazione</strong></td>
        <td>
        <select size="1" name="idnazione">
        <?php
        	unset($db2);
        	$db2 = new db_local();
			if($db2->query("SELECT * FROM nazioni ORDER BY id;",true))
			{
				while ($db2->next_record())
				{
        			echo "<option value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
				}
			}
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td><strong>Argomento</strong></td>
        <td><select size="1" style="width: 300px" name="idarg">
        <?php
        	unset($db2);
        	$db2 = new db_local();
			if($db2->query("SELECT * FROM argomenti ORDER BY nome;"))
			{
				while ($db2->next_record())
				{
        			echo "<option value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
				}
			}
          ?>
        </select></td>
      </tr>
      <tr>
        <td><strong>Pagine</strong></td>
        <td><input id="pagine" maxlength="20" size="20" name="pagine"></td>
      </tr>
      <tr>
        <td><strong>Lingua principale</strong></td>
        <td><select id="lingua" name="lingua" style="width: 300px">
        	<option value="Italiano">Italiano</option>
  			<option value="Francese">Francese</option>
  			<option value="Inglese">Inglese</option>
  			<option value="Spagnolo">Spagnolo</option>
  			<option value="Tedesco">Tedesco</option>
  			<option value="Altro">Altro</option>
  			</select>
        </td>
      </tr>

      <tr>
        <td><strong>Costo</strong></td>
        <td><input maxlength="20" size="20" name="costo"></td>
      </tr>
      <tr>
        <td><strong>Scaffale</strong></td>
        <td><input maxlength="50" size="50" name="scaffale"></td>
      </tr>
      <tr>
        <td><strong>Classificazione</strong></td>
        <td><input maxlength="255" size="50" name="classificazione"></td>
      </tr>
      <tr>
        <td><strong>Note</strong></td>
        <td><input maxlength="50" size="50" name="note"></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="right"><button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
<br>