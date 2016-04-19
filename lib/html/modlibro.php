<?php /* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<!DOCTYPE html>
<html lang="it">
<!-- Gestisce la modifica di un libro nell'applicativo di Bici e Dintorni.
	Ci si arriva dall'area riservata, con profilo amministratore.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - Modifica libro biblioteca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<div align="center"><strong>FIAB Torino Bici e Dintorni - Modifica Libro</strong>
<script>
    document.write(' - <a href="' + document.referrer + '">Indietro</a>');
</script></div>
<br>
<form id="modlibro" method="post" action="admin.php?fun=modlibro&amp;save=1" name="modlibro">
  <table align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td><strong>Id</strong></td>
        <td><?php echo $db->record['id']; ?></td>
      </tr>
      <tr>
        <td><strong>Titolo</strong></td>
        <td><input id="titolo" maxlength="50" size="50" name="titolo" value="<?php echo $db->record['titolo']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Sottotitolo</strong></td>
        <td><input id="sottotitolo" maxlength="50" size="50" name="sottotitolo" value="<?php echo $db->record['sottotitolo']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Autore</strong></td>
        <td><input id="autore" maxlength="50" size="50" name="autore" value="<?php echo $db->record['autore']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Editore</strong></td>
        <td><input id="editore" maxlength="50" size="50" name="editore" value="<?php echo $db->record['editore']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Citt&agrave;</strong></td>
        <td><input id="citta" maxlength="50" size="50" name="citta" value="<?php echo $db->record['citta']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Anno</strong></td>
        <td><input id="anno" name="anno" maxlength="4" size="4" value="<?php echo $db->record['anno']; ?>"></td>
      </tr>
        <td><strong>Descrizione</strong></td>
        <td><textarea name="descrizione" rows="5" cols="50"><?php echo $db->record['descrizione']; ?></textarea></td>
      </tr>
      <tr>
        <td><strong>Nazione</strong></td>
        <td>
        <select size="1" name="idnazione">
        <?php
        	unset($db2);
        	$db2 = new db_local();
			if($db2->query("SELECT * FROM nazioni ORDER BY nome;",true))
			{
				while ($db2->next_record())
				{
        			if($db2->record['id'] == $db->record['idnazione'])
        			{
        				echo "<option selected value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
        			}
        			else 
        			{
        				echo "<option value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
        			}
				}
			}
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td><strong>Argomento</strong></td>
        <td><select size="1" name="idarg">
        <?php
        	unset($db2);
        	$db2 = new db_local();
			if($db2->query("SELECT * FROM argomenti ORDER BY nome;"))
			{
				while ($db2->next_record())
				{
        			if($db2->record['id'] == $db->record['idarg'])
        			{
        				echo "<option selected value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
        			}
        			else 
        			{
        				echo "<option value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
        			}
				}
			}
          ?>
        </select></td>
      </tr>
      <tr>
        <td><strong>Pagine</strong></td>
        <td><input id="pagine" maxlength="20" size="20" name="pagine" value="<?php echo $db->record['pagine']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Lingua</strong></td>
        <td><input id="lingua" maxlength="20" size="20" name="lingua" value="<?php echo $db->record['lingua']; ?>"></td>
      </tr>

      <tr>
        <td><strong>Costo</strong></td>
        <td><input maxlength="20" size="20" name="costo" value="<?php echo $db->record['costo']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Scaffale</strong></td>
        <td><input maxlength="50" size="50" name="scaffale" value="<?php echo $db->record['scaffale']; ?>"></td>
      </tr>
      <tr>
        <td><strong>Classificazione</strong></td>
        <td><input maxlength="50" size="50" name="classificazione" value="<?php echo $db->record['classificazione']; ?>"></td>
      </tr>
      <tr>
      <tr>
        <td><strong>Note</strong></td>
        <td><input maxlength="50" size="50" name="note" value="<?php echo $db->record['note']; ?>"></td>
      </tr>
      <tr>
        <td align="left"> </td>
        <td align="right"><input type="hidden" name="id" value="<?php echo $db->record['id']; ?>">
        
        <button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
<br>