<?php /* include_once("../class.php");
makeHead("","<script type=\"text/javascript\" src=\"../js/ajax.js\"></script>");
*/
?>
<div id="title" align="center">Aggiungi una Cartina</div>
<br>
<form id="newcartina" method="post" action="admin.php?fun=newcartina&amp;save=1" name="newcartina">
  <table align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td>Titolo</td>
        <td><input id="titolo" maxlength="255" size="50" name="titolo"></td>
      </tr>
      <tr>
        <td>Sottotitolo</td>
        <td><input id="sottotitolo" maxlength="255" size="50" name="sottotitolo"></td>
      </tr>
      <tr>
        <td>Autore</td>
        <td><input id="autore" maxlength="255" size="50" name="autore"></td>
      </tr>
      <tr>
        <td>Editore</td>
        <td><input id="editore" maxlength="255" size="50" name="editore"></td>
      </tr>
      <tr>
        <td>Citt&agrave;</td>
        <td><input id="citta" maxlength="255" size="50" name="citta"></td>
      </tr>
      <tr>
        <td>Anno</td>
        <td><input id="anno" name="anno" maxlength="4" size="4"></td>
      </tr>
      <tr>
        <td>Lingua</td>
        <td><input id="lingua" maxlength="20" size="20" name="lingua"></td>
      </tr>
      <tr>
        <td>Note</td>
        <td><input maxlength="255" size="50" name="note"></td>
      </tr>
      <tr>
        <td>Costo</td>
        <td><input maxlength="255" size="50" name="costo"></td>
      </tr>
      <tr>
        <td>Scaffale</td>
        <td><input maxlength="255" size="50" name="scaffale"></td>
      </tr>
      <tr>
        <td>Classificazione</td>
        <td><input maxlength="255" size="50" name="classificazione"></td>
      </tr>
      <tr>
        <td>Descrizione</td>
        <td><textarea name="descrizione" rows="10" cols="49"></textarea></td>
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
        			
        			echo "<option value=\"".$db2->record['id']."\">".$db2->record['nome']."</option>";
				}
			}
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Scala</td>
        <td><input maxlength="255" size="50" name="scala"></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="right"><button type="submit" name="invio">Invio</button></td>
      </tr>
    </tbody>
  </table>
</form>
<br>