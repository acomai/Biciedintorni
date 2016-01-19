	<div align="center" id="title"><h4><a href="biblioteca.php">&#60;&#60;Indietro</a></h4></div>
	<table>
	  <tr>
	    <td colspan="12" class="title">Numero di libri: <?php echo $db->num_rows();?></td>
	  </tr>
	  <tr>
	    <th class="title">Titolo</th>
	    <th class="title">Argomento</th>
	    <th class="title">Nazione</th>
	    <!--<td class="title">Citt&agrave;</td>-->
	    <th class="title">Autore</th>
	    <!--<td class="title">Editore</td>-->
	    <th class="title">Anno</th>
	    <!--<td class="title">Lingua</td>
	    <td class="title">Pagine</td>-->
	    <th class="title">Classificazione</th>
	    <th class="title">Descrizione</th>
	    <!--<td class="title">Note</td>
	    <td class="title">Scaffale</td>-->
	  </tr>
<?php
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td><b>" . $db->record['titolo'] . "</b><br>" . $db->record['sottotitolo'] . "<br><a href=\"biblioteca.php?fun=vislibro&amp;id=". $db->record['id'] . "\">Visualizza dettagli</a></td>\n";
		echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idarg=". $db->record['idarg'] . "\">" . $db->record['argomento'] . "</a></td>\n";
		echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idnaz=". $db->record['idnaz'] . "\">" . $db->record['nazione'] . "</a></td>\n";
		/*echo "    <td>" . $db->record['citta']."</td>\n";*/
		echo "    <td>" . $db->record['autore'] . "</td>\n";
		/*echo "    <td>" . $db->record['editore'] . "</td>\n";*/
		echo "    <td>" . $db->record['anno'] . "</td>\n";
		/*echo "    <td>" . $db->record['lingua'] . "</td>\n";
		echo "    <td>" . $db->record['pagine'] . "</td>\n";*/
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