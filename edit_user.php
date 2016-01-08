<?php
	$dove = "amm";
	include_once("lib/check_login.php");
	include_once("lib/class.php");
	if ( $_SESSION['dove'] != "amm" )
	{
		echo "<meta http-equiv=\"refresh\" content=\"0;url=sal.php\">";
		exit;
	}
		if(!function_exists("vis_campo"))
		{
		function vis_campo($campo,$db,$err)
		{
			
			if ($err)
			{
				if(($campo != "tipoUser") && ($campo != "attivo"))
				{
					echo $_POST[$campo];
					return;
				}
				return $_POST[$campo];
			}
			if(($_GET['id'] != "new") && (is_numeric($_GET['id'])))
			{
				if(($campo == "tipoUser") || ($campo == "attivo")) 
					return $db->record["$campo"];
				echo $db->record[$campo];
			}
			else
				if(!$_GET['id'])
					return $_POST[$campo];
				else
					return "1";
		}
		}

if(!$err)
		{
			echo "<html>\n\t<head>\n\t\t<title>Gestione utenti</title>\n";
			echo "\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"lib/stile.css\">\n";
			echo "\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-15\">\n";
			echo "\t<style type=\"text/css\"> body {background: #f5941d} </style>\n";
			echo "\t</head>\n";
			echo "\t<body ";
		}	
	if(!$_GET['id'])
	{
		if(($err != 0) && ($err  != 7)) 
			echo ">";
		//echo "<pre>".print_r($_POST)."</pre>";
			
		if(!$_POST['cognome'])
		{
			echo "\n\t<center>Campo obbligatorio mancante. [Cognome]<br>Inserire nuovamente la password</center>";
			$err = 1;
			//return;
		}
		else
			if(!$_POST['nome'])
			{
				echo "\n\t<center>Campo obbligatorio mancante. [Nome]<br>Inserire nuovamente la password</center>";
				$err = 2;
			}
			else
				if(!$_POST['tipoUser'])
				{
					echo "\n\t<center>Campo obbligatorio mancante. [Tipo utente]<br>Inserire nuovamente la password</center>";
					$err = 3;
				}
				else
					if(!$_POST['attivo'])
					{
						echo "\n\t<center>Campo obbligatorio mancante. [Stato]<br>Inserire nuovamente la password</center>";
						$err = 4;
					}
					else
						if(!$_POST['user'])
						{
							echo "\n\t<center>Campo obbligatorio mancante. [Username]<br>Inserire nuovamente la password</center>";
							$err = 5;
						}
						else
							if(!$_POST['pass'])
								if(!isset($_GET['mod']))
								{
									echo "\n\t<center>Campo obbligatorio mancante. [Password]";
									$err = 6;
								}
								/*if(!$_GET['id'])
									echo "NO ID";
								if(!$err)
								echo "NO ERR";
								*/
		if(!$err)
		{
			if(!$_GET['mod'])
				$db->query("SELECT * FROM user WHERE user = '".mysql_escape_string($_POST['user'])."';");
			else
				if(is_numeric($_GET['mod']))
					$db->query("SELECT * FROM user WHERE user = '".mysql_escape_string($_POST['user'])."' AND id_user != '".$_GET['mod']."';");
			//echo "result query:".$db->query_id."<<br>";
			if($db->next_record())
			{
				$err = 7;
				echo ">\n\t<center>Username gia presente tra gli utenti.</center>\n<br>\n";
				if(!isset($_GET['mod']))
					unset($_GET['id']);
				unset($_POST['user']);
				unset($db);
				include("edit_user.php");
				exit;
			}//if($db->next_record())
			if(!isset($_GET['mod']))
				$Query = "INSERT INTO user (cognome,nome,cf,ragSoc,pIva,tipoUser,attivo,user,pass)VALUES ('".mysql_escape_string($_POST['cognome'])."','".mysql_escape_string($_POST['nome'])."','".mysql_escape_string($_POST['cf'])."','".mysql_escape_string($_POST['ragSoc'])."','".mysql_escape_string($_POST['pIva'])."','".mysql_escape_string($_POST['tipoUser'])."','".mysql_escape_string($_POST['attivo'])."','".mysql_escape_string($_POST['user'])."','".md5(mysql_escape_string($_POST['pass']))."');";
			else
				if(is_numeric($_GET['mod']))
					if(!isset($_POST['pass']))
						$Query = "UPDATE user SET cognome = '".mysql_escape_string($_POST['cognome'])."',nome = '".mysql_escape_string($_POST['nome'])."',cf = '".mysql_escape_string($_POST['cf'])."',ragSoc = '".mysql_escape_string($_POST['ragSoc'])."',pIva = '".mysql_escape_string($_POST['pIva'])."',tipoUser = '".mysql_escape_string($_POST['tipoUser'])."',attivo = '".mysql_escape_string($_POST['attivo'])."',user = '".mysql_escape_string($_POST['user'])."' WHERE id_user = '".(int)$_GET['mod']."';";
					else
						$Query = "UPDATE user SET cognome = '".mysql_escape_string($_POST['cognome'])."',nome = '".mysql_escape_string($_POST['nome'])."',cf = '".mysql_escape_string($_POST['cf'])."',ragSoc = '".mysql_escape_string($_POST['ragSoc'])."',pIva = '".mysql_escape_string($_POST['pIva'])."',tipoUser = '".mysql_escape_string($_POST['tipoUser'])."',attivo = '".mysql_escape_string($_POST['attivo'])."',user = '".mysql_escape_string($_POST['user'])."',pass = '".md5(mysql_escape_string($_POST['pass']))."' WHERE id_user = '".(int)$_GET['mod']."';";
			//echo ">\n\tQuery di inserimento impostata\n<br>\n >".$Query."<";
			$db->query($Query);
			//echo ">\n\tQuery di inserimento effettuata\n<br>\n";
			if($db->errno == 0)
			{
				$err = 0;
				//echo ">\n\tUsername inserito>".mysql_escape_string($_POST['user'])."<<br>";
				//$Query = "SELECT * FROM user WHERE user = '".mysql_escape_string($_POST['user'])."'";
				//$db->query($Query);
				$db->query("SELECT * FROM user WHERE user = '".mysql_escape_string($_POST['user'])."'");
				//echo ">\n\tQuery di controllo effettuata\n<br>\n";
				if($db->next_record())				
				{
					//echo "<html>\n\t<head>\n\t\t<title>Gestione utenti</title>\n";
					//echo "\t\t<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-15\">\n";
					//echo "\t</head>\n";
					//echo "\t<body bgcolor=\"#0066CC\" ";
					echo "onload=\"javascript:window.opener.location.href='redazione.php';void(0)\">\n";
					echo "<table>\n\t<tr>\n\t\t<td colspan=\"2\">\n";
					if(!$_GET['mod'])
						echo "Inserimento utente avvenuto con successo;<br>I dati utente inseriti sono:<br>";
					else
						echo "Aggiornamento utente avvenuto con successo;<br>I dati utente inseriti sono:<br>";
					
					if($db->record["tipoUser"] == 'A')
	  					$tipoUser = "Amministratore";
	  				else
	  					if($db->record["tipoUser"] == 'C')
	  						$tipoUser = "Cliente";
	  				else
	  					if($db->record["tipoUser"] == 'F')
	  						$tipoUser = "Fornitore";
	  						
					echo "\n\t\t</td>\n\t</tr>";
					echo "\n\t<tr>\n\t\t<td>Cognome :".$db->record['cognome']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Nome :</td><td>".$db->record['nome']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Codice fiscale :</td><td>".$db->record['cf']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Ragione Sociale :</td><td>".$db->record['ragSoc']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Partita iva :</td><td>".$db->record['pIva']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Tipo utente :</td><td>".$tipoUser."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Stato :</td><td>".$db->record['attivo']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Username :</td><td>".$db->record['user']."</td></tr>";
					echo "\n\t<tr>\n\t\t<td>Password :</td><td>***nascosta***</td></tr>\n</table>";

					//echo $db->query_id;
					//$err = -1;
				
					echo "\n\t</body>\n</html>";
					exit;
					//return;
			 	}//if($db->next_record())
			}//if($db->errno == 0)
		}//if(!$err)
	}//if(!$_GET['id'])
	else
		if($_GET['id'] == "new")
			echo ">\n\t";
		else
			if(is_numeric($_GET['id']))
			{
				if(is_numeric($_GET['sosp']))
				{
					$db->query("SELECT attivo FROM user WHERE id_user = '".$_GET['id']."'");
					if($db->next_record())
						if ($_GET['sosp'] == 1)
						{
							if($db->record['attivo'] == 1)
								$attivo = -1;
							else
								$attivo = 1;
						}
						else
							if ($_GET['sosp'] == 2)
								$attivo = 2;
					$Query = "UPDATE user SET attivo = '".$attivo."' WHERE id_user = '".mysql_escape_string($_GET['id'])."'";
					$db->query($Query);
					echo "onload=\"javascript:\">\n";
					//echo ">".$Query."<";
					echo "\t</body>\n</html>";
					echo "<script language=\"Javascript\">\nwindow.opener.location.href='redazione.php';\nwindow.close();</script>\n";
					exit;
				}
				echo ">\n\t";
				//echo "CERCO UTENTE SELECT * FROM user WHERE id_user = '".$_GET['id']."'";
				//$db = new db_local();
				$db->query("SELECT * FROM user WHERE id_user = '".$_GET['id']."'");
				$db->next_record();
				//echo "<pre>".print_r($db->record[$campo])."</pre>";
			}
	//if ($err > 0)
		//echo "<br>";
	//makeInt();
	//makeMenu();
?>
	<form id="searchform" name="dati_utente<?php echo $_GET['id'];?>" action="edit_user.php<?php 
		if(is_numeric($_GET['id']))
			echo '?mod='.$_GET['id'];		
		?>" method="post">
		<table align="center" cellpadding="2" cellspacing="2">
			<tr>
				<td class=".suit_int" align="center" colspan="2">Dati anagrafici utente</td>
			</tr>
			<tr>
				<td class="intestazione"><label>Cognome :</label></td>
				<td align="center" class="intestazione"><input type="text" name="cognome" value="<?php vis_campo("cognome",$db,$err);?>" size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Nome :</label></td>
				<td align="center" class="intestazione"><input type="text" name="nome" value="<?php vis_campo("nome",$db,$err);?>" size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Codice fiscale :</label></td>
				<td align="center" class="intestazione"><input type="text" name="cf" value="<?php vis_campo("cf",$db,$err);?>" size="40" maxlength="16"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Ragione sociale :</label></td>
				<td align="center" class="intestazione"><input type="text" name="ragSoc" value="<?php vis_campo("ragSoc",$db,$err);?>" size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Partita Iva :</label></td>
				<td align="center" class="intestazione"><input type="text" name="pIva" value="<?php vis_campo("pIva",$db,$err);?>"  size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Tipo utente :</label></td>
				<td align="center" class="intestazione">
					<select name="tipoUser" size="1">
						<option value="C" label="tipoUser" <?php if(vis_campo("tipoUser",$db,$err) == "C") echo "selected=\"selected\"";?>>1 - Cliente</option>
						<option value="F" label="tipoUser" <?php if(vis_campo("tipoUser",$db,$err) == "F") echo "selected=\"selected\"";?>>2 - Fornitore</option>
						<option value="A" label="tipoUser" <?php if(vis_campo("tipoUser",$db,$err) == "A") echo "selected=\"selected\"";?>>3 - Amministratore</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="intestazione"><label>Stato :</label></td>
				<td align="center" class="intestazione">
					Attivo<input type="radio" name="attivo" value="1" <?php if(vis_campo("attivo",$db,$err) == "1") echo "checked=\"checked\"";?>>
					Sospeso<input type="radio" name="attivo" value="-1" <?php if(vis_campo("attivo",$db,$err) == "-1") echo "checked=\"checked\"";?>>
				</td>
			</tr>
			<tr>
				<td class="intestazione"><label>Username :</label></td>
				<td align="center" class="intestazione"><input type="text" name="user" value="<?php vis_campo("user",$db,$err);?>" size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td class="intestazione"><label>Password :</label></td>
				<td align="center" class="intestazione"><input type="password" name="pass" size="40" maxlength="255"></td>
			</tr>
			<tr>
				<td align="left" class="intestazioneb"><?php
											if(is_numeric($_GET['id'])) 
												echo "<input class=\"btn\" type=\"reset\" value=\"Annulla\" onclick=\"javascript:window.close();\">";
											else
												echo "<input class=\"btn\" type=\"reset\" value=\"Cancella\">";
										?></td>
				<td align="right" class="intestazioneb"><input class="btn" type="submit" value="Invia i dati"></td>
			</tr>
		</table>
	</form>
  </body>
</html>
<?php //makeTail(); ?>