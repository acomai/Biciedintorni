<?php
include_once("lib/class.php");
include_once("lib/db_mysql.php");
makeHead("Invio Email Al Capogita");
if( is_numeric($_POST['toid']))
{
	$database = new db_local();
	$database->query("SELECT * FROM anagrafiche WHERE id = '".$_POST['toid']."' LIMIT 1;",true);
	if($database->next_record())
	{
		if(mail($database->record['email'], $_POST['oggetto'], $_POST['messaggio'],
     		"From: ".$_POST['nome']." <".$_POST['da'].">\r\n" .
     		"Reply-To: ".$_POST['da']."\r\n" .
     		"X-Mailer: Mailer/Bici&Dintorni"))
     		echo "<div align=\"center\">Il messaggio &egrave stato inviato correttamente.</div>";
     	else 
     		echo "<div align=\"center\">Errore nell'invio del messaggio.(Segnalare il problema al webmaster (Error: mail false)</div>";
	}
	else 
		echo "<div align=\"center\">Errore nell'invio del messaggio.(Segnalare il problema al webmaster (Error: nessun utente a cui inviare il messaggio)</div>";
	makeTail();
	exit;
}
if( is_numeric($_GET['id']))
{
	$database = new db_local();
	$database->query("SELECT * FROM anagrafiche WHERE id = '".$_GET['id']."' LIMIT 1;",true);
	if(!$database->next_record())
	{
		echo "Errore sconosciuto";
		makeTail();
		return;
	}
?>
<form action="mail.php" method="post" name="emailForm">
<table align="center">
	<tr>
		<td colspan="2">Manda una e-mail a questo contatto:<br><br></td>
	</tr>
	<tr>
		<td>Il tuo nome:</td>
		<td><input size="50" name="nome" value="<?php echo $user->nome." ".$user->cognome;?>"></td>
	</tr>
	<tr>
		<td>Inserisci il tuo indirizzo e-mail:</td>
		<td><input size="50" name="da" value="<?php echo $user->email;?>"></td>
	</tr>
	<tr>
		<td>A:</td>
		<td><?php echo $database->record['nome']." ".$database->record['cognome']; ?></td>
	</tr> 
	<tr>
		<td>Oggetto del messaggio:</td>
		<td><input size="50" name="oggetto"></td>
	</tr>
	<tr>
		<td>Inserisci il tuo messaggio:</td>
		<td><textarea cols="50" name="messaggio"></textarea></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right"><button type="submit">Invia</button><input name="toid" type="hidden" value="<?php echo $_GET['id'];?>"></td>
	</tr>
</table>
</form>
<?php
}
makeTail();
exit;
?>