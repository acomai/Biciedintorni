<?php
	$db = new db_local();
	if($_GET["all"] == 1)
		$db->query("SELECT dataeora,titolo,nome,cognome FROM gite,anagrafiche WHERE anagrafiche.id = gite.idresp ORDER BY dataeora DESC;");
	else
		$db->query("SELECT dataeora,titolo,nome,cognome FROM gite,anagrafiche WHERE anagrafiche.id = gite.idresp AND YEAR(dataeora) >= ".date("Y")." ORDER BY dataeora;");
	echo "<table class=\"funlistagite\" border=\"0\" align=\"center\">\n";
	echo "  <tr>\n";
	echo "    <td colspan=\"3\" class=\"title\"><a href='admin.php?fun=listagite&all=1'>Visualizza tutte le gite.</a></td>\n";
	echo "  </tr>\n";
	echo "  <tr>\n";
	echo "    <td colspan=\"3\" class=\"title\">Numero di gite: ".$db->num_rows()."</td>\n";
	echo "  </tr>\n";
	echo "  <tr>\n";
	echo "    <td class=\"title\">Data e ora</td>\n";
	echo "    <td class=\"title\">Titolo</td>\n";
	echo "    <td class=\"title\">Capo Gita</td>\n";
	echo "  </tr>\n";
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td class=\"dati\"> ".substr($db->record['dataeora'],8,2)."/".substr($db->record['dataeora'],5,2)."/".substr($db->record['dataeora'],0,4)." </td>\n";
		echo "    <td> ".$db->record['titolo']." </td>\n";
		echo "    <td> ".$db->record['nome']." ".$db->record['cognome']." </td>\n";
		echo "  </tr>\n";
	}
	echo "</table>\n";
	$db->close();
	unset($db);
?>
