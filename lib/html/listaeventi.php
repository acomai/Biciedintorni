<?php
	$db = new db_local();
	$db->query("SELECT dataeora,titolo FROM eventi ORDER BY dataeora;");
	echo "<table style=\"\" border=\"1\" align=\"center\">\n";
	echo "  <tr>\n";
	echo "    <td colspan=\"2\" class=\"title\">Numero di eventi: ".$db->num_rows()."</td>\n";
	echo "  </tr>\n";
	echo "  <tr>\n";
	echo "    <td class=\"title\">Data e ora</td>\n";
	echo "    <td class=\"title\">Titolo</td>\n";
	echo "  </tr>\n";
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td class=\"dati\"> ".substr($db->record['dataeora'],8,2)."/".substr($db->record['dataeora'],5,2)."/".substr($db->record['dataeora'],0,4)." </td>\n";
		echo "    <td> ".$db->record['titolo']." </td>\n";
		echo "  </tr>\n";
	}
	echo "</table>\n";
	$db->close();
	unset($db);
?>