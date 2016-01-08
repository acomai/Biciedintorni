<?php

//$fun_gite = array("iscrizioni","iscriviti","newevento","modevento","delevento","newgita","modgita","delgita","visicritti","appgita","appevento");
//$fun_amm = array("moddati","visass","bugreport","approvazione","moddatiass","newass","delass","recass","stat");


//funzioni limitate
$fun_amm = array("iscrizioni","listagite","listaeventi","iscritti","newass","modass");
//$fun_amm = array("newass");
$fun_gite = array("newgita","modgita","newevento","modevento");
$mesi = array("1"=>"Gennaio","2"=>"Febbraio","3"=>"Marzo","4"=>"Aprile","5"=>"Maggio","6"=>"Giugno","7"=>"Luglio","8"=>"Agosto","9"=>"Settembre","10"=>"Ottobre","11"=>"Novembre","12"=>"Dicembre");
$giorni = array("0"=>"Domenica","1"=>"Lunedi","2"=>"Martedi","3"=>"Mercoledi","4"=>"Giovedi","5"=>"Venerdi","6"=>"Sabato");
function vis_gita()
{
	if(is_numeric($_GET['id']))
	{
		include_once("lib/db_mysql.php");
		$db = new db_local();
		//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
		if($db->query("SELECT anagrafiche.id as 'resp',nome,cognome,tel1,email,gite.*,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite,anagrafiche WHERE gite.id = '".$_GET['id']."' AND gite.idresp = anagrafiche.id ;"))
			require_once("lib/html/visgita.php");
		else 
			echo "Errore vis_gita, query falsa.";
		$db->close();
		unset($db);
	}
	else 
		echo "Errore vis_gita, nessuna gita selezionata";
}
function vis_evento()
{
	if(is_numeric($_GET['evid']))
	{
		include_once("lib/db_mysql.php");
		$db = new db_local();
		//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
		if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE id = '".$_GET['evid']."' LIMIT 1;"))
			require_once("lib/html/visevento.php");
		else 
			echo "Errore vis_evento, query falsa.";
		$db->close();
		unset($db);
	}
	else 
		echo "Errore vis_evento, nessun evento selezionato";
}
function iscr_gita()
{
	if(is_numeric($_GET['iscr']))
	{
		//$message = "Per iscriverti ad una gita devi effettuare il login, inserisci il tuo nome utente e la tua password.";
		
		if(file_exists("db_mysql.php"))
			include_once("db_mysql.php");
		else 
			include_once("lib/db_mysql.php");
		$db = new db_local();
		$db->query("SELECT UNIX_TIMESTAMP(dataeora) as data FROM gite WHERE id = ".$_GET['iscr']." LIMIT 1");
		if($db->next_record())
		{
			/*echo "<div id=\"msg\" align=\"center\" style=\"color: #FFFFFF\">[DEBUG class.php] iscr gita -- trovata gita</div>\n";
			if (date("Y") == date("Y",$db->record['data'])) 
				echo "<div id=\"msg\" align=\"center\" style=\"color: #FFFFFF\">[DEBUG] iscr gita -- Stesso anno</div>\n";
			if (date("n") == date("n",$db->record['data']))
				echo "<div id=\"msg\" align=\"center\" style=\"color: #FFFFFF\">[DEBUG] iscr gita -- Stesso mese</div>\n";
			if ((date("j")-date("j",$db->record['data'])) <= 2)
				echo "<div id=\"msg\" align=\"center\" style=\"color: #FFFFFF\">[DEBUG] iscr gita -- Mancano meno di due giorni e precisamente".((date("j",$db->record['data']))-(date("j")))."</div>\n";*/
			if ((date("Y") == date("Y",$db->record['data'])) && (date("n") == date("n",$db->record['data'])) && ((date("j",$db->record['data']))-(date("j")) <= 1))
			{
				makeHead("Gestione Gite","<meta http-equiv=\"refresh\" content=\"5;url=index.php?id=".$_GET['iscr']."\">");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">Le iscrizioni alla gita sono terminate. Contattare il capogita.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\">Fra 5 secondi sarete rimandati alla gita.</div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
		}
		if ($_POST['nonsocio'] == 1)
		{
			//echo "nome=>".$_POST['nome']."<  cognome=>".$_POST['cognome']."<  tel=>".$_POST['tel1']."<  email=>".$_POST['nome']."<";
			if(!$_POST['nome'] || !$_POST['cognome'] || !$_POST['email'] || !$_POST['tel1'])
			{
				//header("Location: admin.php?iscr=" . $_GET['iscr']);
				makeHead("Gite");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">Attenzione devi inserire tutti i campi marcati in rosso.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='admin.php?iscr=".$_GET['iscr']."'>Ritorna all'iscrizione della gita.</a></div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			if(get_magic_quotes_gpc() == 1)
			{
				$nome = htmlentities($_POST['nome']);
				$cognome = htmlentities($_POST['cognome']);
				$via = htmlentities($_POST['via']);
				$tel1 = htmlentities($_POST['tel1']);
				$cell = htmlentities($_POST['cell']);
				$comune = htmlentities($_POST['comune']);
				$sesso = htmlentities($_POST['sesso']);
				$cap = htmlentities($_POST['cap']);
				$prov = htmlentities($_POST['prov']);
				$giorno = htmlentities($_POST['giorno']);
				$mese = htmlentities($_POST['mese']);
				$anno = htmlentities($_POST['anno']);
				$email = htmlentities($_POST['email']);
			}
			else 
				{
					$nome = addslashes(htmlentities($_POST['nome']));
					$cognome = addslashes(htmlentities($_POST['cognome']));
					$via = addslashes(htmlentities($_POST['via']));
					$tel1 = addslashes(htmlentities($_POST['tel1']));
					$cell = addslashes(htmlentities($_POST['cell']));
					$comune = addslashes(htmlentities($_POST['comune']));
					$sesso = addslashes(htmlentities($_POST['sesso']));
					$cap = addslashes(htmlentities($_POST['cap']));
					$prov = addslashes(htmlentities($_POST['prov']));
					$giorno = addslashes(htmlentities($_POST['giorno']));
					$mese = addslashes(htmlentities($_POST['mese']));
					$anno = addslashes(htmlentities($_POST['anno']));
					$email = addslashes(htmlentities($_POST['email']));
				}
			$datanascita = date("Y-m-d G:i:00",mktime(0,0,0,intval($mese),intval($giorno),intval($anno)));
			$db->query("SELECT * FROM anagrafiche WHERE LOWER(nome) LIKE '%".strtolower($nome)."%' AND LOWER(cognome) LIKE '%".strtolower($cognome)."%' LIMIT 1");
			if($db->next_record())
			{
				makeHead("Gite");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">Attenzione c'&egrave; gi&agrave; una persona iscritta con i tuoi stessi dati. Le iscrizioni alle gite per i non soci sono possibili UNA sola volta. Se &egrave; la prima volta che ti iscrivi ad una gita, ti prego di contattare il capogita.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='index.php?id=".$_GET['iscr']."'>Ritorna alla gita.</a></div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			if(!$db->query("INSERT INTO anagrafiche (nome,cognome,via,tel1,cell,citta,sesso,cap,prov,datanascita,carica) VALUES ('$nome','$cognome','$via','$tel1','$cell','$citta','$sesso','$cap','$prov','$datanascita','NS');"))
			{
				makeHead("Errore");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">ERRORE inserimento dati, ti prego di contattare il WebMaster segnalando questo errore.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='admin.php?iscr=".$_GET['iscr']."'>Ritorna all'iscrizione.</a></div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			$db->query("SELECT id FROM anagrafiche WHERE nome = '".$nome."' AND cognome = '".$cognome."' LIMIT 1");
			if(!$db->next_record())
			{
				makeHead("Errore");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">ERRORE prima dell'inserimento iscrizione, ti prego di contattare il WebMaster segnalando questo errore.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='admin.php?iscr=".$_GET['iscr']."'>Ritorna all'iscrizione.</a></div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			if(!$db->query("INSERT INTO iscrizioni (idgita,idassociato,idresp) VALUES (".$_GET['iscr'].",".$db->record['id'].",".$db->record['id'].");"))
			{
				makeHead("Errore");
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #FF0000\">ERRORE inserimento iscrizione, ti prego di contattare il WebMaster segnalando questo errore.</div>\n";
				echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='admin.php?iscr=".$_GET['iscr']."'>Ritorna all'iscrizione.</a></div>\n";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			makeHead("Complimenti");
			echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px; color: #0000FF\">COMPLIMENTI. Ti sei iscritto alla gita.</div>\n";
			echo "<br><br><div id=\"msg\" align=\"center\" style=\"font-size:16px;\"><a style='color: #0000FF;' href='index.php'>Ritorna alle gite.</a></div>\n";
			$db->close();
			unset($db);
			makeTail();
			exit;
		}
		makeHead("Iscrizione");
		$db->close();
		unset($db);
		$message = "";
		include("lib/check_login.php");
		if(!isset($user))
			return;
		$user->iscrizione($_GET['iscr']);
	}
	else 
		echo "Errore iscr_gita, nessuna gita selezionata";
}

function str2time($strStr, $strPattern = null)
{
    // an array of the valide date characters, see: http://php.net/date#AEN21898
    $arrCharacters = array(
        'd', // day
        'm', // month
        'y', // year, 2 digits
        'Y', // year, 4 digits
        'H', // hours
        'i', // minutes
        's'  // seconds
    );
    // transform the characters array to a string
    $strCharacters = implode('', $arrCharacters);

    // splits up the pattern by the date characters to get an array of the delimiters between the date characters
    $arrDelimiters = preg_split('~['.$strCharacters.']~', $strPattern);
    // transform the delimiters array to a string
    $strDelimiters = quotemeta(implode('', array_unique($arrDelimiters)));

    // splits up the date by the delimiters to get an array of the declaration
    $arrStr     = preg_split('~['.$strDelimiters.']~', $strStr);
    // splits up the pattern by the delimiters to get an array of the used characters
    $arrPattern = preg_split('~['.$strDelimiters.']~', $strPattern);

    // if the numbers of the two array are not the same, return false, because the cannot belong together
    if (count($arrStr) !== count($arrPattern)) {
        return false;
    }

    // creates a new array which has the keys from the $arrPattern array and the values from the $arrStr array
    $arrTime = array();
    for ($i = 0;$i < count($arrStr);$i++) {
        $arrTime[$arrPattern[$i]] = $arrStr[$i];
    }

    // gernerates a 4 digit year declaration of a 2 digit one by using the current year
    if (isset($arrTime['y']) && !isset($arrTime['Y'])) {
        $arrTime['Y'] = substr(date('Y'), 0, 2) . $arrTime['y'];
    }

    // if a declaration is empty, it will be filled with the current date declaration
    foreach ($arrCharacters as $strCharacter) {
        if (empty($arrTime[$strCharacter])) {
            $arrTime[$strCharacter] = date($strCharacter);
        }
    }

    // checks if the date is a valide date
    if (!checkdate($arrTime['m'], $arrTime['d'], $arrTime['Y'])) {
        return false;
    }

    // generates the timestamp
    $intTime = mktime($arrTime['H'], $arrTime['i'], $arrTime['s'], $arrTime['m'], $arrTime['d'], $arrTime['Y']);
    // returns the timestamp
    return $intTime;
}
function check($user = false, $pass = false, $mess = false)
{
	//echo "check $user<br>";
	/*mail("dibella.antonino@gmail.com","Debug, check.",
				"Ciao Antonino,\n".
				"parametri passati:\n".
				"user=$user\n".
				"pass=$pass\n".
				"mess=$mess\n".
				"------------");*/
	if (preg_match("/^[-a-z0-9_\.]{4,49}$/i", $user)) {
	// $login rispetta il parametro, per cui posso effettuare la query
		$NOP = 0; //istruzione fittizia
	}
	else {
		//$mess = "L'username deve essere di lunghezza tra i 4 e i 20 caratteri, utilizzando esclusivamente quelli tra i seguenti insiemi: a-z, A-Z oppure i singoli caratteri '-' e '_'";
		//$mess = "Username o Password non validi.";
		//echo "check $user ERR<br>";
		/*mail("dibella.antonino@gmail.com","Debug, check, user false",
				"Ciao Antonino,\n".
				"parametri passati:\n".
				"user=$user non ha passato il check");*/
		return false;
	// errore
	}
	if (preg_match("/^[-\.a-zA-Z0-9_]{8,20}$/", $pass)) {
		return true;
	// $login rispetta il parametro, per cui posso effettuare la query
	}
	else {
		/*mail("dibella.antonino@gmail.com","Debug, check, pass false.",
				"Ciao Antonino,\n".
				"parametri passati:\n".
				"pass=$pass non ha passato il check");*/
		//$mess .= "La password deve essere di almeno 8 caratteri e massimo 20, utilizzando esclusivamente caratteri alfanumerici compresi i singoli '-' e '_'";
		//$mess = "Username o Password non validi.";
		return false;
	// errore
	}
}



function makeHead( $title = "", $metatag = "", $body = "")
{
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" type="text/css" href="lib/css/stile.css">
		<script type="text/javascript" src="lib/js/ajax.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<?php echo $metatag."\n"; ?>
	</head>
<body <?php echo $body; ?>>
<?php
}

function makeTail()
{
?>
</body>
</html>
<?php
}
?>