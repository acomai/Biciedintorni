<?php
	$db = new db_local();
	$db->query("SELECT gite.titolo,gite.dataeora as datagita, anagrafiche.nome,anagrafiche.cognome,iscrizioni.* FROM gite,iscrizioni,anagrafiche WHERE gite.id = idgita AND anagrafiche.id = idassociato AND (idassociato = '".$this->matricola."' OR iscrizioni.idresp = '".$this->matricola."') ORDER BY gite.dataeora DESC, iscrizioni.dataeora, iscrizioni.idresp;");
	echo "<table style=\"\" border=\"1\" align=\"center\">\n";
	echo "  <tr>\n";
	echo "    <td colspan=\"5\" class=\"title\">Numero di iscrizioni: ".$db->num_rows()."</td>\n";
	echo "  </tr>\n";
	echo "  <tr>\n";
	echo "    <td class=\"title\">Data Gita</td>\n";
	echo "    <td class=\"title\">Titolo Gita</td>\n";
	echo "    <td colspan=\"2\" class=\"title\">&nbsp;</td>\n";
	echo "    <td class=\"title\">Data Iscrizione</td>\n";
	echo "  </tr>\n";
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td class=\"dati\"> ".substr($db->record['datagita'],8,2)."/".substr($db->record['datagita'],5,2)."/".substr($db->record['datagita'],0,4)." </td>\n";
		echo "    <td><a title=\"".$db->record['titolo']."\" href=\"index.php?id=".$db->record['idgita']."\">".$db->record['titolo']."</a></td>\n";
		echo "    <td><a href=\"\" onclick=\"eliminaisc(".$db->record['id']."); return false; \">Cancella:&nbsp;</a></td>\n						";
		if(intval($db->record['idassociato']) != intval($this->matricola))
			echo "    <td>".$db->record['nome']." ".$db->record['cognome']."</td>\n";
		else
			echo "    <td><b>".$db->record['nome']." ".$db->record['cognome']."</b></td>\n";
		echo "    <td class=\"dati\"> ".substr($db->record['dataeora'],8,2)."/".substr($db->record['dataeora'],5,2)."/".substr($db->record['dataeora'],0,4)." </td>\n";
		echo "  </tr>\n";
	}
	echo "</table>\n";
	$db->close();
	unset($db);
?>