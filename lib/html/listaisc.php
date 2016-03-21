<td bgcolor="#CCFFCC"
<?php
	makeHead("Lista iscritti alla gita");
	echo "<table border=\"1\" align=\"center\">";
	echo "  <tr>";
	echo "    <td colspan=\"2\" bgcolor=\"#CCFFCC\">Numero iscritti: ".$db->num_rows()."</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td bgcolor=\"#CCFFCC\">Nomi</td>";
	echo "    <td bgcolor=\"#CCFFCC\">Data iscrizione</td>";
	echo "  </tr>";
	while ($db->next_record()) {
		echo "  <tr>";
		//echo "    <td>".$db->record['nome']." ".substr($db->record['cognome'],0,1).".</td>";
		echo "    <td>".$db->record['nome']." ".$db->record['cognome']."</td>";
		echo "    <td>".date("d/m/Y",$db->record['data'])."</td>";
		echo "  </tr>";
	}
    	IF($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM nonsoci,iscrizioni WHERE nonsoci.id = iscrizioni.idassociato AND iscrizioni.idresp = CONCAT(iscrizioni.idassociato,'-NS') AND iscrizioni.idgita = '".$_GET['iscrid']."' ORDER BY data,nonsoci.nome;"))
	{
		while ($db->next_record()) {
			echo "  <tr>";
			//echo "    <td>".$db->record['nome']." ".substr($db->record['cognome'],0,1).".</td>";
			echo "    <td>".$db->record['nome']." ".$db->record['cognome']." (Non socio)</td>";
			echo "    <td>".date("d/m/Y",$db->record['data']).".</td>";
			echo "  </tr>";
		}
	}
	echo "</table>";
	makeTail();
?>