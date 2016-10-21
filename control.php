<?php

include_once("lib/db_mysql.php");
$db = new db_local();
$query = "SELECT email,nome,cognome,gite.id,titolo,idresp,gite.idcreat,UNIX_TIMESTAMP(gite.dataeora) as datagita FROM anagrafiche,gite WHERE anagrafiche.id = gite.idresp AND DATE_FORMAT(gite.dataeora,'%Y') = '".date("Y")."' AND DATE_FORMAT(gite.dataeora,'%c') = '".date("n")."' AND promemoria = 0 and (DATE_FORMAT(gite.dataeora,'%e') - ".date("j").") = 1";

  /*if(mail("webmaster@biciedintorni.it", "Bici&Dintorni, WebCron.", "Ciao Antonino,\n".
			"è stato richiamato il file control.php.\n",
			"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
     		"Reply-To: webmaster@biciedintorni.it\r\n".
     		"X-Mailer: Mailer/Bici&Dintorni"))
		echo "<div id=\"msg\" align=\"center\" style=\"color: #0000FF\">[control.php] -- Email di controllo inviata correttamente.</div>\n";
	else 
		echo "<div id=\"msg\" align=\"center\" style=\"color: #FF0000\">[control.php] -- Email di controllo non inviata.</div>\n";
*/
$db->query($query);
$db2 = new db_local();
while($db->next_record())
{
	$testo = "Ciao ".$db->record['nome'].",\n\nIscritti online alla gita '".$db->record['titolo']."'\n";
	$query2 = "SELECT nome,cognome,cell,email,cauzione,carica,idassociato,iscrizioni.idresp FROM anagrafiche,iscrizioni WHERE anagrafiche.id = idassociato AND idgita = ".$db->record['id']." and iscrizioni.idresp <> concat(iscrizioni.idassociato,'-NS') ORDER BY cognome,nome";
	$db2->query($query2);
	$testo .= "Associati iscritti: ".$db2->num_rows()."\n\n"; 
	while($db2->next_record())
	{
		$testo .= $db2->record['cognome']." ".$db2->record['nome']." _ Cell: ".$db2->record['cell']." _ Email: ".$db2->record['email'];
		if(($db2->record['cauzione'] != 'SI') && ($db2->record['carica'] == 'AS'))
			$testo .= " ---> SENZA CAUZIONE\n";
		else
			$testo .= "\n";
		 
	}
	$query2 = "SELECT nome,cognome,via,cap,citta,prov,datanascita,tel1,tel2,cell,email FROM nonsoci,iscrizioni WHERE nonsoci.id = idassociato AND idgita = ".$db->record['id']." and iscrizioni.idresp = concat(iscrizioni.idassociato,'-NS') ORDER BY cognome,nome";
	$db2->query($query2);
	$testo .= "\n\nNon associati iscritti: ".$db2->num_rows()."\n\n"; 
	while($db2->next_record())
	{
		$testo .= $db2->record['cognome']." ".$db2->record['nome']." Via:".$db2->record['via']."; CAP:".$db2->record['cap']."; Città:".$db2->record['citta']."; ";
		$testo .= "Provincia:".$db2->record['prov']."; Data di nascita:".$db2->record['datanascita']."; Tel1:".$db2->record['tel1']."; Tel2:".$db2->record['tel2']."; Cell:".$db2->record['cell']."; E-Mail: ".$db2->record['email'];
		$testo .= "\n\n";
		 
	}
	if($db->record['email'] != "")
	{
		if(mail($db->record['email'], "Bici&Dintorni, Fine iscrizioni gite.",$testo,
				"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
	     		"Reply-To: webmaster@biciedintorni.it\r\n".
	     		"X-Mailer: Mailer/Bici&Dintorni"))
		{
			echo "<div id=\"msg\" align=\"center\" style=\"color: #0000FF\">[control.php] -- email inviata correttamente al capogita ".$db->record['cognome']."</div>\n";
			$testemail = "[control.php] -- Email inviata correttamente al capogita ".$db->record['cognome']." ".$db->record['nome']." ".$db->record['email']."\n";
		}
		else 
		{
			echo "<div id=\"msg\" align=\"center\" style=\"color: #FF0000\">[control.php] -- email non inviata a ".$db->record['cognome'].".</div>\n";
			$testemail = "[control.php] -- Email NON inviata correttamente al capogita ".$db->record['cognome']." ".$db->record['nome']." ".$db->record['email']."\n";
		}
		if(mail("webmaster@biciedintorni.it", "Bici&Dintorni, WebCron.", "Ciao Antonino,\n".
				"ecco la query di selezione gite:\n".$query."\n-----\n".
				"ecco quella di selezione iscritti:\n".$query2."\n-----\n".
				$testemail."\n".
				$testo,
				"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
	     		"Reply-To: webmaster@biciedintorni.it\r\n".
	     		"X-Mailer: Mailer/Bici&Dintorni"))
			echo "<div id=\"msg\" align=\"center\" style=\"color: #0000FF\">[control.php] -- email inviata correttamente.</div>\n";
		else 
			echo "<div id=\"msg\" align=\"center\" style=\"color: #FF0000\">[control.php] -- email non inviata.</div>\n";
	}
	else
	{
		if(mail("webmaster@biciedintorni.it", "Bici&Dintorni, WebCron.", "Ciao Antonino,\n".
				$db->record['cognome']." ".$db->record['nome']." non ha un'email assegnata quindi non ho potuto recapitare la lista degli iscritti alla sua gita: ".$db->record['titolo']."\n",
				"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
	     		"Reply-To: webmaster@biciedintorni.it\r\n".
	     		"X-Mailer: Mailer/Bici&Dintorni"))
			echo "<div id=\"msg\" align=\"center\" style=\"color: #0000FF\">[control.php] -- email di non recapito inviata correttamente.</div>\n";
		else 
			echo "<div id=\"msg\" align=\"center\" style=\"color: #FF0000\">[control.php] -- email di non recapito non inviata.</div>\n";
	}
	$db2->query("UPDATE gite set promemoria = 1 where id = ".$db->record['id']);
}

//INVIO EMAIL
$db = new db_local();
$query = "SELECT * from email where inviata = 0 and '".date('Y-m-d H:i')."' > date_format(concat(anno,'-',mese,'-',giorno,' ',ora,':',minuti),'%Y-%m-%d %H:%i')";
$db->query($query);
$numinviate = 0;
$numemail = 0;
while($db->next_record())
{
	$numemail++;
	// costruiamo alcune intestazioni generali
	$header = "From: Bici&Dintorni <info@biciedintorni.it>\n";
	$header .= "X-Mailer: www.biciedintorni.it\n";

	// generiamo la stringa che funge da separatore
	$boundary = "==String_Boundary_x" .md5(time()). "x";

	// costruiamo le intestazioni che specificano
	// un messaggio costituito da più parti alternative
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/alternative;\n";
	$header .= " boundary=\"$boundary\";\n\n";

	// questa parte del messaggio viene visualizzata
	// solo se il programma non sa interpretare
	// i MIME poiché è posta prima della stringa boundary
	$messaggio = "Se visualizzi questo testo il tuo programma non supporta i MIME e specificatamente le e-mail in formato html\n\n";

	// inizia la prima parte del messaggio in testo puro
	$messaggio .= "--$boundary\n";
	$messaggio .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
	$messaggio .= "Content-Transfer-Encoding: 7bit\n\n";
	$messaggio .= "Il tuo programma di posta non riesce a leggere questa e-mail in quanto la mail è in formato html, contatta gite@biciedintorni.it specificando questo messaggio.\n\n";

	// inizia la seconda parte del messaggio in formato html
	$messaggio .= "--$boundary\n";
	$messaggio .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
	$messaggio .= "Content-Transfer-Encoding: 7bit\n\n";
	$messaggio .= "<html><body>".$db->record['corpo']."</body></html>\n";

	// chiusura del messaggio con la stringa boundary
	$messaggio .= "--$boundary--\n";

	$subject = $db->record['oggetto'];
	$db2 = new db_local();
	$db2->query("SELECT email,nome,cognome,lnk_gruppi_soci.id as idlink from anagrafiche inner join lnk_gruppi_soci on anagrafiche.id = lnk_gruppi_soci.idsocio where (trim(email) <> '' and email is not null) and idgruppo = ".$db->record['idgruppo']."");
	while($db2->next_record())
	{
		if( mail($db2->record['email'], $subject, $messaggio, $header) ) 
		{
			$db3 = new db_local();
			$db3->query("UPDATE lnk_gruppi_soci SET inviata = 1 WHERE id = ".$db2->record['idlink']."");
			$numinviate++;
		}
		else
		{
			$emailinerrore .= $db2->record['email']." ".$db2->record['cognome'].", ".$db2->record['nome']."\n";
		}
	}
	$db2->query("UPDATE email SET inviata = 1 WHERE id = ".$db->record['id']."");
	mail("webmaster@biciedintorni.it", $subject, $messaggio, $header);
	//mail("webmaster@biciedintorni.it", "Email inviata", "L'email con id=".$db->record['id'].", E' stata inviata. Non è stato possibile inviare l'email ai seguenti destinatari:\n-----\n".$emailinerrore."\n-----");
	mail("webmaster@biciedintorni.it", "Bici&Dintorni, Email Collettive", "L'email con id=".$db->record['id'].", E' stata inviata. Non è stato possibile inviare l'email ai seguenti destinatari:\n-----\n".$emailinerrore."\n-----",
			"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
     		"X-Mailer: www.biciedintorni.it");
	mail("dibella.antonino@gmail.com", $subject, $messaggio, $header);
	//mail("webmaster@biciedintorni.it", "Email inviata", "L'email con id=".$db->record['id'].", E' stata inviata. Non è stato possibile inviare l'email ai seguenti destinatari:\n-----\n".$emailinerrore."\n-----");
	mail("dibella.antonino@gmail.com", "Bici&Dintorni, Email Collettive", "L'email con id=".$db->record['id'].", E' stata inviata. Non è stato possibile inviare l'email ai seguenti destinatari:\n-----\n".$emailinerrore."\n-----",
			"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n".
     		"X-Mailer: www.biciedintorni.it");
}
echo "<div id=\"msgcolletive\" align=\"center\" style=\"color: #0000FF\">[control.php] -- $numemail email collettive elaborate con successo per un totale di $numinviate email inviate.</div>\n";
?>
