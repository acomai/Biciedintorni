	<div align="center" id="title"><h4><a href="biblioteca.php">&#60;&#60;Indietro</a></h4></div>
	<table>
	  <tr>
	    <td colspan="11" class="title">Numero di cartine: <?php echo $db->num_rows();?></td>
	  </tr>
	  <tr>
	    <th class="title">Titolo</th>
	    <th class="title">Nazione</th>
	    <th class="title">Citt&agrave;</th>
	    <!--<td class="title">Autore</td>
	    <td class="title">Editore</td>
	    <td class="title">Anno</td>
	    <td class="title">Lingua</td>-->
	    <th class="title">Scala</th>
	    <th class="title">Classificazione</th>
	    <th class="title">Descrizione</th>
	    <!--<td class="title">Note</td>
	    <td class="title">Scaffale</td>-->
	  </tr>
<?php
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td><b>" . $db->record['titolo'] . "</b><br>" . $db->record['sottotitolo'] . "<br><a href=\"biblioteca.php?fun=viscart&amp;id=". $db->record['id'] . "\">Visualizza dettagli</a></td>\n";
		echo "    <td><a href=\"biblioteca.php?sez=cart&amp;idnaz=". $db->record['idnaz'] . "\">" . $db->record['nazione'] . "</a></td>\n";
		echo "    <td>" . $db->record['citta']."</td>\n";
		/*echo "    <td>" . $db->record['autore'] . "</td>\n";
		echo "    <td>" . $db->record['editore'] . "</td>\n";
		echo "    <td>" . $db->record['anno'] . "</td>\n";
		echo "    <td>" . $db->record['lingua'] . "</td>\n";*/
		echo "    <td>" . $db->record['scala'] . "</td>\n";
		echo "    <td>" . $db->record['classificazione'] . "</td>\n";
		echo "    <td>" . $db->record['descrizione'] . "</td>\n";
		/*echo "    <td>" . $db->record['note'] . "</td>\n";
		echo "    <td>" . $db->record['scaffale'] . "</td>\n";*/
		echo "  </tr>\n";
	}
	echo "</table>\n";
	$db->close();
	unset($db);
?>