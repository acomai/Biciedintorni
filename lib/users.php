

<?php 
include_once("lib/db_mysql.php");
include_once("lib/class.php");

class Associato {
	var $matricola,$nome,$cognome,$user,$pass,$pw,$via,$datanascita;
	var $dataiscrizione,$tel1,$tel2,$email,$carica,$saldo,$approvato,$menu;
	var $mesi = array("1"=>"Gennaio","2"=>"Febbraio","3"=>"Marzo","4"=>"Aprile","5"=>"Maggio","6"=>"Giugno","7"=>"Luglio","8"=>"Agosto","9"=>"Settembre","10"=>"Ottobre","11"=>"Novembre","12"=>"Dicembre");
	var $giorni = array("0"=>"Domenica","1"=>"Lunedi","2"=>"Martedi","3"=>"Mercoledi","4"=>"Giovedi","5"=>"Venerdi","6"=>"Sabato");

	function Associato($record = null)
	{
		if(is_array($record))
		{
			$this->matricola = $record['id'];
			$this->nome = $record['nome'];
			$this->cognome = $record['cognome'];
			$this->user = $record['user'];
			$this->pass = $record['pass'];
			$this->pw = $record['pw'];
			$this->passch = $record['passch'];
			$this->via = $record['via'];
			$this->citta = $record['citta'];
			$this->cap = $record['cap'];
			$this->prov = $record['prov'];
			$this->datanascita = $record['datanascita'];
			$this->cell = $record['cell'];
			$this->tel1 = $record['tel1'];
			$this->tel2 = $record['tel2'];
			$this->email = $record['email'];
			$this->carica = $record['carica'];
			$this->saldo = $record['saldo'];
			$this->approvato = $record['approvato'];
			$this->dataiscrizione = $record['dataiscrizione'];
			$this->a2007 = $record['a2007'];
			$this->a2008 = $record['a2008'];
			$this->a2009 = $record['a2009'];
			$this->a2010 = $record['a2010'];
			$this->a2011 = $record['a2011'];
			$this->a2012 = $record['a2012'];
			$this->a2013 = $record['a2013'];
			$this->a2014 = $record['a2014'];
			$this->a2015 = $record['a2015'];
			$this->a2016 = $record['a2016'];
			$this->a2017 = $record['a2017'];
			$this->a2018 = $record['a2018'];
			$this->a2019 = $record['a2019'];
			$this->a2020 = $record['a2020'];

			$this->menu = array("Le tue iscrizioni"=>"iscrizioni","Modifica dati personali"=>"moddati",
					"Visualizza associati"=>"visass","Segnala un errore nel sito"=>"bugreport",
					"Visualizza gli eventi"=>"listaeventi","Consulta il tuo profilo"=>"consulta_profilo",
					"Consulta la biblioteca"=>"consulta_biblio","Modulistica interna associazione"=>"modulistica_interna");
			return true;
		}
		else
		return false;
	}
	
	function consulta_biblio() {
		include ("biblioteca.php");
	}
	
	function consulta_profilo()
	{
		$user = $_SESSION['login'];
		echo "<div align='center'><strong>FIAB Torino Bici e Dintorni - Consultazione profilo</strong></div>";
		echo "<br>";
		echo "<div align='center'>Verifica i tuoi dati. Se è necessaria qualche modifica, 
				segnala il cambiamento desiderato con una mail a 
				<a href='mailto:info@biciedintorni.it'>info@biciedintorni.it</a></div>";
		echo "<br>";
		$db = new db_local();
		$db->query("SELECT * FROM anagrafiche WHERE user = '$user' ;");
		if($db->next_record())
		{
			echo "<div><table align='center' style='text-align: left;' border='0' cellpadding='2' cellspacing='2'>";
			echo "<tbody>";
			echo "<tr><td>username</td><td><strong>".  $this->user . "</strong></td></tr>";
			echo "<tr><td>nome</td><td>" . $this->nome . "</td></tr>";			
			echo "<tr><td>cognome</td><td>" . $this->cognome . "</td></tr>";
			echo "<tr><td>data di nascita</td><td>" . $this->datanascita . "</td></tr>";
			echo "<tr><td>indirizzo</td><td>" . $this->via . "</td></tr>";
			echo "<tr><td>cap</td><td>" . $this->cap . "</td></tr>";
			echo "<tr><td>comune</td><td>" . $this->citta . "</td></tr>";
			echo "<tr><td>provincia</td><td>" . $this->prov . "</td></tr>";
			echo "<tr><td>cellulare</td><td>" . $this->cell . "</td></tr>";
			echo "<tr><td>altro tel (1)</td><td>" . $this->tel1 . "</td></tr>";
			echo "<tr><td>altro tel (2)</td><td>" . $this->tel2 . "</td></tr>";
			echo "<tr><td>email</td><td>" . $this->email . "</td></tr>";
			
			switch ($this->carica) {
				case 'A': $carica = "Amministrazione";
				break;
				case 'S': $carica = "Segreteria";
				break;
				case 'C': $carica = "Capogita";
				break;
				case 'VS': $carica = "Volontario Sede";
				break;
				case 'VG': $carica = "Volontario Giornalino";
				break;
				case 'VG': $carica = "Volontario Altro";
				break;
				case 'AS': $carica = "Socio";
				break;
				default: $carica = "Non specificata";
				break;
			}
			echo "<tr><td>ruolo</td><td>" . $carica . "</td></tr>";

			$a2013 = $this->a2013;
			echo "<tr><td>Anni di iscrizione</td><td>";
			if ($this->a2007 == "1") {
				echo "2007 " ;
			}
			if ($this->a2008 == "1") {
				echo "2008 ";
			}
			if ($this->a2009 == 1) echo "2009 ";
			if ($this->a2010 == 1) echo "2010 ";
			if ($this->a2011 == 1) echo "2011 ";
			if ($this->a2012 == 1) echo "2012 ";
			if ($a2013 == "1") echo "2013 ";
			if ($this->a2014 == 1) echo "2014 ";
			if ($this->a2015 == "1") echo "2015 ";
			if ($this->a2016 == 1) echo "2016 ";
			if ($this->a2017 == 1) echo "2017 ";
			if ($this->a2018 == 1) echo "2018 ";
			if ($this->a2019 == 1) echo "2019 ";
			if ($this->a2020 == 1) echo "2020 ";
			
			echo "</td></tr></tbody></table></div>"; 
			echo "<br><br>";

		}
	}
	
	function esegui_query($query)
	{
		$db = new db_local();
		$db->query($query,true);
		$db->close();
		unset($db);
	}

	function get_area()
	{
		$carica = array("A"=>"Amministratori","C"=>"Capi Gita","S"=>"Segreteria","VS"=>"Volontari Sede","VG"=>"Volontari Giornalino","VA"=>"Volontari","AS"=>"Associati");
		return "Area ".$carica[$this->carica];
	}

	function iscrivi($idgita,$idassociato = 'm')
	{
		if($idassociato == 'm')
		$idassociato = $this->matricola;
		if(is_numeric($idgita))
		{
			$db = new db_local();
			$db->query("SELECT * from iscrizioni WHERE idgita = '".$idgita."' AND idassociato = '".$idassociato."';");
			if($db->next_record())
			{
				if($idassociato != $this->matricola)
				echo "Questa persona &egrave; gia iscritta a questa gita.";
				else
				echo "Sei gia iscritto a questa gita.";
			}
			else
			if($db->query("INSERT INTO iscrizioni (idgita,idassociato,idresp) VALUES ($idgita,$idassociato,'$this->matricola');"))
			{
				if($idassociato != $this->matricola)
				echo "Complimenti. Hai iscritto la persona a questa gita.\n";
				else
				echo "Complimenti. Ti sei iscritto a questa gita.\n";
				$db->query("SELECT * from anagrafiche WHERE id = '".$idassociato."' AND carica = 'AS' AND cauzione <> 'SI';");
				if($db->next_record())
				{
					if($idassociato != $this->matricola)
					echo "ATTENZIONE\nQuesta persona non ha versato la cauzione e quindi deve confermare l'iscrizione presso la sede.";
					else
					echo "ATTENZIONE\nNon hai versato la cauzione quindi dovrai confermare questa iscrizione in sede.";
				}
			}
			else
			echo "C'&egrave; stato un'errore imprevisto nell'iscrizione, contatta il Webmaster dalla sezione contattaci del sito.";
			$db->close();
			unset($db);
			return;
		}
	}

	function iscrizione($idgita)
	{
		$db = new db_local();
		$db->query("SELECT * from iscrizioni WHERE idgita = '".$idgita."' and idassociato = '".$this->matricola."';");
		//makeHead("Iscrizione","<meta http-equiv=\"refresh\" content=\"5;url=admin.php\">");
		if($db->next_record())
		{
			echo "<br><br><div id=\"msg\" align=\"center\" style=\"color: #FF0000\">Sei gia iscritto a questa gita.</div>";
		}
		$db->query("SELECT * from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) and id = '".$this->matricola."';");
		if(!$db->next_record())
		{
			echo "<br><br><div id=\"msg\" align=\"center\" style=\"color: #FF0000\">Non puoi iscriverti come socio,
				forse non hai ancora rinnovato per quest'anno. Fai Logout e iscriviti come non socio. 
				In caso di problemi scrivi a info@biciedintorni.it.</div>";
		} else {
				echo "<div id=\"msg\" align=\"center\">Chi vuoi iscrivere a questa gita?</div>";
				echo "<br><br><div id=\"msg\" align=\"center\">\n";
				//$db->query("SELECT * from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY cognome,nome;");
				$db->query("SELECT * from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1) ORDER BY cognome,nome;");
				echo "\t<select size=\"1\" name=\"associato\" id=\"associato\">\n";
				while($db->next_record())
				{
					if(intval($db->record['id']) == intval($this->matricola))
					$s = "selected ";
					echo "\t\t\t<option ".$s."value=\"".intval($db->record['id'])."\">".$db->record['cognome']." ".$db->record['nome']."</option>\n";
					$s = "";
				}
				echo "  	</select>\n</div>";
				echo "<br><div align=\"center\"><a href=\"\" onclick=\"el = prendiElementoDaId('associato'); iscrivi(".$idgita.",el.value); return false; \">OK</a></div>\n<br><br><br><br><br><br><br><br>";
				$db->close();
				unset($db);
		}
	}

	function modifica_dati()
	{

	}

	function modulistica_interna()
	{
		$ch = curl_init("http://www.biciedintorni.it/wordpress/associazione/modulistica-interna/");
		curl_exec($ch);
	}
	
	function newevento()
	{
		if(!is_numeric($_POST['invio']))
		{
			include("lib/html/newevento.php");
			return;
		}
		$db = new db_local();
		$this->settadatievento(&$query);
		if($db->query($query))
			echo "<div align=\"center\" style=\"color: #0000FF\"><h2>Inserimento evento avvenuto con successo.</h2></div>";
		else
			echo "<div align=\"center\" style=\"color: #FF0000\"><h2>Errore nell'inserimento dell'evento.(ERRORE da indicare al WebMaster: \"newevento\" - Query FALSA)</h2></div>";
		unset($db);
	}

	function modevento()
	{
		$id = $_GET['id'];
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
			if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE id = '".$id."' AND(idcreat = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A');"))
				require_once("lib/html/modevento.php");
			else
				echo "Errore modevento, query falsa.";
			$db->close();
			unset($db);
		}
		elseif (is_numeric($_POST['invio']))
		{
			$db = new db_local();
			$db->query("SELECT * from eventi WHERE id = '".$_POST['invio']."' AND(idcreat = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') LIMIT 1;",true);
			if(!$db->next_record())
			{
				mail("dibella.antonino@gmail.com","Modifica evento Applicazione Bici&Dintorni non autorizzata.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare un evento ma non è autorizzato a farlo.\n".
				"-----\nFile: user.php\nRoutine: modevento (Visualizzazione).\n-----\nID Evento: ".$_POST['invio']."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pass);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica dell'evento. (modifica evento, permessi non validi)</div>";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			if($_POST['titolo'] == "")
			{
				mail("dibella.antonino@gmail.com","Controllo Titolo evento.<ID evento:".$_POST['invio'].">","Prima di chiamare settadati.\nServer Agent: ".$_SERVER["HTTP_USER_AGENT"]);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica della gita. (TITOLO NON IMPOSTATO)<br>Per piacere modifica nuovamente la gita.</div>";
				return;
			}
			$this->settadatievento(&$query,$db->record['pathfile']);
			//echo "<br>".$query."<br>";
			//echo "<script>alert('miiiiiii ok')</script>";
			//exit;
			if($db->query($query))
			{
				$id = $_POST['invio'];
				if($db->query("INSERT INTO modifiche_eventi (idevento,idmodificatore) VALUES ('".$id."','".$this->matricola."');"))
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica evento avvenuta con successo.</div>";
				else
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'evento. (inserimento modifica, query falsa)</div>";
			}
			else
			echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'evento. (modifica evento, query falsa)</div>";
			$db->close();
			unset($db);
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listeventi();
		}
	}

	function settadatievento(&$query = null,$addrfile = null)
	{


		if(get_magic_quotes_gpc() == 1)
		{
			$titolo = htmlentities($_POST['titolo']);
			$descrizione = htmlentities($_POST['descrizione']);
		}
		else
		{
			$titolo = addslashes(htmlentities($_POST['titolo']));
			$descrizione = addslashes(htmlentities($_POST['descrizione']));
		}
		//GESTIONE UPLOAD FILE
		if($_POST['elimg'] == '1')
		{
			unlink($addrfile);
			$pathfile = "";
		}
		elseif($_FILES['file']['error'] == '0')
		{
			//echo print_r($_FILES['file']);
			$dir = "files/eventi/";
			if (!is_dir("files"))
			{
				if(!mkdir("files"))
				{
					echo "<center>Errore creazione directory files.</center>";
				}
				else
				{
					if (!is_dir("files/eventi"))
						if(!mkdir("files/eventi"))
						{
							echo "<center>Errore creazione directory files/eventi.</center>";
						}
				}
			}
			else
			{
				if (!is_dir("files/eventi"))
					if(!mkdir("files/eventi"))
					{
						echo "<center>Errore creazione directory files/eventi.</center>";
					}
			}
			$file = $_FILES['file'];
			if(file_exists($dir.$file['name']))
			{
				echo "<center>File gia esistente. Il file verr&agrave sostituito.</center>";
				unlink($dir.$file['name']);
				//exit;
			}
			//echo "il file non esiste<br>";
			if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name']))
			{
				//echo "il file è stato caricato correttamente<br>";
				if(move_uploaded_file($file['tmp_name'], $dir.$file['name']))
				{
					//echo "muovo il file tmp nel nuovo file ".$dir.$file['name'].".<br>";
					if($addrfile) unlink($addrfile);
					$caricato = true;
					$pathfile = $dir.$file['name'];
					//echo "eseguo la query $Query.<br>";
				}
				else
				{
					if (file_exists($file['tmp_name']))
						echo "<center>ERRORE GRAVE SPOSTAMENTO>".$file['tmp_name']."<--in-->".$dir.$file['name']."<</center>";
					else
						echo "<center>ERRORE FILE TMP NON ESISTENTE</center>";
					$pathfile = $addrfile;
				}
				//echo "DATA>".$data."<<br>";
			}
			else
			{
				echo "<center>ERRORE UPLOAD>".$file['name']."<</center>";
			}
		}
		else
		{
			$pathfile = $addrfile;
		}
		$dataeora = date("Y-m-d G:i:00",mktime(intval($_POST['ora']),intval($_POST['minuti']),0,intval($_POST['mese']),intval($_POST['giorno']),intval($_POST['anno'])));
		if($this->carica == 'A')
			$approvato = intval($_POST['approvato']);
		else
			$approvato = '0';
		$id = $_POST['invio'];
		if($_GET['fun'] == 'newevento')
			$query = "INSERT INTO eventi (titolo,dataeora,descrizione,idcreat,pathfile,approvato) VALUES ".
			"('".$titolo."','".$dataeora."','".$descrizione."','".$this->matricola."','".$pathfile."','".$approvato."');";
		else
			$query = "UPDATE eventi SET ".
				"titolo = '".$titolo."', ".
				"dataeora = '".$dataeora."', ".
				"descrizione = '".$descrizione."', ".
				"idcreat = '".$this->matricola."', ".
				"pathfile = '".$pathfile."', ".
				"approvato = '".$approvato."'".
				" WHERE id = '".$id."' LIMIT 1;"; //"approvata = '".$approvata."'".
	}

	function listaeventi()
	{
		include("lib/html/listaeventi.php");
	}

	function listeventi()
	{
		$db = new db_local();
		if($this->matricola == 0)
		$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi ORDER BY dataeora DESC;";
		else
		{
			switch ($this->carica) {
				case 'A':
				case 'S':
					$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi ORDER BY dataeora DESC;";
					break;
				default:
					$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM eventi WHERE idcreat = $this->matricola ORDER BY dataeora DESC;";
			}
		}

		if($db->query($sqlqry))
			{ ?>
			<table align="center" border="1">
				<tbody>
					<tr>
						<td align="center" colspan="2">Lista eventi<br>Attenzione, puoi vedere e modificare solo gli eventi da te creati.</td>
						<td align="center" colspan="3"><a href="admin.php?fun=listaeventi" title="Lista di tutti gli eventi ordinati per data">Lista di tutti gli eventi inseriti ordinati per data</a></td>
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
						echo "<tr>\n\t<td colspan=\"5\">Nessun evento presente nel database</td>\n</tr>";
						else
						while($db->next_record())
						{
							echo "					<tr>\n						<td>".date("d/m/Y",$db->record['data'])."</td>\n						";
							//echo "<td><a target=\"_blank\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n						";
							echo "<td>".$db->record['titolo']."</td>\n						";
							echo "<td><a href=\"admin.php?fun=modevento&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
							if($this->carica != 'A')
							{
								echo "<td>Elimina</td>\n					";
								echo "<td>Approva</td>\n					</tr>\n";
							}
							else
							{
								echo "<td><a href=\"\" onclick=\"javascript: eliminaevento(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
								if($db->record['approvato'] == '1')
								$str = 'Approvato';
								else
								$str = 'Non approvato';
								echo "<td><a href=\"\" id=\"linkapp".$i++."\" onclick=\"approvaevento(".$db->record['id'].",'linkapp".($i-1)."'); return false;\">".$str."</a></td>\n						";

							}
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}

	function iscrizioni()
	{
		include("lib/html/listaiscrizioni.php");
	}

	function delisc($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM iscrizioni WHERE id = ".$id." AND (idassociato = ".$this->matricola." OR idresp = ".$this->matricola.") LIMIT 1 ;"))
			{
				echo "Iscrizione eliminata correttamente.";
				/*mail("dibella.antonino@gmail.com","Eliminazione iscrizione, Applicazione Bici&Dintorni.",
				"Ciao Antonino,\n".
				"qualcuno si è cancellato da una gita.\n".
				"----------------\n".
				"id: ".$id." \n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pass);*/
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "delevento (eliminazione evento), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
		$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione evento Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare un evento ma non ci è riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pass);
		return $vartest;
	}

}

class CapoGita extends Associato {

	function CapoGita($record = null)
	{
		$this->Associato($record);
		$this->menu = array_merge($this->menu,array("Aggiungi una gita"=>"newgita",
				"Modifica una gita"=>"modgita","Visualizza iscritti ad una gita"=>"iscritti",
				"Visualizza tutte le gite"=>"listagite"));
		$this->rand = rand();
	}
	


	function listagite()
	{
		include("lib/html/listagite.php");
	}

	function settadati(&$query = null,$addrfile = null)
	// modificata il 14/4/2016 per eliminare la funzione htmlentities()
	{
		if(get_magic_quotes_gpc() == 1)
		{
			//$titolo = htmlentities($_POST['titolo']);
			$titolo = $_POST['titolo'];
			$tipogita = $_POST['tipogita'];
			$difficolta = $_POST['difficolta'];
			$tipobici = $_POST['tipobici'];
			$km = $_POST['km'];
			$costo = $_POST['costo'];
			$apl = $_POST['apl'];
			if($tipogita != 'B' && $tipogita != 'C')
			{
				$apt = $_POST['apt'];
				$rpt = $_POST['rpt'];
			}
			if($_POST['aas'] == "")
			$aas = $_POST['aas2'];
			else
			$aas = $_POST['aas'];
			$rpl = $_POST['rpl'];
			$ral = $_POST['ral'];
			$itinerario = $_POST['itinerario'];
			$descrizione = $_POST['descrizione'];
			$note = $_POST['note'];
		}
		else
		{
			//$titolo = addslashes(htmlentities($_POST['titolo']));
			$titolo = addslashes($_POST['titolo']);
			$tipogita = addslashes($_POST['tipogita']);
			$difficolta = addslashes($_POST['difficolta']);
			$tipobici = addslashes($_POST['tipobici']);
			$km = addslashes($_POST['km']);
			$costo = addslashes($_POST['costo']);
			$apl = addslashes($_POST['apl']);
			if($tipogita != 'B' && $tipogita != 'C')
			{
				$apt = addslashes($_POST['apt']);
				$rpt = addslashes($_POST['rpt']);
			}
			if($_POST['aas'] == "")
			$aas = addslashes($_POST['aas2']);
			else
			$aas = addslashes($_POST['aas']);
			$rpl = addslashes($_POST['rpl']);
			$ral = addslashes($_POST['ral']);
			$itinerario = addslashes($_POST['itinerario']);
			$descrizione = addslashes($_POST['descrizione']);
			$note = addslashes($_POST['note']);
		}
		//GESTIONE UPLOAD FILE
		if($_POST['elimg'] == '1')
		{
			unlink($addrfile);
			$pathfile = "";
		}
		elseif($_FILES['file']['error'] == '0')
		{
			//echo print_r($_FILES['file']);
			$dir = "files/";
			//echo "l'user file è settato<br>";
			if (!is_dir("files"))
				if(!mkdir("files"))
				{
					echo "<center>Errore creazione directory files.</center>";
				}
			$file = $_FILES['file'];
			if(file_exists($dir.$file['name']))
			{
				echo "<center>File gia esistente. Il file verr&agrave sostituito.</center>";
				unlink($dir.$file['name']);
				//exit;
			}
			//echo "il file non esiste<br>";
			if($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name']))
			{
				//echo "il file è stato caricato correttamente<br>";
				if(move_uploaded_file($file['tmp_name'], $dir.$file['name']))
				{
					//echo "muovo il file tmp nel nuovo file ".$dir.$file['name'].".<br>";
					$caricato = true;
					if($addrfile) unlink($addrfile);
					$pathfile = $dir.$file['name'];
					//echo "eseguo la query $Query.<br>";
				}
				else
				{
					$pathfile = $addrfile;
					if (file_exists($file['tmp_name']))
						echo "<center>ERRORE GRAVE SPOSTAMENTO>".$file['tmp_name']."<--in-->".$dir.$file['name']."<</center>";
					else
						echo "<center>ERRORE FILE TMP NON ESISTENTE</center>";
				}
			}
			else
			{
				echo "<center>ERRORE UPLOAD>".$file['name']."<</center>";
			}
		}
		else
		{
			$pathfile = $addrfile;
		}
		//mail("dibella.antonino@gmail.com","Controllo ora","<".$_POST['aaoh'].">"."<".$_POST['aaom'].">\nil 2<".$_POST['aaoh2']."><".$_POST['aaom2'].">");
		if(($_POST['aaoh'] != "00") && ($_POST['aaom'] != "00"))
			$aao = intval($_POST['aaoh']).":".intval($_POST['aaom']);
		else
			$aao = intval($_POST['aaoh2']).":".intval($_POST['aaom2']);
		$rpo = intval($_POST['rpoh']).":".intval($_POST['rpom']);
		$rao = intval($_POST['raoh']).":".intval($_POST['raom']);
		$resp = intval($_POST['resp']);
		$durata = intval($_POST['durata']);
		$dataeora = date("Y-m-d G:i:00",mktime(intval($_POST['apoh']),intval($_POST['apom']),0,intval($_POST['mese']),intval($_POST['giorno']),intval($_POST['anno'])));
		//echo "-----".$dataeora."-----";
		$perc = intval($_POST['perc']);
		if($_POST['maxpinf'] != '1')
			$maxp = intval($_POST['maxp']);
		if($this->carica == 'A')
			$approvata = intval($_POST['approvata']);
		else
			$approvata = '0';
		//echo date("d / F / Y H:i",$dataeora);
		//return;
		$id = $_POST['invio'];
		if($tipogita != 'B' && $tipogita != 'C')
		{
			if($_GET['fun'] == 'newgita')
			$query = "INSERT INTO gite (titolo,tipogita,dataeora,durata,tipobici,difficolta,km,perc,idcreat,idresp,maxp,costo,itinerario,descrizione,note,pathfile,apl,apt,aas,aao,rpl,rpo,rpt,ral,rao,approvata) VALUES ('".$titolo."','".$tipogita."','".$dataeora."','".$durata."','".$tipobici."','".$difficolta."','".$km."','".$perc."','".$this->matricola."','".$resp."','".$maxp."','".$costo."','".$itinerario."','".$descrizione."','".$note."','".$pathfile."','".$apl."','".$apt."','".$aas."','".$aao."','".$rpl."','".$rpo."','".$rpt."','".$ral."','".$rao."','".$approvata."');";
			else
			$query = "UPDATE gite SET ".
			"titolo = '".$titolo."', ".
			"tipogita = '".$tipogita."', ".
			"dataeora = '".$dataeora."', ".
			"durata = '".$durata."', ".
			"tipobici = '".$tipobici."', ".
			"difficolta = '".$difficolta."', ".
			"km = '".$km."', ".
			"perc = '".$perc."', ".
			"idresp = '".$resp."', ".
			"idcreat = '".$this->matricola."', ".
			"maxp = '".$maxp."', ".
			"costo = '".$costo."', ".
			"itinerario = '".$itinerario."', ".
			"descrizione = '".$descrizione."', ".
			"note = '".$note."', ".
			"pathfile = '".$pathfile."', ".
			"apl = '".$apl."', ".
			"apt = '".$apt."', ".
			"aas = '".$aas."', ".
			"aao = '".$aao."', ".
			"rpl = '".$rpl."', ".
			"rpo = '".$rpo."', ".
			"rpt = '".$rpt."', ".
			"ral = '".$ral."', ".
			"rao = '".$rao."' ".
			" WHERE id = '".$id."' ;"; //"approvata = '".$approvata."'".
		}
		elseif ($_GET['fun'] == 'newgita')
		$query = "INSERT INTO gite (titolo,tipogita,dataeora,durata,tipobici,difficolta,km,perc,idcreat,idresp,maxp,costo,itinerario,descrizione,note,pathfile,apl,aao,rpl,rpo,ral,rao,approvata) VALUES ('".$titolo."','".$tipogita."','".$dataeora."','".$durata."','".$tipobici."','".$difficolta."','".$km."','".$perc."','".$this->matricola."','".$resp."','".$maxp."','".$costo."','".$itinerario."','".$descrizione."','".$note."','".$pathfile."','".$apl."','".$aao."','".$rpl."','".$rpo."','".$ral."','".$rao."','".$approvata."');";
		else
		{
			$query = "UPDATE gite SET ".
			"titolo = '".$titolo."', ".
			"tipogita = '".$tipogita."', ".
			"dataeora = '".$dataeora."', ".
			"durata = '".$durata."', ".
			"tipobici = '".$tipobici."', ".
			"difficolta = '".$difficolta."', ".
			"km = '".$km."', ".
			"perc = '".$perc."', ".
			"idresp = '".$resp."', ".
			"idcreat = '".$this->matricola."', ".
			"maxp = '".$maxp."', ".
			"costo = '".$costo."', ".
			"itinerario = '".$itinerario."', ".
			"descrizione = '".$descrizione."', ".
			"note = '".$note."', ".
			"pathfile = '".$pathfile."', ".
			"apl = '".$apl."', ".
			"aao = '".$aao."', ".
			"rpl = '".$rpl."', ".
			"rpo = '".$rpo."', ".
			"ral = '".$ral."', ".
			"rao = '".$rao."' ".
			" WHERE id = '".$id."'; ";//"approvata = '".$approvata."'".
		}

	}

	function iscritti()
	{
		$id = $_GET['id'];
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("SELECT gite.titolo,iscrizioni.*,anagrafiche.nome,anagrafiche.cognome,anagrafiche.tel1,anagrafiche.email,anagrafiche.cauzione FROM iscrizioni,anagrafiche,gite WHERE anagrafiche.id = iscrizioni.idassociato AND gite.id = iscrizioni.idgita AND gite.id = '".$id."' AND iscrizioni.idresp <> CONCAT(iscrizioni.idassociato,'-NS') AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') ORDER BY iscrizioni.dataeora,anagrafiche.cognome,anagrafiche.nome;"))
				require_once("lib/html/listaiscritti.php");
			else
				echo "Errore iscritti, query falsa.";
			$db->close();
			unset($db);
			//echo "<script>alert('miiiiiii id num')</script>";
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listaiscritti();
		}
	}

	function listaiscritti()
	{
		$db = new db_local();
		if($this->matricola == 0)
		$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita GROUP BY iscrizioni.idgita ORDER BY data DESC;";
		else
		{
			switch ($this->carica) {
				case 'A':
				case 'S':
					$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita GROUP BY iscrizioni.idgita ORDER BY data DESC;";
					break;
				default:
					$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."') GROUP BY iscrizioni.idgita ORDER BY data DESC;";
					break;
			}
		}
		if($db->query($sqlqry))
			{ ?>
			<table align="center" border="1">
				<tbody>
					<tr>
						<td align="center" colspan="3">Lista degli iscritti<br>Attenzione, puoi vedere solo gli iscritti alla tua gita.</td>
					</tr>
						<?php
						while($db->next_record())
						{
							echo "					<tr>\n						<td>".date("d/m/Y",$db->record['data'])."</td>\n						";
							//echo "<td><a target=\"_blank\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n						";
							echo "<td>".$db->record['titolo']."</td>\n						";
							echo "<td><a href=\"admin.php?fun=iscritti&amp;id=".$db->record['idgita']."\">Vedi</a></td>\n						";
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}

	function newgita()
	{
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: inizio new gita</div>";
		if(!$_POST['invio'])
		{
			echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: new gita, _POST['invio'] = FALSE</div>";
			include("lib/html/newgita.php");
			return;
		}
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: new gita, _POST['invio'] = TRUE</div>";
		$db = new db_local();
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: new gita, richiamo settadati</div>";
		$this->settadati(&$query);
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: new gita, esecuzione query di inserimento</div>";
		if($db->query($query))
		{
        	$rsDB = new db_local();
			$rsDB->query("SHOW TABLE STATUS LIKE 'gite'",true);
			if($rsDB->next_record())
				$idnewgita = $rsDB->record['Auto_increment'] - 1;
			else 
				$idnewgita = 0;
			$rsDB->close();
			unset($rsDB);
			echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Inserimento gita avvenuto con successo.</h2></div>";
			if(!$db->query("INSERT INTO iscrizioni (idgita,idassociato,idresp) VALUES (".$idnewgita.",".intval($_POST['resp']).",".$this->matricola.");"))
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'iscrizione del capogita alla propria gita.(ERRORE da indicare al WebMaster: \"newgita\" - Query autoiscrizione capogita FALSA)</h2></div>";
			else
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Iscrizione del capogita alla propria gita avvenuta con successo.</h2></div>";
			
		}
		else
		echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'inserimento della gita.(ERRORE da indicare al WebMaster: \"newgita\" - Query FALSA)</h2></div>";
		unset($db);
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: new gita, uscita</div>";
	}

	function modgita()
	{
		$id = $_GET['id'];
		echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: modifica gita, inizio funzione (_GET['id']=$id)</div>";
		if(is_numeric($id))
		{
			echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: modifica gita, is_numeric($id) = TRUE</div>";
			include_once("lib/db_mysql.php");
			$db = new db_local();
			//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
			if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$id."' AND(idcreat = '".$this->matricola."' or idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A');"))
			require_once("lib/html/modgita.php");
			else
			echo "Errore modgita, query falsa.";
			$db->close();
			unset($db);
			//echo "<script>alert('miiiiiii id num')</script>";
		}
		elseif (is_numeric($_POST['invio']))
		{
			echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: modifica gita, dopo invio dati dal form.</div>";
			$db = new db_local();
			$db->query("SELECT * from gite WHERE id = '".$_POST['invio']."' AND(idcreat = '".$this->matricola."' or idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') LIMIT 1;",true);
			if(!$db->next_record())
			{
				echo "<div align=\"center\" style=\"color: #FF0000; display: none;\">DEBUG: modifica gita, permessi non validi</div>";
				mail("dibella.antonino@gmail.com","Modifica gita Applicazione Bici&Dintorni non autorizzata.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare una gita ma non � autorizzato a farlo.\n".
				"-----\nFile: user.php\nRoutine: modgita (Visualizzazione).\n-----\nID Gita: ".$_POST['invio']."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pw);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica della gita. (modifica gita, permessi non validi)</div>";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			if($_POST['titolo'] == "")
			{
				mail("dibella.antonino@gmail.com","Controllo Titolo gita.<ID gita:".$_POST['invio'].">","Prima di chiamare settadati.\nServer Agent: ".$_SERVER["HTTP_USER_AGENT"].
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pw);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica della gita. (TITOLO NON IMPOSTATO)<br>Per piacere modifica nuovamente la gita.</div>";
				return;
			}
			$this->settadati(&$query,$db->record['pathfile']);
			//echo "<br>".$query."<br>";
			//echo "<script>alert('miiiiiii ok')</script>";
			//exit;
			if($db->query($query))
			{
				$id = $_POST['invio'];
				if($db->query("INSERT INTO modifiche_gite (idgita,idmodificatore) VALUES ('".$id."','".$this->matricola."');"))
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica gita effettuata.</div>";
				else
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica della gita. (inserimento modifica, query falsa)</div>";
			}
			else
			echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica della gita. (modifica gita, query falsa)</div>";
			$db->close();
			unset($db);
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listgite();
		}
	}

	function listgite()
	{
		$db = new db_local();
		if($this->matricola == 0)
		$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE_FORMAT(dataeora,\"%Y\") >= ".date("Y")." ORDER BY dataeora DESC;";
		else
		{
			switch ($this->carica) {
				case 'A':
				case 'S':
					$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE_FORMAT(dataeora,\"%Y\") >= ".date("Y")." ORDER BY dataeora DESC;";
					break;
				default:
					$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE DATE_FORMAT(dataeora,\"%Y\") >= ".date("Y")." AND idcreat = $this->matricola OR idresp = $this->matricola ORDER BY dataeora DESC;";
			}
		}

		if($db->query($sqlqry))
			{ ?>
			<table align="center" border="1">
				<tbody>
					<tr>
						<td align="center" colspan="3">Lista gite<br>Attenzione, puoi vedere e modificare solo le gite da te create.</td>
						<td align="center" colspan="3"><a href="admin.php?fun=listagite" title="Lista di tutte le gite ordinate per data">Lista di tutte le gite inserite ordinate per data</a></td>
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
						echo "<tr>\n\t<td colspan=\"6\">Nessuna gita presente nel database</td>\n</tr>";
						else
						while($db->next_record())
						{
							echo "					<tr>\n						<td>".date("d/m/Y",$db->record['data'])."</td>\n						";
							//echo "<td><a target=\"_blank\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n						";
							echo "<td>".$db->record['titolo']."</td>\n						";
							echo "<td>";
							if($db->record['difficolta'] == 'F')
							echo "Facile";
							elseif ($db->record['difficolta'] == 'M')
							echo "Media";
							elseif ($db->record['difficolta'] == 'U')
							echo "Facile per famiglie";
							else
							echo "Impegnativa";
							echo "</td>\n						";
							echo "<td><a href=\"admin.php?fun=modgita&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
							if($this->carica != 'A')
							{
								echo "<td>Elimina</td>\n					";
								echo "<td>Approva</td>\n					</tr>\n";
							}
							else
							{
								echo "<td><a href=\"\" onclick=\"javascript: elimina(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
								if($db->record['approvata'] == '1')
								$str = 'Approvata';
								else
								$str = 'Non approvata';
								echo "<td><a href=\"\" id=\"linkapp".$i++."\" onclick=\"approva(".$db->record['id'].",'linkapp".($i-1)."'); return false;\">".$str."</a></td>\n						";

							}
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}
}

class Amministratore extends CapoGita {
	function Amministratore($record = null)
	{
		$this->CapoGita($record);
		$this->menu = array_flip ($this->menu);
		$this->menu['modgita'] = "Modifica/Elimina/Approva una gita";
		$this->menu['modass'] = "Modifica/Elimina/Approva un associato";
		$this->menu = array_flip ($this->menu);
		//$this->menu = array_merge($this->menu,array("Approva un associato"=>"appass","Approva un evento"=>"appevento","Modifica i dati di un associato"=>"modass","Aggiungi un nuovo associato"=>"newass","Elimina un associato"=>"delass","Recupera un associato eliminato"=>"recass","Statistiche"=>"stat"));
		$this->menu = array_merge($this->menu,array("Aggiungi un evento"=>"newevento",
				"Modifica un evento"=>"modevento","Elimina un evento"=>"delevento",
				"Approva un evento"=>"appevento","Aggiungi un nuovo associato"=>"newass",
				"Recupera un associato eliminato"=>"recass","Statistiche"=>"stat",
				"File Indirizzi per Etichette"=>"etichette","File Excel Lista Utenti"=>"listautenti",
				"Modifica/Elimina un libro"=>"modlibro","Aggiungi un libro"=>"newlibro",
				"Libri in prestito"=>"prestitilibro"));
		$this->menu = array_merge($this->menu,array("E-Mail Collettive"=>"mailcollettive","Nuova E-Mail Collettiva"=>"newmail","Modifica/Elimina E-Mail"=>"modmail","Calendario Invii"=>"calendario","Crea Gruppo"=>"newgruppo","Modifica/Elimina Gruppo"=>"modgruppo","Ritorna al menu principale"=>"menuprincipale"));
	}

	function etichette()
	{
		$db = new db_local();
		$sqlqry = "SELECT * FROM anagrafiche WHERE (a".date("Y")."=1 OR a".(date("Y")-1)."=1) AND idcapo=0 and email = '' AND carica != 'NS' AND tiposocio IN ('SF','SO','SS') ORDER BY cognome,nome;";
		if($db->query($sqlqry))
		{
			require_once('lib/fpdf/fpdf.php');
			$pdf = new FPDF();
			$pdf->SetMargins(0.5, 5,1);
			$pdf->SetAutoPageBreak(true,3);
			$pdf->AddPage('P','mm','A4');
			//$pdf->Cell(210,5,'',1,1);
			$intVar = 1;
			//$intX = $pdf->GetX();
			$intX = 0.5;
			$intY = $pdf->GetY();
			while($db->next_record())
			{
				$pdf->SetLeftMargin($intX);
				$pdf->SetXY($intX,$intY);
				$pdf->SetFont('Arial','B',10);
				$pdf->Cell(75,6,' ','',1,'L');
				$pdf->Cell(75,6,' '.$db->record['cognome'].' '.$db->record['nome'],'',1,'L');
				$pdf->SetFont('Arial','',10);
				$pdf->Cell(75,6,' '.$db->record['via'],'',1,'L');
				$pdf->SetFont('Arial','',8);
				/*
				$pdf->Cell(53,6,$db->record['cap'],'',1,'L');
				$pdf->Cell(10,6,' ','',0,'L');
				$pdf->Cell(53,6,$db->record['cap'].' - '.$db->record['citta'].' ('.$db->record['prov'].')','',1,'L');
				*/
				
				$pdf->Cell(75,6,' '.$db->record['cap'].' - '.$db->record['citta'].' ('.$db->record['prov'].')','',1,'L');
				$pdf->Cell(75,12,' ','',1,'L');
				if ($intVar < 3)
				{
					$intX = $intX + 70;
					$intY = $pdf->GetY() - 36;
				}
				else
				{
					$intX = 0;
					$intY = $pdf->GetY();
					$intVar=0;
				}
				$intVar++;
			}
			$pdf->Output();
		}
	}
	
	function listautenti()
	{
		if ($_GET['download'] != 1)
		{
			makeHead("Amministrazione");
			$path = "admin.php?fun=listautenti&amp;download=1";
			$stranni = "Includi campi:";
			include(dirname(__FILE__)."/html/selsoci.php");
			makeTail();
			exit;
		}
		if ($_POST['approvati'] == 1)
		{
			$select = "anagrafiche.approvato";
			$intest = "\"Approvato\"";
			$where = "anagrafiche.approvato = 1";
		}elseif ($_POST['approvati'] == 2)
			{
				$select = ($select == "" ? "anagrafiche.approvato" : $select.",anagrafiche.approvato");
				$intest = ($intest == "" ? "\"Approvato\"" : $intest.";\"Approvato\"");
				$where = "anagrafiche.approvato = 0";
			}else
				{
					$select = ($select == "" ? "anagrafiche.approvato" : $select.",anagrafiche.approvato");
					$intest = ($intest == "" ? "\"Approvato\"" : $intest.";\"Approvato\"");
				}
				
		for ($i = 2007; $i <= date("Y"); $i++)
		{
			if ($_POST['a'.$i] == 1)
			{
				$select = ($select == "" ? "anagrafiche.a".$i : $select.",anagrafiche.a".$i);
				$intest = ($intest == "" ? '"'.$i.'"' : $intest.';"'.$i.'"');
				//$where = ($where == "" ? "anagrafiche.a".$i." = 1" : $where.",anagrafiche.a".$i." = 1");
			}
			
		}
		
		$db = new db_local();
		$sqlqry = "SELECT anagrafiche.id,anagrafiche.cognome,anagrafiche.nome,anagrafiche.user,anagrafiche.sesso,anagrafiche.via,anagrafiche.cap,anagrafiche.citta,anagrafiche.prov,anagrafiche.datanascita,anagrafiche.tel1,anagrafiche.tel2,anagrafiche.cell,anagrafiche.email,anagrafiche.carica,anagrafiche.tiposocio,anagrafiche.cauzione,anagrafiche.note, If(anagrafiche.idcapo = 0,'',concat(concat(capifam.cognome, ' '), capifam.nome)) as capofamiglia".($select == "" ? '' : ','.$select )." FROM anagrafiche INNER JOIN anagrafiche as capifam ON anagrafiche.idcapo = capifam.id WHERE anagrafiche.id > 0 AND anagrafiche.carica != 'NS'".($where == "" ? '' : ' AND '.$where )." ORDER BY anagrafiche.cognome,anagrafiche.nome;";
		$testo = '"ID";"Cognome";"Nome";"User";"Sesso";"Via";"Cap";"Citta";"Prov";"Data di nascita";"Tel1";"Tel2";"Cell";"Email";"Carica";"Tipo socio";"Cauzione";"Note";"Capo Famiglia"'.($intest == "" ? '' : ';'.$intest )."\n";
		if($db->query($sqlqry))
		{
			while($db->next_record(MYSQLI_ASSOC))
			{
				foreach ($db->record as $key => $value)
				{
					$testo.="\"".$value."\";";
				}
				$testo[strlen($testo)]="\n";
			}
		}
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Disposition: attachment;filename=listautenti.csv");
		header("Content-Transfer-Encoding: binary");
		print $testo;
		exit;
	}
	
	function appass($id)
	{
		if (is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("SELECT approvato FROM anagrafiche WHERE id = '".$id."' ;"))
			{
				if($db->next_record())
				{
					if($db->record['approvato'] == '1')
					{
						if($db->query("UPDATE anagrafiche SET approvato = '0' WHERE id = '".$id."' LIMIT 1;"))
							return "Non approvato";
						else
							return "appass (approvazione associato), query falsa.";
					}
					else
						if($db->query("UPDATE anagrafiche SET approvato = '1' WHERE id = '".$id."' LIMIT 1;"))
							return "Approvato";
						else
							return "appass (approvazione associato), query falsa.";
				}
				else
					return "appass (approvazione associato), associato non esistente.";
			}
			else
				return "appass (approvazione associato), query select falsa.";
			$db->close();
			unset($db);
		}
		else
		{
			return "nessun id specificato.";
		}
	}

	function appevento($id)
	{
		if (is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("SELECT approvato FROM eventi WHERE id = '".$id."' ;"))
			{
				if($db->next_record())
				{
					if($db->record['approvato'] == '1')
					{
						if($db->query("UPDATE eventi SET approvato = '0' WHERE id = '".$id."' ;"))
						return "Non approvato";
						else
						return "appevento (approvazione evento), query falsa.";
					}
					else
					if($db->query("UPDATE eventi SET approvato = '1' WHERE id = '".$id."' ;"))
					return "Approvato";
					else
					return "appevento (approvazione evento), query falsa.";
				}
				else
				return "appevento (approvazione evento), evento non esistente.";
			}
			else
			return "appevento (approvazione evento), query select falsa.";
			$db->close();
			unset($db);
		}
		else
		{
			return "nessun id specificato.";
		}
	}

	function appgita($id)
	{
		if (is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("SELECT approvata FROM gite WHERE id = '".$id."' ;"))
			{
				if($db->next_record())
				{
					if($db->record['approvata'] == '1')
					{
						if($db->query("UPDATE gite SET approvata = '0' WHERE id = '".$id."' ;"))
						return "Non approvata";
						else
						return "appgita (approvazione gita), query falsa.";
					}
					else
					if($db->query("UPDATE gite SET approvata = '1' WHERE id = '".$id."' ;"))
					return "Approvata";
					else
					return "appgita (approvazione gita), query falsa.";
				}
				else
				return "appgita (approvazione gita), gita non esistente.";
			}
			else
			return "appgita (approvazione gita), query select falsa.";
			$db->close();
			unset($db);
		}
		else
		{
			return "nessun id specificato.";
		}
	}

	function delgita($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM iscrizioni WHERE idgita = ".$id." ;"))
			{
				if($db->query("DELETE FROM gite WHERE id = ".$id." LIMIT 1 ;"))
				{
					echo "Gita eliminata correttamente.";
					mail("dibella.antonino@gmail.com","Eliminazione gita, Applicazione Bici&Dintorni.",
					"Ciao Antonino,\n".
					"qualcuno ha eliminato una gita.\n".
					"----------------\n".
					"nomeutente: ".$this->user." \n".
					"password: ".$this->pw);
					$db->close();
					unset($db);
					return;
				}
				else
				{
					$vartest = "delgita (eliminazione gita), query falsa.";
					echo $vartest;
				}
			}
			else
			{
				$vartest = "delgita (eliminazione iscrizioni alla gita), query falsa.\"";
				echo $vartest;
			}
			$db->close();
			unset($db);

		}
		else
		$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione gita Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare una gita ma non ci � riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}
	
	function delass($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("INSERT INTO socieliminati (SELECT * FROM anagrafiche WHERE id = ".$id." LIMIT 1);"))
			{
				if($db->query("DELETE FROM anagrafiche WHERE id = ".$id." LIMIT 1;"))
				{
					echo "Associato eliminato correttamente. (Query: DELETE matricola = ".$id.")";
					mail("dibella.antonino@gmail.com","Eliminazione associato, Applicazione Bici&Dintorni.",
					"Ciao Antonino,\n".
					"qualcuno ha eliminato una associato.\n".
					"----------------\n".
					"nomeutente: ".$this->user." \n".
					"password: ".$this->pw);
					$db->close();
					unset($db);
					return;
				}
				else
				{
					$vartest = "delass (eliminazione associato), query falsa.";
					echo $vartest;
				}
			}
			else
			{
				$vartest = "delass (copia in eliminati), query falsa.\"";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else{
		$vartest = "nessun id specificato.";		}

		mail("dibella.antonino@gmail.com","Errore eliminazione gita Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare una gita ma non ci � riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}

	function delevento($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			$db->query("SELECT pathfile FROM eventi WHERE id = ".$id." LIMIT 1 ;");
			if($db->next_record())
			{
				if($db->record['pathfile'])
					unlink($db->record['pathfile']);
			}
			if($db->query("DELETE FROM eventi WHERE id = ".$id." LIMIT 1 ;"))
			{
				echo "Evento eliminato correttamente.";
				mail("dibella.antonino@gmail.com","Eliminazione evento, Applicazione Bici&Dintorni.",
					"Ciao Antonino,\n".
					"qualcuno ha eliminato un evento.\n".
					"----------------\n".
					"nomeutente: ".$this->user." \n".
					"password: ".$this->pw);
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "delevento (eliminazione evento), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
			$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione evento Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare un evento ma non ci è riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}

	function modass()
	{
		$id = $_GET['id'];
		if(is_numeric($id) && ($id > 0))
		{
			//return;
			include_once("lib/db_mysql.php");
			$db = new db_local();
			//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
			if($db->query("SELECT * FROM anagrafiche WHERE id = '".$id."' LIMIT 1;"))
			{
				if($db->next_record())
					include("lib/html/modass.php");
				else
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'associato. (nessun associato con questo ID)</div>";						
			}
			else
				echo "Errore modass, query falsa.";
			$db->close();
			unset($db);
			//echo "<script>alert('miiiiiii id num')</script>";
			
		}
		elseif ($_GET['save'] == 1)
		{	
			$db = new db_local();
			$db->query("SELECT * from anagrafiche WHERE id = '".$_POST['matricola']."' LIMIT 1;",true);
			if(!$db->next_record())
			{
				mail("dibella.antonino@gmail.com","Errore modifica associato Applicazione Bici&Dintorni.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare un associato che non ha un id corrispondente nel database.\n".
				"-----\nFile: user.php\nRoutine: modass (Salvataggio).\n-----\nID Ass: ".$_POST['matricola']."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pw);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica dell'associato. (modifica associato, nessun id)</div>";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			$this->settadatiass(&$query,$db->record['pathfile'],&$sendmail);
			//echo "<br>".$query."<br>";
			//echo "<script>alert('miiiiiii ok')</script>";
			//exit;
			if($db->query($query))
			{
				$id = $_POST['matricola'];
				if($db->query("INSERT INTO modifiche_associato (idass,idmodificatore) VALUES ('".$id."','".$this->matricola."');"))
					echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Modifica associato avvenuta con successo.</h2></div>";
				else
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nella modifica dell'associato. (inserimento modifica, query falsa)</h2></div>";
			}
			else
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nella modifica dell'associato. (modifica ass, query falsa)</h2></div>";
				
			if(is_array($sendmail))
			{
				if($sendmail['email'] != "")
				{
					if(!mail($sendmail['email'], "Bici&Dintorni, dati di accesso alle iscrizioni online.", "Salve ".$sendmail['cognome']." ".$sendmail['nome']."\n".
							"di seguito i dati per poter accedere al nostro sito:\n".
							"nomeutente: ".$sendmail['user']."\n".
							"password: ".$sendmail['password']."\n\n".
							"Cordiali saluti, Bici&Dintorni",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n"))
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'invio dell'email all'associato.(ERRORE da indicare al WebMaster: \"newass\" - function mail return false)</h2></div>";
					else
						echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Dati associato inviati tramite email.</h2></div>";
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Impossibile inviare l'email all'associato, il campo dell'email risulta vuoto.</h2></div>";
				}
			}
			$db->close();
			unset($db);			
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listass();
		}
	}

	function listass()
	{
		$titololista = "Lista soci ".date("Y");
		$db = new db_local();
		$sqlqry = "SELECT * FROM anagrafiche WHERE a".date("Y")."=1 AND carica != 'NS' AND id !=0 ORDER BY cognome ASC,nome ASC,a".date("Y")." DESC;";
		//$sqlqry = "SELECT * FROM anagrafiche WHERE carica != 'NS' ORDER BY cognome ASC,nome ASC,a".date("Y")." DESC;";
		if(is_numeric($_GET['list']))
		{
			if($_GET['list']==0)
			{
				makeHead("Amministrazione");
				$path = "admin.php?fun=modass&amp;list=4";
				$stranni = "Soci degli anni:";
				include(dirname(__FILE__)."/html/selsoci.php");
				makeTail();
				exit;
				$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=1 AND a".(date("Y") - 1)."=1 AND a".date("Y")."=0 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
			}elseif($_GET['list']==1)
				{
					$titololista = "Lista soci ".(date("Y")-1)." che non hanno rinnovato";
					$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=1 AND a".(date("Y") - 1)."=1 AND a".date("Y")."=0 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
				}elseif($_GET['list']==2)
					{
						$titololista = "Lista soci dell'anno scorso che hanno rinnovato anche quest'anno";
						$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=1 AND a".(date("Y") - 1)."=1 OR a".date("Y")."=1 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
					}elseif($_GET['list']==3)
						{
							$titololista = "Lista soci ".date("Y")." non approvati";
							$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=0 AND a".date("Y")."=1 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
						}elseif($_GET['list']==4)
							{
								$titololista = "Lista soci: Approvati: ";
								if ($_POST['approvati'] == 1)
								{
									$titololista .= "Si";
									/*$select = "anagrafiche.approvato";
									$intest = "\"Approvato\"";*/
									$where = "anagrafiche.approvato = 1";
								}elseif ($_POST['approvati'] == 2)
									{
										$titololista .= "No";
										/*$select = ($select == "" ? "anagrafiche.approvato" : $select.",anagrafiche.approvato");
										$intest = ($intest == "" ? "\"Approvato\"" : $intest.";\"Approvato\"");*/
										$where = "anagrafiche.approvato = 0";
									}else
										{
											$titololista .= "Si e No";
											/*$select = ($select == "" ? "anagrafiche.approvato" : $select.",anagrafiche.approvato");
											$intest = ($intest == "" ? "\"Approvato\"" : $intest.";\"Approvato\"");*/
										}
								
								
								for ($i = 2007; $i <= date("Y"); $i++)
								{
									if ($_POST['a'.$i] == 1)
									{
										if($anni == "")
											$anni = $i;
										else
											$anni .= ",".$i;
										/*$select = ($select == "" ? "anagrafiche.a".$i : $select.",anagrafiche.a".$i);
										$intest = ($intest == "" ? '"'.$i.'"' : $intest.';"'.$i.'"');*/
										$where = ($where == "" ? "anagrafiche.a".$i." = 1" : $where." AND anagrafiche.a".$i." = 1");
									}
									
								}
								$titololista .= ($anni == "" ? " Anni: TUTTI" : " Anni: ".$anni );
								$sqlqry = "SELECT * FROM anagrafiche WHERE carica != 'NS' AND id !=0".($where == "" ? '' : ' AND '.$where )." ORDER BY cognome,nome;";
							}
		} 
		if($db->query($sqlqry,true))
		{ ?>
		<p>Nuove funzioni: <a href="/application/anag_cerca.html">Ricerca per cognome</a> | 
		<a href="/application/anag_elenco_completo.php">Elenco completo anagrafiche</a> | 
		<a href="/application/anag_elenco_maisoci.php">Elenco anagrafiche mai iscritte all'associazione</a> |
		<a href="/application/anag_elenco_soci_prossimo_anno.php">Anagrafiche iscritte per il 2017</a></p>
			<table align="center" border="1">
				<tbody>
					<tr>
						<td align="center"><a href="admin.php?fun=modass&amp;list=0">Scegli gli utenti</a></td>
						<td align="center"><a href="admin.php?fun=modass">Lista associati <?php echo date("Y");?></a></td>
						<td align="center" colspan="2"><a href="admin.php?fun=modass&amp;list=1">Soci <?php echo date("Y") - 1;?> che non hanno rinnovato</a></td>
						<td align="center" colspan="2"><a href="admin.php?fun=modass&amp;list=2">Lista associati del <?php echo date("Y") - 1;?> e del <?php echo date("Y");?></a></td>
						<td align="center" colspan="3"><a href="admin.php?fun=modass&amp;list=3">Lista associati non approvati del <?php echo date("Y");?></a></td>
						<td align="center" colspan="<?php echo date("Y") - 2007 + 4; ?>">&nbsp;</td>
						<!--<td align="center" colspan="1">Lista associati non approvati.</td>-->
						<!--<td align="center" colspan="6"><a href="admin.php?fun=listaass" title="Lista di tutti gli associati">Lista di tutti gli associati</a></td>-->
					</tr>
					<tr>
						<td align="center" colspan="<?php echo date("Y") - 2007 + 13; ?>">&nbsp;<?php echo $titololista; ?>&nbsp;</td>
					</tr>
					<tr>
						<td align="center">Cognome</td>
						<td align="center">Nome</td>
						<td align="center">UserName</td>
						<!--<td align="center">Indirizzo</td>-->
						<td align="center">Tel1</td>
						<td align="center">Cell</td>
						<td align="center">E-Mail</td>
						<td align="center">Carica</td>
						<td align="center">Tipo Socio</td>
						<td align="center">Cauzione</td>
						<?php if($_GET['list']==4)
						{
							for ($i = 2007; $i <= date("Y"); $i++)
								{
									echo "						<td align=\"center\">".$i."</td>";
								}
						}
?>						
						<td align="center">Modifica</td>
						<td align="center">Elimina</td>
						<td align="center">Approva</td>
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
							echo "<tr>\n\t<td colspan=\"". (date("Y") - 2007 + 4 + 9) ."\">Nessun associato presente nel database</td>\n</tr>";
						else
						{
							while($db->next_record())
							{
								echo "<tr><td>".$db->record['cognome']."&nbsp;</td>\n						";
								echo "<td>".$db->record['nome']."&nbsp;</td>\n						";
								echo "<td>".$db->record['user']."&nbsp;</td>\n						";
								//echo "<td>".$db->record['via'].", ".$db->record['cap'].", ".$db->record['citta']." (".$db->record['prov'].")</td>\n						";
								echo "<td>".$db->record['tel1']."&nbsp;</td>\n						";
								echo "<td>".$db->record['cell']."&nbsp;</td>\n						";
								echo "<td>".$db->record['email']."&nbsp;</td>\n						";
								echo "<td>";
								switch ($db->record["carica"]) {
									case 'A': echo "Amministrazione";
											  break;
									case 'S': echo "Segreteria";
											  break;
									case 'C': echo "Capogita";
											  break;
									case 'VS': echo "Volontario Sede";
											  break;
									case 'VG': echo "Volontario Giornalino";
											  break;
									case 'VG': echo "Volontario Altro";
											  break;
									case 'AS': echo "Associato";
											  break;
									default: echo "Non specificata";
											  break;
								}
								echo "&nbsp;</td>\n						";
								echo "<td>";
								switch ($db->record["tiposocio"]) {
									case 'SO': echo "Ordinario";
											  break;
									case 'SS': echo "Sostenitore";
											  break;
									case 'SW': echo "Web";
											  break;
									case 'SJ': echo "Junior";
											  break;
									case 'SG': echo "Giovane";
											  break;
									case 'SF': echo "Famiglia";
											  break;
									case 'AB': echo "Amico della bicicletta";
											  break;
									case 'FA': 
											  $db2 = new db_local();
											  $db2->query("SELECT cognome,nome FROM anagrafiche WHERE tiposocio = 'SF' AND id = ".$db->record["idcapo"]." LIMIT 1;",true);
											  $db2->next_record();
											  echo "Convivente di ".$db2->record['cognome']." ".$db2->record['nome'];
											  $db2->close();
											  unset($db2);
											  break;
									default : echo $db->record["tiposocio"];
											  break;
								}
								echo "&nbsp;</td>\n						";
								echo "<td>".$db->record['cauzione']."&nbsp;</td>\n						";
								if($_GET['list']==4)
										{
											for ($i = 2007; $i <= date("Y"); $i++)
												{
													echo "<td>".$db->record['a'.$i]."&nbsp;</td>\n						";
												}
										}
								echo "<td><a href=\"admin.php?fun=modass&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
								echo "<td><a href=\"\" onclick=\"javascript: eliminaass('".$db->record['id']."'); return false; \">Elimina</a></td>\n						";
								if($db->record['approvato'] == '1')
								$str = 'Approvato';
								else
								$str = 'Non approvato';
								echo "<td><a href=\"\" id=\"linkapp".$i++."\" onclick=\"approvaass(".$db->record['id'].",'linkapp".($i-1)."'); return false;\">".$str."</a></td>\n						";
							}
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}

	function newass()
	{
		$save = $_GET['save'];
		if(!$save)
		{
			/*echo "<script>alert(\"L'inserimento degli associati non e' disponibile 1\"); ricresp();</script>";
			makeTail();
			exit;*/
			include("lib/html/newass.php");
			
		}
		else
		{
			/*echo "<script>alert(\"L'inserimento degli associati non e' disponibile 2\"); window.close();</script>";
			makeTail();
			exit;*/
			$query = " ";
			$this->settadatiass(&$query,null,&$sendmail);
			//echo "<div>".$query."</div>";
			$db = new db_local();
			if (!$db->query($query))
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'inserimento dell'associato.(ERRORE da indicare al WebMaster: \"newass\" - Query inserimento FALSA)</h2></div>";
			else
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Inserimento dell'associato avvenuto con successo.</h2></div>";
			if(is_array($sendmail))
			{
				if($sendmail['email'] != "")
				{
					if(!mail($sendmail['email'], "Bici&Dintorni, dati di accesso alle iscrizioni online.", "Salve ".$sendmail['cognome']." ".$sendmail['nome']."\n".
							"di seguito i dati per poter accedere al nostro sito:\n".
							"nomeutente: ".$sendmail['user']."\n".
							"password: ".$sendmail['password']."\n\n".
							"Cordiali saluti, Bici&Dintorni",
							"From: WebMaster Bici&Dintorni <webmaster@biciedintorni.it>\r\n" .
							"Reply-To: <webmaster@biciedintorni.it>\r\n" .
							"X-Mailer: Mailer/Bici&Dintorni\r\n"))
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'invio dell'email all'associato.(ERRORE da indicare al WebMaster: \"newass\" - function mail return false)</h2></div>";
					else
						echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Dati associato inviati tramite email.</h2></div>";
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Impossibile inviare l'email all'associato, il campo dell'email risulta vuoto.</h2></div>";
				}
			}
			$db->close();
			unset($db);
			return;
		}
	}

	function settadatiass(&$query,$addrfile, $passmail)
	// modificata il 18/12/2016 per eliminare la funzione htmlentities()
	{
		if(get_magic_quotes_gpc() == 1)
		{
			//$cognome = htmlentities($_POST['cognome']);
			$nome = ($_POST['nome']);
			$cognome = ($_POST['cognome']);
			$user = ($_POST['username']);
			$sesso = ($_POST['sesso']);
			$via = ($_POST['indirizzo']);
			$cap = ($_POST['cap']);
			$citta = ($_POST['citta']);
			$prov = ($_POST['prov']);
			$tel1 = ($_POST['tel1']);
			$tel2 = ($_POST['tel2']);
			$cell = ($_POST['cell']);
			$email = ($_POST['email']);
			$carica = ($_POST['carica']);
			$saldo = ($_POST['saldo']);
			$tiposocio = ($_POST['tiposocio']);
			$cauzione = ($_POST['cauzione']);
			$note = ($_POST['note']);
		}
		else
		{
			//$cognome = addslashes(htmlentities($_POST['cognome']));
			$nome = addslashes($_POST['nome']);
			$cognome = addslashes($_POST['cognome']);
			$user = addslashes($_POST['username']);
			$sesso = addslashes($_POST['sesso']);
			$via = addslashes($_POST['indirizzo']);
			$cap = addslashes($_POST['cap']);
			$citta = addslashes($_POST['citta']);
			$prov = addslashes($_POST['prov']);
			$tel1 = addslashes($_POST['tel1']);
			$tel2 = addslashes($_POST['tel2']);
			$cell = addslashes($_POST['cell']);
			$email = addslashes($_POST['email']);
			$carica = addslashes($_POST['carica']);
			$saldo = addslashes($_POST['saldo']);
			$tiposocio = addslashes($_POST['tiposocio']);
			$cauzione = addslashes($_POST['cauzione']);
			$note = addslashes($_POST['note']);
		}
		if($tiposocio == 'FA')
			$idcapo = intval($_POST['idcapo']);
		else 
			$idcapo = 0;
		$pw = $_POST['password'];
		$passmail = null;
		$email = trim($email);
		if($_POST['passmail'] == 1)
		{
			$passmail = array();
			$passmail['email'] = $email;
			$passmail['nome'] = $nome;
			$passmail['cognome'] = $cognome;
			$passmail['user'] = $user;
			$passmail['password'] = $pw;
		}
		$pass = md5($pw);
		$passch = "0";
		$emailinv = "0";
		$idcreat = $this->matricola;
		//echo "<br>\n".intval($_POST['giornonasc'])."/".intval($_POST['mesenasc'])."/".intval($_POST['annonasc'])."\n<br>";
		$giornonasc = intval($_POST['giornonasc']);
		$mesenasc = intval($_POST['mesenasc']);
		$annonasc = intval($_POST['annonasc']);
		
		$giornoisc = intval($_POST['giornoisc']);
		$meseisc = intval($_POST['meseisc']);
		$annoisc = intval($_POST['annoisc']);
		
		$a2007 = intval($_POST['a2007']);
		$a2008 = intval($_POST['a2008']);
		$a2009 = intval($_POST['a2009']);
		$a2010 = intval($_POST['a2010']);
		$a2011 = intval($_POST['a2011']);
		$a2012 = intval($_POST['a2012']);
		$a2013 = intval($_POST['a2013']);
		$a2014 = intval($_POST['a2014']);
		$a2015 = intval($_POST['a2015']);
		$a2016 = intval($_POST['a2016']);
		$a2017 = intval($_POST['a2017']);
		$a2018 = intval($_POST['a2018']);
		$a2019 = intval($_POST['a2019']);
		$a2020 = intval($_POST['a2020']);
		$dataiscrizione = $annoisc."-".$meseisc."-".$giornoisc;
		$datanascita = $annonasc."-".$mesenasc."-".$giornonasc;
		$approvato = intval($_POST['approvato']);
		$id = $_POST['matricola'];
		if($_GET['fun'] == 'newass')
			$query = "INSERT INTO anagrafiche (nome,cognome,user,pass,pw,sesso,passch,via,cap,citta,
				prov,datanascita,tel1,tel2,cell,email,emailinv,carica,saldo,approvato,dataiscrizione,
				tiposocio,cauzione,note,idcreat,idcapo,a2007,a2008,a2009,a2010,a2011,a2012,a2013,a2014,
				a2015,a2016,a2017,a2018,a2019,a2020) VALUES ('".$nome."','".$cognome."','".$user."',
			'".$pass."','".$pw."','".$sesso."','".$passch."','".$via."','".$cap."','".$citta."','".$prov."',
					'".$datanascita."','".$tel1."','".$tel2."','".$cell."','".$email."','".$emailinv."',
					'".$carica."','".$saldo."','".$approvato."','".$dataiscrizione."','".$tiposocio."',
					'".$cauzione."','".$note."','".$idcreat."','".$idcapo."','".$a2007."','".$a2008."',
					'".$a2009."','".$a2010."','".$a2011."','".$a2012."','".$a2013."','".$a2014."','".$a2015."',
						'".$a2016."','".$a2017."','".$a2018."','".$a2019."','".$a2020."');";
		else
			$query = "UPDATE anagrafiche SET ".
			"nome = '".$nome."',".
			"cognome = '".$cognome."',".
			"user = '".$user."',".
			"pass = '".$pass."',".
			"pw = '".$pw."',".
			"sesso = '".$sesso."',".
			"passch = '".$passch."',".
			"via = '".$via."',".
			"cap = '".$cap."',".
			"citta = '".$citta."',".
			"prov = '".$prov."',".
			"datanascita = '".$datanascita."',".
			"tel1 = '".$tel1."',".
			"tel2 = '".$tel2."',".
			"cell = '".$cell."',".
			"email = '".$email."',".
			"emailinv = '".$emailinv."',".
			"carica = '".$carica."',".
			"saldo = '".$saldo."',".
			"approvato = '".$approvato."',".
			"dataiscrizione = '".$dataiscrizione."',".
			"tiposocio = '".$tiposocio."',".
			"cauzione = '".$cauzione."',".
			"note = '".$note."',".
			"idcreat = '".$idcreat."',".
			"idcapo = '".$idcapo."',".
			"a2007 = '".$a2007."',".
			"a2008 = '".$a2008."',".
			"a2009 = '".$a2009."',".
			"a2010 = '".$a2010."',".
			"a2011 = '".$a2011."',".
			"a2012 = '".$a2012."',".
			"a2013 = '".$a2013."',".
			"a2014 = '".$a2014."',".
			"a2015 = '".$a2015."',".
			"a2016 = '".$a2016."',".
			"a2017 = '".$a2017."',".
			"a2018 = '".$a2018."',".
			"a2019 = '".$a2019."',".
			"a2020 = '".$a2020."' WHERE id = ".$id." LIMIT 1";
	}
	
	function newcartina()
	{
		$save = $_GET['save'];
		if(!$save)
		{
			include("lib/html/newcartina.php");	
		}
		else
		{
			$query = " ";
			$this->settadaticartina(&$query);
			//echo "<div>".$query."</div>";
			$db = new db_local();
			if (!$db->query($query))
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'inserimento della cartina.(ERRORE da indicare al WebMaster: \"newcartina\" - Query inserimento FALSA)</h2></div>";
			else
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Inserimento della cartina avvenuta con successo.</h2></div>";
			$db->close();
			unset($db);
			return;
		}
	}
	
	function modcartina()
	{
		$id = $_GET['id'];
		if(is_numeric($id))
		{
			//return;
			include_once("lib/db_mysql.php");
			$db = new db_local();
			//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
			if($db->query("SELECT * FROM cartine WHERE id = '".$id."' LIMIT 1;"))
			{
				if($db->next_record())
					include("lib/html/modcartina.php");
				else
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica della cartina. (nessuna cartina con questo ID)</div>";						
			}
			else
				echo "Errore modcartina, query falsa.";
			$db->close();
			unset($db);
			//echo "<script>alert('miiiiiii id num')</script>";
			
		}
		elseif ($_GET['save'] == 1)
		{	
			$db = new db_local();
			$db->query("SELECT * from cartine WHERE id = '".$_POST['id']."' LIMIT 1;",true);
			if(!$db->next_record())
			{
				mail("webmaster@biciedintorni.it","Errore modifica di una cartina, Applicazione Bici&Dintorni.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare una cartina che non ha un id corrispondente nel database.\n".
				"-----\nFile: user.php\nRoutine: modcartina (Salvataggio).\n-----\nID cartina: ".$_POST['id']."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pw);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica della cartina. (modifica cartina, nessun id)</div>";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			$this->settadaticartina(&$query);
			//echo "<br>".$query."<br>";
			//echo "<script>alert('miiiiiii ok')</script>";
			//exit;
			if($db->query($query))
			{
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica della cartina avvenuta con successo.</div>";
			}
			else
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica della cartina. (modcartina, query falsa)</div>";
			$db->close();
			unset($db);			
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listcartine();
		}
	}
	
	function settadaticartina($query = null)
	{
		if(get_magic_quotes_gpc() == 1)
		{
			$titolo = htmlentities($_POST['titolo']);
			$sottotitolo = htmlentities($_POST['sottotitolo']);
			$autore = htmlentities($_POST['autore']);
			$editore = htmlentities($_POST['editore']);
			$citta = htmlentities($_POST['citta']);
			$anno = htmlentities($_POST['anno']);
			$lingua = htmlentities($_POST['lingua']);
			$note = htmlentities($_POST['note']);
			$costo = htmlentities($_POST['costo']);
			$scaffale = htmlentities($_POST['scaffale']);
			$classificazione = htmlentities($_POST['classificazione']);
			$descrizione = htmlentities($_POST['descrizione']);
			$idnazione = htmlentities($_POST['idnazione']);
			$scala = htmlentities($_POST['scala']);
		}
		else
		{
			$titolo = addslashes(htmlentities($_POST['titolo']));
			$sottotitolo = addslashes(htmlentities($_POST['sottotitolo']));
			$autore = addslashes(htmlentities($_POST['autore']));
			$editore = addslashes(htmlentities($_POST['editore']));
			$citta = addslashes(htmlentities($_POST['citta']));
			$anno = addslashes(htmlentities($_POST['anno']));
			$lingua = addslashes(htmlentities($_POST['lingua']));
			$note = addslashes(htmlentities($_POST['note']));
			$costo = addslashes(htmlentities($_POST['costo']));
			$scaffale = addslashes(htmlentities($_POST['scaffale']));
			$classificazione = addslashes(htmlentities($_POST['classificazione']));
			$descrizione = addslashes(htmlentities($_POST['descrizione']));
			$idnazione = addslashes(htmlentities($_POST['idnazione']));
			$scala = addslashes(htmlentities($_POST['scala']));
		}
		
		if($_GET['fun'] == 'newcartina')
		{
			$query = "INSERT INTO cartine (titolo,sottotitolo,autore,editore,citta,anno,lingua,note,costo,scaffale,classificazione,descrizione,idnazione,scala) VALUES ('".$titolo."','".$sottotitolo."','".$autore."','".$editore."','".$citta."','".$anno."','".$lingua."','".$note."','".$costo."','".$scaffale."','".$classificazione."','".$descrizione."','".$idnazione."','".$scala."');";
		}
		else
		{
			$id = $_POST['id'];
			$query = "UPDATE cartine SET ".
			"titolo = '".$titolo."',".
			"sottotitolo = '".$sottotitolo."',".
			"autore = '".$autore."',".
			"editore = '".$editore."',".
			"citta = '".$citta."',".
			"anno = '".$anno."',".
			"lingua = '".$lingua."',".
			"note = '".$note."',".
			"costo = '".$costo."',".
			"scaffale = '".$scaffale."',".
			"classificazione = '".$classificazione."',".
			"descrizione = '".$descrizione."',".
			"idnazione = '".$idnazione."',".
			"scala = '".$scala."'".
			" WHERE id = ".$id." LIMIT 1";
		}
	}
	
	function listcartine()
	{
		$db = new db_local();
		$ordertype= " ASC";
		if ($_GET['type'] == "DESC")
				$ordertype= " DESC";
				
		$order = " ORDER BY classificazione" . $ordertype;
		if ($_GET['order'] == "titolo")
			$order = " ORDER BY titolo" . $ordertype;
		elseif ($_GET['order'] == "autore")
			$order = " ORDER BY autore" . $ordertype;
			elseif ($_GET['order'] == "citta")
				$order = " ORDER BY citta" . $ordertype;
				elseif ($_GET['order'] == "anno")
					$order = " ORDER BY anno" . $ordertype;
					elseif ($_GET['order'] == "scala")
						$order = " ORDER BY scala" . $ordertype;
						elseif ($_GET['order'] == "lingua")
							$order = " ORDER BY lingua" . $ordertype;
							elseif ($_GET['order'] == "scaffale")
								$order = " ORDER BY scaffale" . $ordertype;
								elseif ($_GET['order'] == "descrizione")
									$order = " ORDER BY descrizione" . $ordertype;
									elseif ($_GET['order'] == "nazione")
										$order = " ORDER BY nazioni.nome" . $ordertype;
		
			$sqlqry = "SELECT cartine.*,nazioni.nome as nazione FROM cartine,nazioni WHERE nazioni.id = idnazione".$order.";";
			
		if ($_GET['type'] == "DESC")
			$ordertype= "ASC";
		else
			$ordertype= "DESC";
		if($db->query($sqlqry,true))
		{ ?>
			<table style="width:900px;" align="center" border="1">
				<tbody>
					<tr>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=titolo&amp;type=".$ordertype; ?>">Titolo</a></td>
						<!-- <td align="center">Sottotitolo</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=autore&amp;type=".$ordertype; ?>">Autore</a></td>
						<!-- <td align="center">Editore</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=citta&amp;type=".$ordertype; ?>">Citt&agrave;</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=anno&amp;type=".$ordertype; ?>">Anno</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=lingua&amp;type=".$ordertype; ?>">Lingua</a></td>
						<!-- <td align="center">Note</td>
						<td align="center">Costo</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=scaffale&amp;type=".$ordertype; ?>">Scaffale</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=class&amp;type=".$ordertype; ?>">Classificazione</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=descrizione&amp;type=".$ordertype; ?>">Descrizione</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=scala&amp;type=".$ordertype; ?>">Scala</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modcartina&amp;order=nazione&amp;type=".$ordertype; ?>">Nazione</a></td>
						<td align="center">Modifica</td>
						<td align="center">Elimina</td>
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
							echo "<tr>\n\t<td colspan=\"17\">Nessuna cartina presente nel database</td>\n</tr>";
						else
						{
							while($db->next_record())
							{
								echo "<tr><td>".$db->record['titolo']."&nbsp;</td>\n						";
								echo "<td>".$db->record['autore']."&nbsp;</td>\n						";
								echo "<td>".$db->record['citta']."&nbsp;</td>\n						";
								echo "<td>".$db->record['anno']."&nbsp;</td>\n						";
								echo "<td>".$db->record['lingua']."&nbsp;</td>\n						";
								echo "<td>".$db->record['scaffale']."&nbsp;</td>\n						";
								echo "<td>".$db->record['classificazione']."&nbsp;</td>\n						";
								echo "<td>".$db->record['descrizione']."&nbsp;</td>\n						";
								echo "<td>".$db->record['scala']."&nbsp;</td>\n						";
								echo "<td>".$db->record['nazione']."&nbsp;</td>\n						";
								echo "<td><a href=\"admin.php?fun=modcartina&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
								echo "<td><a href=\"\" onclick=\"javascript: eliminacartina(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
							}
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}
	
	function delcartina($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM cartine WHERE id = ".$id." LIMIT 1 ;"))
			{
				echo "Cartina eliminata correttamente.";
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "delcartina (eliminazione cartina), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
			$vartest = "nessun id specificato.";

		mail("webmaster@biciedintorni.it","Errore eliminazione cartina Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare una cartina ma non ci è riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}
	
	function prestitilibro() {
		// richiamo della funzione senza id specifico, per visualizzare l'elenco dei prestiti in corso
		$handle = curl_init("http://www.biciedintorni.it/application/lista_libri_in_prestito.php");
		curl_exec($handle);
		
	}
	
	
	function newlibro()
	{
		$save = $_GET['save'];
		if(!$save)
		{
			include("lib/html/newlibro.php");	
		}
		else
		{
			$query = " ";
			$this->settadatilibro(&$query);
			//echo "<div>".$query."</div>";
			$db = new db_local();
			if (!$db->query($query))
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'inserimento del libro.(ERRORE da indicare al WebMaster: \"newlibro\" - Query inserimento FALSA)</h2></div>";
			else
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Inserimento del libro avvenuto con successo.</h2></div>";
			$db->close();
			unset($db);
			return;
		}
	}
	
	function modlibro()
	{
		$id = $_GET['id'];
		if(is_numeric($id))
		{
			//return;
			include_once("lib/db_mysql.php");
			$db = new db_local();
			//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
			if($db->query("SELECT * FROM libri WHERE id = '".$id."' LIMIT 1;"))
			{
				if($db->next_record())
					include("lib/html/modlibro.php");
				else
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica del libro. (nessun libro con questo ID)</div>";						
			}
			else
				echo "Errore modlibro, query falsa.";
			$db->close();
			unset($db);
			//echo "<script>alert('miiiiiii id num')</script>";
			
		}
		elseif ($_GET['save'] == 1)
		{	
			$db = new db_local();
			$db->query("SELECT * from libri WHERE id = '".$_POST['id']."' LIMIT 1;",true);
			if(!$db->next_record())
			{
				mail("dibella.antonino@gmail.com","Errore modifica di un libro, Applicazione Bici&Dintorni.",
				"Ciao Antonino,\n".
				"qualcuno sta cercando di modificare un libro che non ha un id corrispondente nel database.\n".
				"-----\nFile: user.php\nRoutine: modlibro (Salvataggio).\n-----\nID libro: ".$_POST['id']."\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pw);
				echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica del libro. (modifica libro, nessun id)</div>";
				$db->close();
				unset($db);
				makeTail();
				exit;
			}
			$this->settadatilibro(&$query);
			//echo "<br>".$query."<br>";
			//echo "<script>alert('miiiiiii ok')</script>";
			//exit;
			if($db->query($query))
			{
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica del libro avvenuta con successo.</div>";
			}
			else
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica del libro. (modlibro, query falsa)</div>";
			$db->close();
			unset($db);			
			$this->listlibri();
		}
		else
		{
			//echo "<script>alert('miiiiiii listagite ".$_POST['invio']."')</script>";
			$this->listlibri();
		}
	}
	
	function settadatilibro($query = null)
	// modificata il 14/4/2016 per eliminare la call htmlentities()
	{
		if(get_magic_quotes_gpc() == 1)
		{
			//$titolo = htmlentities($_POST['titolo']);
			$titolo = $_POST['titolo'];
			$sottotitolo = $_POST['sottotitolo'];
			$autore = $_POST['autore'];
			$editore = $_POST['editore'];
			$citta = $_POST['citta'];
			$anno = $_POST['anno'];
			$pagine = $_POST['pagine'];
			$lingua = $_POST['lingua'];
			$note = $_POST['note'];
			$costo = $_POST['costo'];
			$scaffale = $_POST['scaffale'];
			$classificazione = $_POST['classificazione'];
			$descrizione = $_POST['descrizione'];
			$idnazione = $_POST['idnazione'];
			$idarg = $_POST['idarg'];
		}
		else
		{
			//$titolo = addslashes(htmlentities($_POST['titolo']));
			$titolo = addslashes($_POST['titolo']);
			$sottotitolo = addslashes($_POST['sottotitolo']);
			$autore = addslashes($_POST['autore']);
			$editore = addslashes($_POST['editore']);
			$citta = addslashes($_POST['citta']);
			$anno = addslashes($_POST['anno']);
			$pagine = addslashes($_POST['pagine']);
			$lingua = addslashes($_POST['lingua']);
			$note = addslashes($_POST['note']);
			$costo = addslashes($_POST['costo']);
			$scaffale = addslashes($_POST['scaffale']);
			$classificazione = addslashes($_POST['classificazione']);
			$descrizione = addslashes($_POST['descrizione']);
			//$descrizione = addslashes(htmlentities($_POST['descrizione']));
			$idnazione = addslashes($_POST['idnazione']);
			$idarg = addslashes($_POST['idarg']);
		}
		
		if($_GET['fun'] == 'newlibro')
		{
			$query = "INSERT INTO libri (titolo,sottotitolo,autore,editore,citta,anno,pagine,lingua,note,costo,scaffale,classificazione,descrizione,idnazione,idarg) VALUES ('".$titolo."','".$sottotitolo."','".$autore."','".$editore."','".$citta."','".$anno."','".$pagine."','".$lingua."','".$note."','".$costo."','".$scaffale."','".$classificazione."','".$descrizione."','".$idnazione."','".$idarg."');";
		}
		else
		{
			$id = $_POST['id'];
			$query = "UPDATE libri SET ".
			"titolo = '".$titolo."',".
			"sottotitolo = '".$sottotitolo."',".
			"autore = '".$autore."',".
			"editore = '".$editore."',".
			"citta = '".$citta."',".
			"anno = '".$anno."',".
			"pagine = '".$pagine."',".
			"lingua = '".$lingua."',".
			"note = '".$note."',".
			"costo = '".$costo."',".
			"scaffale = '".$scaffale."',".
			"classificazione = '".$classificazione."',".
			"descrizione = '".$descrizione."',".
			"idnazione = '".$idnazione."',".
			"idarg = '".$idarg."'".
			" WHERE id = ".$id." LIMIT 1";
		}
	}
	
	function listlibri()
	{
		$db = new db_local();
		$ordertype= " DESC";
		if ($_GET['type'] == "ASC")
				$ordertype= " ASC";
				
		$order = " ORDER BY id" . $ordertype;
		if ($_GET['order'] == "titolo")
			$order = " ORDER BY titolo" . $ordertype;
		elseif ($_GET['order'] == "autore")
			$order = " ORDER BY autore" . $ordertype;
			elseif ($_GET['order'] == "citta")
				$order = " ORDER BY citta" . $ordertype;
				elseif ($_GET['order'] == "anno")
					$order = " ORDER BY anno" . $ordertype;
					elseif ($_GET['order'] == "pagine")
						$order = " ORDER BY pagine" . $ordertype;
						elseif ($_GET['order'] == "lingua")
							$order = " ORDER BY lingua" . $ordertype;
							elseif ($_GET['order'] == "scaffale")
								$order = " ORDER BY scaffale" . $ordertype;
								elseif ($_GET['order'] == "descrizione")
									$order = " ORDER BY descrizione" . $ordertype;
									elseif ($_GET['order'] == "argomento")
										$order = " ORDER BY argomenti.nome" . $ordertype;
										elseif ($_GET['order'] == "nazione")
											$order = " ORDER BY nazioni.nome" . $ordertype;
											elseif ($_GET['order'] == "editore")
											$order = " ORDER BY editore" . $ordertype;
												elseif ($_GET['order'] == "classificazione")
												$order = " ORDER BY classificazione" . $ordertype;
		
			$sqlqry = "SELECT libri.*,argomenti.nome as argomento,nazioni.nome as nazione FROM libri,argomenti,nazioni WHERE argomenti.id = idarg AND nazioni.id = idnazione".$order.";";
		//$sqlqry = "SELECT * FROM anagrafiche WHERE carica != 'NS' ORDER BY cognome ASC,nome ASC,a".date("Y")." DESC;";
		
		
		/*
if(is_numeric($_GET['list']))
		{
			if($_GET['list']==1)
			{
				$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=1 AND a".(date("Y") - 1)."=1 AND a".date("Y")."=0 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
			}elseif($_GET['list']==2)
				{
					$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=1 AND a".(date("Y") - 1)."=1 OR a".date("Y")."=1 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
				}elseif($_GET['list']==3)
					{
						$sqlqry = "SELECT * FROM anagrafiche WHERE approvato=0 AND a".date("Y")."=1 AND carica != 'NS' AND id !=0 ORDER BY cognome,nome;";
					}
		} */
		
		if ($_GET['type'] == "DESC")
			$ordertype= "ASC";
		else
			$ordertype= "DESC";
		if($db->query($sqlqry,true))
		{ ?>
		<h2 align="center">FIAB Torino Bici e Dintorni - Elenco libri biblioteca</h2>

			<table style="width:900px;" align="center" border="1">
				<tbody>
					<tr>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=classificazione&amp;type=".$ordertype; ?>">Classificazione</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=id&amp;type=".$ordertype; ?>">Id</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=titolo&amp;type=".$ordertype; ?>">Titolo</a></td>
						<!-- <td align="center">Sottotitolo</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=autore&amp;type=".$ordertype; ?>">Autore</a></td>
						<!-- <td align="center">Editore</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=anno&amp;type=".$ordertype; ?>">Anno</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=descrizione&amp;type=".$ordertype; ?>">Descrizione</a></td>
						<td align="center">Prestiti</td>
						<td align="center">Elimina</td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=argomento&amp;type=".$ordertype; ?>">Argomento</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=nazione&amp;type=".$ordertype; ?>">Nazione</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=editore&amp;type=".$ordertype; ?>">Editore</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=citta&amp;type=".$ordertype; ?>">Citt&agrave;</a></td>
						
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=pagine&amp;type=".$ordertype; ?>">Pagine</a></td>
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=lingua&amp;type=".$ordertype; ?>">Lingua</a></td>
						<!-- <td align="center">Note</td>
						<td align="center">Costo</td> -->
						<td align="center"><a href="<?php echo $_SERVER["PHP_SELF"]."?fun=modlibro&amp;order=scaffale&amp;type=".$ordertype; ?>">Scaffale</a></td>
						
						
						
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
							echo "<tr>\n\t<td colspan=\"17\">Nessun libro presente nel database</td>\n</tr>";
						else
						{
							while($db->next_record())
							{
								//echo "<tr><td colspan=\"17\"><pre>".print_r($db->record)."</pre></td></tr>";
								echo "<tr><td>".$db->record['classificazione']."&nbsp;</td>\n						";
								echo "<td>".$db->record['id']."&nbsp;</td>\n						";
								echo "<td><a href=\"admin.php?fun=modlibro&amp;id=".$db->record['id']."\">".$db->record['titolo']."&nbsp;</a></td>\n						";
								//echo "<td>".$db->record['sottotitolo']."&nbsp;</td>\n						";
								echo "<td>".$db->record['autore']."&nbsp;</td>\n	";
								echo "<td>".$db->record['anno']."&nbsp;</td>\n	";
								echo "<td>".$db->record['descrizione']."&nbsp;</td>\n						";
								echo "<td><a href=\"prestitilibro.php?id=".$db->record['id']."\">Prestiti</a></td>\n						";
								echo "<td><a href=\"\" onclick=\"javascript: eliminalibro(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
								echo "<td>".$db->record['argomento']."&nbsp;</td>\n						";
								echo "<td>".$db->record['nazione']."&nbsp;</td>\n						";
								
								echo "<td>".$db->record['editore']."&nbsp;</td>\n						";
								echo "<td>".$db->record['citta']."&nbsp;</td>\n						";
								
								echo "<td>".$db->record['pagine']."&nbsp;</td>\n						";
								echo "<td>".$db->record['lingua']."&nbsp;</td>\n						";
								//echo "<td>".$db->record['note']."&nbsp;</td>\n						";
								//echo "<td>".$db->record['costo']."&nbsp;</td>\n						";
								echo "<td>".$db->record['scaffale']."&nbsp;</td>\n						";
								echo "<td>".$db->record['classificazione']."&nbsp;</td>\n						";
								
								
							}
						}
						?>
				</tbody>
			</table>
				
	<?php	}
	$db->close();
	unset($db);
	}
	
	function dellibro($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM libri WHERE id = ".$id." LIMIT 1 ;"))
			{
				echo "Libro eliminato correttamente.";
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "dellibro (eliminazione libro), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
			$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione libro Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare un libro ma non ci è riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}
	
	function mailcollettive()
	{
		//echo "RICHIAMATA FUN MAIL COLLETTIVE";
		include("lib/html/menumailcollettive.php");
		makeTail();
		exit;
	}
	
	function newmail()
	{		
			if($_POST['invio'] == 1)
			{
				if(get_magic_quotes_gpc() == 1)
				{
					$oggetto = htmlentities($_POST['oggetto']);
					$corpo = $_POST['corpo'];
				}
				else
				{
					$oggetto = addslashes(htmlentities($_POST['oggetto']));
					$corpo = addslashes($_POST['corpo']);
				}
				$giorno = intval($_POST['giorno']);
				$mese = intval($_POST['mese']);
				$anno = intval($_POST['anno']);
				$orario = explode('/:/', $_POST['ora']);
				$ora = intval($orario[0]);
				$minuti = intval($orario[1]);
				$idgruppo = intval($_POST['gruppo']);
				include_once("lib/db_mysql.php");
				$db = new db_local();
				$db->query("SELECT * from email WHERE giorno = ".$giorno." and mese = ".$mese." and anno = ".$anno." and ora >= ".($ora - 1)." and ora <= ".($ora + 1)." ;");
				if($db->next_record())
				{
					echo "<div align=\"center\" style=\"color: #FF0000\">Errore nel salvataggio dell'e-mail. E' gi&agrave; presente un 'email nell'arco di un'ora</div>";
					$db->close();
					unset($db);
					return;
				}
				$query = "INSERT INTO email (oggetto,corpo,giorno,mese,anno,ora,minuti,idgruppo) VALUES ('".$oggetto."','".$corpo."',".$giorno.",".$mese.",".$anno.",".$ora.",".$minuti.",".$idgruppo.");";
				if($db->query($query))
				{
					echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Salvataggio e-mail avvenuto con successo.</div>";
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nel salvataggio dell'e-mail. (newmail, query falsa)</div>";
				}
				$db->close();
				unset($db);
			}
			else
			{
				include_once("lib/db_mysql.php");	
				$db = new db_local();
				$db->query("SELECT * FROM gruppimail;");
				if($db->num_rows() > 0)
				{
					include("lib/html/newmail.php");
				}
				else
				{
					echo "<div id=\"title\" align=\"center\"><h2>Devi definire almeno un gruppo di utenti per creare una E-Mail.</h2></div>";
				}
			}
	}
	
	function modmail()
	{
			$id = $_GET['id'];
			if(is_numeric($id))
			{
				//return;
				include_once("lib/db_mysql.php");
				$db = new db_local();
				if($db->query("select * from email WHERE id = ".$id." ;"))
				{
					if($db->next_record())
						include("lib/html/modmail.php");
					else
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'e-mail. (nessuna email con questo ID)</div>";						
				}
				else
					echo "Errore modmail, query falsa.";
				$db->close();
				unset($db);
				
			}
			elseif ($_GET['save'] == 1)
			{	
				$db = new db_local();
				$db->query("SELECT * from email WHERE id = '".$_POST['id']."' LIMIT 1;",true);
				if(!$db->next_record())
				{
					mail("dibella.antonino@gmail.com","Errore modifica di una email, Applicazione Bici&Dintorni.",
					"Ciao Antonino,\n".
					"qualcuno sta cercando di modificare una e-mail che non ha un id corrispondente nel database.\n".
					"-----\nFile: user.php\nRoutine: modmail (Salvataggio).\n-----\nID gruppo: ".$_POST['id']."\n".
					"nomeutente: ".$this->user." \n".
					"password: ".$this->pw);
					echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica dell'e-mail. (modifica email, nessun id)</div>";
					$db->close();
					unset($db);
					makeTail();
					exit;
				}
				if(get_magic_quotes_gpc() == 1)
				{
					$oggetto = htmlentities($_POST['oggetto']);
					$corpo = $_POST['corpo'];
				}
				else
				{
					$oggetto = addslashes(htmlentities($_POST['oggetto']));
					$corpo = addslashes($_POST['corpo']);
				}
				$giorno = intval($_POST['giorno']);
				$mese = intval($_POST['mese']);
				$anno = intval($_POST['anno']);
				$orario = explode('/:/', $_POST['ora']);
				$ora = intval($orario[0]);
				$minuti = intval($orario[1]);
				$idgruppo = intval($_POST['gruppo']);
				include_once("lib/db_mysql.php");
				$db = new db_local();
				$db->query("SELECT * from email WHERE id <> ".$_POST['id']." and giorno = ".$giorno." and mese = ".$mese." and anno = ".$anno." and ora >= ".($ora - 1)." and ora <= ".($ora + 1)." ;");
				if($db->next_record())
				{
					echo "<div align=\"center\" style=\"color: #FF0000\">Errore nel salvataggio dell'e-mail. E' gi&agrave; presente un 'email nell'arco di un'ora</div>";
					$db->close();
					unset($db);
					return;
				}
				$query = "UPDATE email set 
				oggetto='".$oggetto."',
				corpo='".$corpo."',
				giorno=".$giorno.",
				mese=".$mese.",
				anno=".$anno.",
				ora=".$ora.",
				minuti=".$minuti.",
				idgruppo=".$idgruppo." WHERE id = ".$_POST['id']." LIMIT 1;";
				if($db->query($query))
				{
					echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Salvataggio e-mail avvenuto con successo.</div>";
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nel salvataggio dell'e-mail. (modmail, query falsa)</div>";
				}
				$db->close();
				unset($db);	
			}
			else
			{
				$this->listmail();
			}
	}
	
	function listmail()
	{
		$db = new db_local();
		/*$sqlqry = "select * from gruppimail inner join lnk_gruppi_soci on gruppimail.id = lnk_gruppi_soci.idgruppo";*/
		$sqlqry = "select email.*,gruppimail.nome from email inner join gruppimail on email.idgruppo = gruppimail.id ORDER BY email.anno DESC,email.mese DESC,email.giorno DESC,email.ora DESC,email.minuti DESC";
		if($db->query($sqlqry))
		{
		?>
			<br>
			<table style="width:900px;" align="center" border="1">
				<tbody>
					<tr class="title">
						<td align="center">Oggetto</td>
						<td align="center">Data e Ora</td>
						<td align="center">Gruppo di invio E-Mail</td>
						<td align="center">Modifica</td>
						<td align="center">Elimina</td>
					</tr>
					<?php
						$i = 0;
						if ($db->num_rows() == 0)
						{
							echo "<tr>\n\t<td colspan=\"4\">Nessuna E-Mail presente nel database</td>\n</tr>";
						}
						else
						{
							while($db->next_record())
							{
								echo "<tr>";
								echo "<td>".$db->record['oggetto']."&nbsp;</td>\n						";
								echo "<td>".sprintf("%02d", $db->record['giorno'])."/".sprintf("%02d", $db->record['mese'])."/".sprintf("%02d", $db->record['anno'])." ".sprintf("%02d", $db->record['ora']).":".sprintf("%02d", $db->record['minuti'])."&nbsp;</td>\n						";
								echo "<td>".$db->record['nome']."&nbsp;</td>\n						";
								echo "<td><a href=\"admin.php?fun=modmail&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
								echo "<td><a href=\"\" onclick=\"javascript: eliminaemail(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
								echo "</tr>";
							}
						}
						?>
				</tbody>
			</table>
			<br>
		<?php
		}
	}
	
	function delmail($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM email WHERE id = ".$id.";"))
			{
				echo "E-Mail eliminata correttamente.";
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "Errore eliminazione E-Mail - (delmail), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
			$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione E-email Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare un E-Mail ma non ci � riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}

	function newgruppo()
	{
			$id = $_GET['id'];
			if($_POST['invio'] == 1)
			{
				if(get_magic_quotes_gpc() == 1)
				{
					$nome = htmlentities($_POST['nome']);
					$descrizione = htmlentities($_POST['descri']);
				}
				else
				{
					$nome = addslashes(htmlentities($_POST['nome']));
					$descrizione = addslashes(htmlentities($_POST['descri']));
				}
				include_once("lib/db_mysql.php");
				$db = new db_local();
				$query = "INSERT INTO gruppimail (nome,descrizione) VALUES ('".$nome."','".$descrizione."');";
				if($db->query($query))
				{
					$db->query("Select MAX(id) as idgruppo from gruppimail");
					if($db->next_record())
					{
						$query = "INSERT INTO lnk_gruppi_soci (idgruppo,idsocio) (Select '".$db->record['idgruppo']."' as idgruppo,ID from TMPSelezionati".$this->matricola.");";
						if($db->query($query))
						{
							echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Inserimento gruppo avvenuto con successo.</div>";
						}
					}
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica della cartina. (modcartina, query falsa)</div>";
				}
				
				$db->close();
				unset($db);
			}
			else
			{
				include("lib/html/newgruppo.php");
			}
	}
	
	function modgruppo()
	{
			$id = $_GET['id'];
			if(is_numeric($id))
			{
				//return;
				include_once("lib/db_mysql.php");
				$db = new db_local();
				/*$sqlqry = "select gruppimail.id,idsocio from gruppimail inner join lnk_gruppi_soci on gruppimail.id = lnk_gruppi_soci.idgruppo";*/
				if($db->query("select * from gruppimail WHERE id = ".$id." ;"))
				{
					if($db->next_record())
						include("lib/html/modgruppo.php");
					else
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica del gruppo. (nessun gruppo con questo ID)</div>";						
				}
				else
					echo "Errore modgruppo, query falsa.";
				$db->close();
				unset($db);
				
			}
			elseif ($_GET['save'] == 1)
			{	
				$db = new db_local();
				$db->query("SELECT * from gruppimail WHERE id = '".$_POST['id']."' LIMIT 1;",true);
				if(!$db->next_record())
				{
					mail("dibella.antonino@gmail.com","Errore modifica di un gruppo email, Applicazione Bici&Dintorni.",
					"Ciao Antonino,\n".
					"qualcuno sta cercando di modificare un gruppo che non ha un id corrispondente nel database.\n".
					"-----\nFile: user.php\nRoutine: modgruppo (Salvataggio).\n-----\nID gruppo: ".$_POST['id']."\n".
					"nomeutente: ".$this->user." \n".
					"password: ".$this->pw);
					echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica del gruppo. (modifica gruppo, nessun id)</div>";
					$db->close();
					unset($db);
					makeTail();
					exit;
				}
				if(get_magic_quotes_gpc() == 1)
				{
					$nome = htmlentities($_POST['nome']);
					$descrizione = htmlentities($_POST['descri']);
				}
				else
				{
					$nome = addslashes(htmlentities($_POST['nome']));
					$descrizione = addslashes(htmlentities($_POST['descri']));
				}
				$query = "UPDATE gruppimail set nome = '".$nome."', descrizione='".$descrizione."' WHERE id = ".$_POST['id']." ;";
				if($db->query($query))
				{
					$db->query("Delete from lnk_gruppi_soci where idgruppo = ".$_POST['id']." ;");
					$query = "INSERT INTO lnk_gruppi_soci (idgruppo,idsocio) (Select '".$_POST['id']."' as idgruppo,ID from TMPSelezionati".$this->matricola.");";
					if($db->query($query))
					{
						echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica gruppo avvenuta con successo.</div>";
					}
					else
					{
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica del gruppo. (modgruppo, query falsa)</div>";
					}
				}
				else
				{
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica del gruppo. (modgruppo, query falsa)</div>";
				}
				$db->close();
				unset($db);			
			}
			else
			{
				$this->listgruppi();
			}
	}
	
	function listgruppi()
	{
		$db = new db_local();
		/*$sqlqry = "select * from gruppimail inner join lnk_gruppi_soci on gruppimail.id = lnk_gruppi_soci.idgruppo";*/
		$sqlqry = "select * from gruppimail";
		if($db->query($sqlqry))
		{
		?>
			<br>
			<table style="width:900px;" align="center" border="1">
				<tbody>
					<tr class="title">
						<td align="center">Nome Gruppo</td>
						<td align="center">Descrizione</td>
						<td align="center">Modifica</td>
						<td align="center">Elimina</td>
					</tr>
					<?php
						$i = 0;
						if ($db->num_rows() == 0)
						{
							echo "<tr>\n\t<td colspan=\"4\">Nessun gruppo presente nel database</td>\n</tr>";
						}
						else
						{
							while($db->next_record())
							{
								echo "<tr>";
								echo "<td>".$db->record['nome']."&nbsp;</td>\n						";
								echo "<td>".$db->record['descrizione']."&nbsp;</td>\n						";
								echo "<td><a href=\"admin.php?fun=modgruppo&amp;id=".$db->record['id']."\">Modifica</a></td>\n						";
								echo "<td><a href=\"\" onclick=\"javascript: eliminagruppo(".$db->record['id']."); return false; \">Elimina</a></td>\n						";
								echo "</tr>";
							}
						}
						?>
				</tbody>
			</table>
			<br>
		<?php
		}
	}
	
	function delgruppo($id)
	{
		if(is_numeric($id))
		{
			include_once("lib/db_mysql.php");
			$db = new db_local();
			if($db->query("DELETE FROM lnk_gruppi_soci WHERE idgruppo = ".$id.";"))
			{
				if($db->query("DELETE FROM gruppimail WHERE id = ".$id.";"))
				echo "Gruppo eliminato correttamente.";
				$db->close();
				unset($db);
				return;
			}
			else
			{
				$vartest = "Errore eliminazione gruppo - (delgruppo), query falsa.";
				echo $vartest;
			}
			$db->close();
			unset($db);
		}
		else
			$vartest = "nessun id specificato.";

		mail("dibella.antonino@gmail.com","Errore eliminazione gruppo email Applicazione Bici&Dintorni.",
		"Ciao Antonino,\n".
		"qualcuno sta cercando di eliminare un gruppo ma non ci � riuscito.\n".
		"-----ERRORE-----\n".
		"$vartest".
		"----------------\n".
		"nomeutente: ".$this->user." \n".
		"password: ".$this->pw);
		return $vartest;
	}
	
	function menuprincipale()
	{
	
	}
}

class VolontarioSede extends Amministratore {
	function VolontarioSede($record = null)
	{
		$this->Amministratore($record);
		$this->menu = array_flip ($this->menu);
		unset($this->menu['approvazione']);
		unset($this->menu['appevento']);
		unset($this->menu['stat']);
		unset($this->menu['modgita']);
		unset($this->menu['newgita']);
		$this->menu = array_flip ($this->menu);
	}
}

class Segretaria extends Amministratore {
	function VolontarioSede($record = null)
	{
		$this->Amministratore($record);
		$this->menu = array_flip ($this->menu);
/*		unset($this->menu['approvazione']);
		unset($this->menu['appevento']);
		unset($this->menu['stat']);
		unset($this->menu['modgita']);
		unset($this->menu['newass']);*/
		$this->menu = array_flip ($this->menu);
	}
}
?>
