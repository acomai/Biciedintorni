<?php
	$logout = true;
	include("lib/check_login.php");
	include_once("lib/class.php");
	if(is_numeric($_GET['s']))
		$s = $_GET['s'];
	else
		$s = '8';
	makeHead("Gestione Stato Avanzamento Lavori, LogOut","<meta http-equiv=\"refresh\" content=\"$s;url=".$dove."\">");
?>
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
  <tr>
  	<td align="center">
	  <table border="1" cellpadding="5" cellspacing="0">
		<tr>
		  <td class="intestazionel" align="center">
		  <h3>Uscita effettuata correttamente. Arrivederci e grazie</h3>
		  Se non sei reindirizzato automaticamente alla pagina iniziale entro <?php echo $s; ?> secondi <a href="admin.php">Clicca Qui</a>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<?php makeTail(); ?>