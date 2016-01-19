<?php /* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<div id="title" align="center">Modifica Libro</div>
<br>
<form id="modlibro" method="post" action="admin.php?fun=modlibro&amp;save=1" name="modlibro">
  <table align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td>Titolo</td>
        <td><input id="titolo" maxlength="50" size="20" name="titolo" value="<?php echo $db->record['titolo']; ?>"></td>
      </tr>
      <tr>
        <td>Sottotitolo</td>
        <td><input id="sottotitolo" maxlength="50" size="20" name="sottotitolo" value="<?php echo $db->record['sottotitolo']; ?>"></td>
      </tr>
      <tr>
        <td>Autore</td>
        <td><input id="autore" maxlength="50" size="20" name="autore" value="<?php echo $db->record['autore']; ?>"></td>
      </tr>
      <tr>
        <td>Editore</td>
        <td><input id="editore" maxlength="50" size="20" name="editore" value="<?php echo $db->record['editore']; ?>"></td>
      </tr>
      <tr>
        <td>Citt&agrave;</td>
        <td><input id="citta" maxlength="50" size="20" name="citta" value="<?php echo $db->record['citta']; ?>"></td>
      </tr>
      <tr>
        <td>Anno</td>
        <td><input id="anno" name="anno" maxlength="4" size="20" value="<?php echo $db->record['anno']; ?>"></td>
      </tr>
      <tr>
        <td>Pagine</td>
        <td><input id="pagine" maxlength="20" size="20" name="pagine" value="<?php echo $db->record['pagine']; ?>"></td>
      </tr>
      <tr>
        <td>Lingua</td>
        <td><input id="lingua" maxlength="20" size="20" name="lingua" value="<?php echo $db->record['lingua']; ?>"></td>
      </tr>
      <tr>
        <td>Note</td>
        <td><input maxlength="20" size="20" name="note" value="<?php echo $db->record['note']; ?>"></td>
      </tr>
      <tr>
        <td>Costo</td>
        <td><input maxlength="20" size="20" name="costo" value="<?php echo $db->record['costo']; ?>"></td>
      </tr>
      <tr>
        <td>Scaffale</td>
        <td><input maxlength="50" size="20" name="scaffale" value="<?php echo $db->record['scaffale']; ?>"></td>
      </tr>
      <tr>
        <td>Classificazione</td>
        <td><input maxlength="255" size="20" name="classificazione" value="<?php echo $db->record['classificazione']; ?>"></td>
      </tr>
      <tr>
        <td>Descrizione</td>
        <td><textarea name="descrizione" rows="10" cols="19"><?php echo $db->record['descrizione']; ?></textarea></td>
      </tr>
      <tr>
        <td>Nazione</td>
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
        <td>Argomento</td>
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
        <td align="left">&nbsp;</td>
        <td align="right"><input type="hidden" name="id" value="<?php echo $db->record['id']; ?>"><button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
<br>