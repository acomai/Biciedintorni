<td bgcolor="#CCFFCC"
<?php
	makeHead("Lista iscritti alla gita");
	
	echo "<table border=\"1\" align=\"center\">";
	echo "  <tr>";
	echo "    <td colspan=\"5\" bgcolor=\"#CCFFCC\">Numero iscritti: ".$db->num_rows()."</td>";
	echo "  </tr>";
	echo "  <tr>";
	echo "    <td bgcolor=\"#CCFFCC\">Nomi</td>";
	echo "    <td bgcolor=\"#CCFFCC\">Telefono</td>";
	echo "    <td bgcolor=\"#CCFFCC\">E-Mail</td>";
	echo "    <td bgcolor=\"#CCFFCC\">Cauzione</td>";	echo "    <td bgcolor=\"#CCFFCC\">Data Iscrizione</td>";
	echo "  </tr>";
	while ($db->next_record()) {
		echo "  <tr>";
		echo "    <td>".$db->record['cognome']." ".$db->record['nome']."</td>";
		echo "    <td>".($db->record['cell']?$db->record['cell']:$db->record['tel1'])."</td>";
		echo "    <td>".$db->record['email']."</td>";
		echo "    <td>".$db->record['cauzione']."</td>";		echo "    <td>".$db->record['dataeora']."</td>";
		echo "  </tr>";
	}
	echo "</table>\n";
	$db2 = new db_local();
//	echo "<div color='white'>SELECT iscrizioni.*,nonsoci.nome,nonsoci.cognome,nonsoci.via,nonsoci.tel1,nonsoci.cell,nonsoci.citta,nonsoci.sesso,nonsoci.cap,nonsoci.prov,nonsoci.datanascita FROM iscrizioni,nonsoci,gite WHERE iscrizioni.idassociato=nonsoci.id and iscrizioni.idresp = CONCAT(nonsoci.id,'-NS') AND gite.id = iscrizioni.idgita AND gite.id = '".$id."' AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') ORDER BY nonsoci.cognome,nonsoci.nome;</div>";
	if($db2->query("SELECT iscrizioni.*,nonsoci.nome,nonsoci.cognome,nonsoci.via,nonsoci.tel1,nonsoci.cell,nonsoci.citta,nonsoci.sesso,nonsoci.cap,nonsoci.prov,nonsoci.datanascita FROM iscrizioni,nonsoci,gite WHERE iscrizioni.idassociato=nonsoci.id and iscrizioni.idresp = CONCAT(nonsoci.id,'-NS') AND gite.id = iscrizioni.idgita AND gite.id = '".$id."' AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') ORDER BY nonsoci.cognome,nonsoci.nome;"))
	{
		echo "<table border=\"1\" align=\"center\">";
		echo "  <tr>";
		echo "    <td colspan=\"11\" bgcolor=\"#CCFFCC\">Numero NON SOCI iscritti: ".$db2->num_rows()."</td>";
		echo "  </tr>";
		echo "  <tr>";
		echo "    <td bgcolor=\"#CCFFCC\">Nomi</td>";
		echo "    <td bgcolor=\"#CCFFCC\">E-Mail</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Telefono</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Cellulare</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Via</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Citt&agrave;</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Sesso</td>";
		echo "    <td bgcolor=\"#CCFFCC\">C.A.P.</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Provincia</td>";
		echo "    <td bgcolor=\"#CCFFCC\">Data di nascita</td>";
		echo "    <td bgcolor=\"#CCFFCC\">NON SOCI</td>";
		echo "  </tr>";
		while ($db2->next_record()) {
			echo "  <tr>";
			echo "    <td>".$db2->record['cognome']." ".$db2->record['nome'].".</td>";
			echo "    <td>".$db2->record['email'].".</td>";
			echo "    <td>".$db2->record['tel1'].".</td>";
			echo "    <td>".$db2->record['cell'].".</td>";
			echo "    <td>".$db2->record['via'].".</td>";
			echo "    <td>".$db2->record['citta'].".</td>";
			echo "    <td>".$db2->record['sesso'].".</td>";
			echo "    <td>".$db2->record['cap'].".</td>";
			echo "    <td>".$db2->record['prov'].".</td>";
			echo "    <td>".$db2->record['datanascita'].".</td>";
			echo "    <td>Non Socio</td>";
			echo "  </tr>";
		}
	}
	echo "</table>";
	makeTail();
?>