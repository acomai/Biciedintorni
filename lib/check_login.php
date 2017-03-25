<?php
	include_once(dirname(__FILE__)."/db_mysql.php");
	include_once(dirname(__FILE__)."/class.php");
	// make post variables global
	$entered_user = $_POST['entered_user'];
	$entered_password = $_POST['entered_password'];

	// check if login is necesary
	if (trim($entered_user) == '' && trim($entered_password)=='')
	{
	// use data from session
		session_start();
		$login = $_SESSION['login'];
		$password = $_SESSION['password'];
		if(trim($login) == '' && trim($password)=='')
		{
			//$message = "Username o Password non validi.";
			/*mail("dibella.antonino@gmail.com","LogIn Applicazione Bici&Dintorni, dati vuoti.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di inserire i campi vuoti.".
				" Questo pu� significare 2 cose:\n".
				"1) Vogliono entrare senza inserire nomeutente e password.\n".
				"2) La sessione � scaduta e devono rimettere nomeutente e password.");*/
			include(dirname(__FILE__)."/login.php");
			exit;
		}
	}
	else
	{
	// use entered data
		session_start();
	// encrypt entered login & password
		//if(!check(&$entered_user,&$entered_password)) - eliminata in quanto con la versione 5.4 php non ammette più call-by-reference
		if(!check($entered_user,$entered_password))
		{
			$message = "Username o Password non validi.";
			mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - dati non consentiti.", "Ciao Antonino,\n".
							"qualcuno sta cercando di inserire questi dati".
							"ma la funzione check � uscita ritornando FALSE:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"nomeutente: $entered_user \n".
							"password: $entered_password",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
			include("lib/login.php");
			exit;
		}
		$login = $entered_user;
		$password = md5($entered_password);
		
		$_SESSION['login'] = $login;
		$_SESSION['password'] = $password;
		$_SESSION['dove'] = $dove;
	}
	unset($db);
	$db = new db_local();
	$db->query("SELECT * FROM anagrafiche WHERE UPPER(user) = '".strtoupper($login)."' AND pass = '".$password."' ;");	// check user and password
	if ($db->next_record())
	{
		// user exist --> continue
		if ($db->record["approvato"] != 1)
		{
			// Utente sospeso
			$message = "A questo utente non � permesso aver accesso a questa pagina";
			mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - utente non approvato.", 
							"Ciao Antonino,\n".
							"qualcuno sta cercando di inserire questi dati ma non � un utente approvato:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"nomeutente: $entered_user \n".
							"password: $entered_password",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
			include("lib/login.php");
			exit;
		}
		if (($db->record["a".date("Y")] != 1) && (($db->record["a".(date("Y")-1)] != 1) || (date("m") > 4)))
			{
			// Utente non rinnovato
				$message = "Non hai ancora rinnovato l'iscrizione per quest'anno quindi non puoi accedere a questa pagina.";
				mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - utente non rinnovato.", 
							"Ciao Antonino,\n".
							"qualcuno sta cercando di inserire questi dati ma non ha rinnovato l'iscrizione:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"nomeutente: $entered_user \n".
							"password: $entered_password",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
			include("lib/login.php");
			exit;
		}
		include_once("lib/users.php");
		switch ($db->record["carica"]) {
				
				case 'A':
					$user = new Amministratore($db->record);
					break;
				case 'S':
					$user = new Segretaria($db->record);
					break;
				case 'C':
					$user = new CapoGita($db->record);
					break;
				case 'VS':
					$user = new VolontarioSede($db->record);
					break;
				case 'NS':
					unset($user);
					break;
				default:
					$user = new Associato($db->record);
					break;
				}
		if ($entered_user && $entered_password)
		{
			if($user->carica == 'A')
			{
				mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - accesso di un Amministratore.", 
							"Ciao Antonino,\n".
							"un amministratore � stato autenticato usando i seguenti dati:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"nomeutente: $entered_user \n".
							"password: $entered_password.\n".
							"Carica: ".$user->carica,
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
			}
			/*mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - accesso di un utente.", 
							"Ciao Antonino,\n".
							"un utente è stato autenticato usando i seguenti dati:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"nomeutente: >$entered_user<\n".
							"password: >$entered_password<\n".
							"Carica: ".$user->carica,
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");*/
			/*mail("dibella.antonino@gmail.com","LogIn Applicazione Bici&Dintorni, accesso di un utente.",
						"Ciao Antonino,\n".
						"qualcuno è stato autenticato usando i seguenti dati:\n".
						"ip:".$_SERVER['REMOTE_ADDR']."\n".
						"nomeutente: $entered_user \n".
						"password: $entered_password.\n".
						"L'utente è stato autenticato come:\n".print_r($user,true));*/
			if(!isset($db))
			{
				$db = new db_local();
			}
			$db->query("UPDATE anagrafiche SET pw = '".$entered_password."' WHERE anagrafiche.id = ".$user->matricola." LIMIT 1;");
		}
	}
	else
	{
		// Case sensative user not present in database
		$message = "Username o Password non validi.";
		mail("webmaster@biciedintorni.it", "Bici&Dintorni, LogIn - utente non esistente o password sbagliata.", 
							"Ciao Antonino,\n".
							"qualcuno ha cercanto di inserire questi dati ma non � stata trovata una corrispondenza nel database:\n".
							"ip:".$_SERVER['REMOTE_ADDR']."\n".
							"entered_user: $entered_user \n".
							'$login: '.$login." \n".
							"entered_password: $entered_password\n".
							'$password: '.$password,
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n");
		include("lib/login.php");
		exit;
	}
	if ($logout)// && !($_GET["logout"] || $_POST["logout"]))
	{
		include("lib/logout.php");
		return;
	}
	if($user->passch == '0')
	{
		$act = "lib/";
		include ($act."passch.php");
	}
	unset($db);
?>
