<?php
	//echo "<br> act = $act <br>";
	session_start();
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
	if($login == "")
	{
		echo "Devi effettuare il login prima.";
		echo "<br><center>[<a href='http://www.biciedintorni.it/application/admin.php'>Login</a>]</center>";
		exit;
	}
	include_once ("class.php");
	include_once ("db_mysql.php");
	$db = new db_local();
	$db->query("SELECT user,email FROM anagrafiche WHERE user = '$login';");
	if($db->next_record())
	{
		//echo "--------------".$db->record['email']."<br>";
		if($_POST["password"] != "")
		{
			if($_POST["password"] == $_POST["password2"])
			{
				if(check($login,$_POST["password"]))
				{
					if($_POST["email"] != "")
							$strqry = "UPDATE anagrafiche SET passch = passch + 1, pw = '".$_POST["password"]."', pass = MD5('".$_POST["password"]."'),email = '". trim($_POST["email"])."' WHERE user = '$login' LIMIT 1;";
					else
							$strqry = "UPDATE anagrafiche SET passch = passch + 1, pw = '".$_POST["password"]."', pass = MD5('".$_POST["password"]."') WHERE user = '$login' LIMIT 1;";
					if($db->query($strqry))
						{
							$_SESSION['password'] = md5($_POST["password"]);
							if($_GET['iscr'])
								$variabile = "?iscr=".$_GET['iscr'];
							$script = ''.
												"<script type=\"text/javascript\">\n".
												"			function ok()\n".
												"			{\n".
												"				alert('Password modificata.');\n".
												"				location.replace('http://www.biciedintorni.it/application/admin.php".$variabile."');\n".
												"			}\n".
												"		</script>";
							makeHead("Cambio password",$script,"onload=\"ok()\"");
							/*echo "START QUERY";
							if(!$db->query("UPDATE anagrafiche SET pw = '".$_POST["password"]."' WHERE user = '".$login."' LIMIT 1;",true))
								echo "ERRORE PW";*/
							if($_POST["email"] != '')
								mail($_POST["email"],"FIAB Torino Bici e Dintorni - Cambio Password.",
										"Ciao ".$login.",\n".
										"\n".
										"hai modificato la tua password, questi sono i tuoi nuovi dati:\n".
										"nomeutente: ".$login." \n".
										"password: ".$_POST["password"]);
							makeTail();
							exit;
						}
				}
				else
				{
					echo "<html><head><title>Cambio password</title></head><body>";
					echo "La password pu� contenere solo numeri e lettere e deve essere di minimo 8 caratteri.";
				}
			}
			else
			{
				echo "<html><head><title>Cambio password</title></head><body>";
				echo "<center>Le password non coincidono.</center>";
			}
	  }
	}
	if($_GET['iscr'])
		$act .= "passch.php?iscr=".$_GET['iscr'];
	else
		$act .= "passch.php";
	makeHead("Cambio password");
?>
<h2><center>FIAB Torino Bici e Dintorni - area riservata - modifica password</center></h2>

<form method="post" action="<?php echo $act; ?>">
	<table align="center" border="0">
	  
	  <tr>
		<td >Nuova Password [Obbligatorio]:</td>
		<td><input type="password" size="20" name="password" maxlength="20"></td>
	  </tr>
	  <tr>
		<td>Ripeti Nuova Password [Obbligatorio]:</td>
		<td><input type="password" size="20" name="password2" maxlength="20"></td>
	  </tr>
	  <tr>
		<td>Email [Opzionale, se la inserisci ti verrà spedita la nuova password]:</td>
		<td><input size="50" name="email" maxlength="100" value="<?php echo $db->record['email']; ?>"></td>
	  </tr>
	  <tr>
		<td align="center" colspan="2">
		<input type="submit" value="Cambia"> 
		<input type="reset" value="Annulla">
		</td>
	  </tr>
	</table>
</form>
<?php
makeTail();
$db->close();
 exit; ?>