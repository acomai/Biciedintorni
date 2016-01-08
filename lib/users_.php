<?php 
	include_once("lib/db_mysql.php");
	include_once("lib/class.php");
	
	class Associato {
		var $matricola,$nome,$cognome,$user,$pass,$via,$datanascita;
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
				$this->datanascita = $record['datanascita'];
				$this->tel1 = $record['tel1'];
				$this->tel2 = $record['tel2'];
				$this->email = $record['email'];
				$this->carica = $record['carica'];
				$this->saldo = $record['saldo'];
				$this->approvato = $record['approvato'];
				$this->dataiscrizione = $record['dataiscrizione'];

				$this->menu = array("Le tue iscrizioni"=>"iscrizioni","Modifica dati personali"=>"moddati","Visualizza associati"=>"visass","Aggiungi un evento"=>"newevento","Modifica un evento"=>"modevento","Elimina un evento"=>"delevento","Segnala un errore nel sito"=>"bugreport","Visualizza tutti gli eventi"=>"listaeventi");
				return true;
			}
			else
				return false;
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
					if($db->query("INSERT INTO iscrizioni (idgita,idassociato,idresp) VALUES ($idgita,$idassociato,$this->matricola);"))
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
			echo "<div id=\"msg\" align=\"center\">Chi vuoi iscrivere a questa gita?</div>";
			echo "<br><br><div id=\"msg\" align=\"center\">\n";
			$db->query("SELECT * from anagrafiche WHERE approvato = 1 AND id > 0 AND (anagrafiche.a".date("Y")." = 1 OR ".date("m")." <= 3) ORDER BY nome,cognome;");
      echo "\t<select size=\"1\" name=\"associato\" id=\"associato\">\n";
      while($db->next_record())
      {
      	if(intval($db->record['id']) == intval($this->matricola))
      		$s = "selected ";
      	echo "\t\t\t<option ".$s."value=\"".intval($db->record['id'])."\">".$db->record['nome']." ".$db->record['cognome']."</option>\n";
      	$s = "";
      }
      echo "  	</select>\n</div>";
      echo "<br><div align=\"center\"><a href=\"\" onclick=\"el = prendiElementoDaId('associato'); iscrivi(".$idgita.",el.value); return false; \">OK</a></div>\n<br><br><br><br><br><br><br><br>";
			$db->close();
			unset($db);
		}
		
		function modifica_dati()
		{
			
		}
		
		function newevento()
		{
			if(!is_numeric($_POST['invio']))
			{
				include("lib/html/newevento.php");
				return;
			}
			$db = new db_local();
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
			$dataeora = date("Y-m-d G:i:00",mktime(intval($_POST['ora']),intval($_POST['minuti']),0,intval($_POST['mese']),intval($_POST['giorno']),intval($_POST['anno'])));
			if($this->carica == 'A')
				$approvato = intval($_POST['approvato']);
			else 
				$approvato = '0';
			$query = "INSERT INTO eventi (titolo,dataeora,idcreat,descrizione,approvato) VALUES ('".$titolo."','".$dataeora."','".$this->matricola."','".$descrizione."','".$approvato."');";
			
			
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
					$this->settadatievento(&$query);
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
		
		function settadatievento($query = null)
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
			
			$dataeora = date("Y-m-d G:i:00",mktime(intval($_POST['ora']),intval($_POST['minuti']),0,intval($_POST['mese']),intval($_POST['giorno']),intval($_POST['anno'])));
			$id = $_POST['invio'];
			if($_GET['fun'] == 'newevento')
				$query = "INSERT INTO eventi (titolo,dataeora,descrizione,idcreat) VALUES ('".$titolo."','".$dataeora."','".$descrizione."','".$this->matricola."');";
			else
				$query = "UPDATE eventi SET ".
						"titolo = '".$titolo."', ".
						"dataeora = '".$dataeora."', ".
						"descrizione = '".$descrizione."', ".
						"idcreat = '".$this->matricola."'".
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
			$this->menu = array_merge($this->menu,array("Aggiungi una gita"=>"newgita","Modifica una gita"=>"modgita","Visualizza iscritti ad una gita"=>"iscritti","Visualizza tutte le gite"=>"listagite"));
			$this->rand = rand();
		}
		
		function listagite()
		{
			include("lib/html/listagite.php");
		}
		
		function settadati($query = null,$addrfile = null)
		{
			if(get_magic_quotes_gpc() == 1)
			{
				$titolo = htmlentities($_POST['titolo']);
				$tipogita = htmlentities($_POST['tipogita']);
				$difficolta = htmlentities($_POST['difficolta']);
				$tipobici = htmlentities($_POST['tipobici']);
				$km = htmlentities($_POST['km']);
				$costo = htmlentities($_POST['costo']);
				$apl = htmlentities($_POST['apl']);
				if($tipogita != 'B')
				{
					$apt = htmlentities($_POST['apt']);
					$rpt = htmlentities($_POST['rpt']);
				}
				if($_POST['aas'] == "")
					$aas = htmlentities($_POST['aas2']);
				else 
					$aas = htmlentities($_POST['aas']);
				$rpl = htmlentities($_POST['rpl']);
				$ral = htmlentities($_POST['ral']);
				$itinerario = htmlentities($_POST['itinerario']);
				$descrizione = htmlentities($_POST['descrizione']);
				$note = htmlentities($_POST['note']);
			}
			else 
				{
					$titolo = addslashes(htmlentities($_POST['titolo']));
					$tipogita = addslashes(htmlentities($_POST['tipogita']));
					$difficolta = addslashes(htmlentities($_POST['difficolta']));
					$tipobici = addslashes(htmlentities($_POST['tipobici']));
					$km = addslashes(htmlentities($_POST['km']));
					$costo = addslashes(htmlentities($_POST['costo']));
					$apl = addslashes(htmlentities($_POST['apl']));
					if($tipogita != 'B')
					{
						$apt = addslashes(htmlentities($_POST['apt']));
						$rpt = addslashes(htmlentities($_POST['rpt']));
					}
					if($_POST['aas'] == "")
						$aas = addslashes(htmlentities($_POST['aas2']));
					else
						$aas = addslashes(htmlentities($_POST['aas']));
					$rpl = addslashes(htmlentities($_POST['rpl']));
					$ral = addslashes(htmlentities($_POST['ral']));
					$itinerario = addslashes(htmlentities($_POST['itinerario']));
					$descrizione = addslashes(htmlentities($_POST['descrizione']));
					$note = addslashes(htmlentities($_POST['note']));
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
        						$pathfile = $dir.$file['name'];
        						//echo "DATA>".$data."<<br>";
        					}
        					else
        						echo "<center>ERRORE UPLOAD>".$file['name']."<</center>";
							if(move_uploaded_file($file['tmp_name'], $dir.$file['name']))
							{
								//echo "muovo il file tmp nel nuovo file ".$dir.$file['name'].".<br>";
								$caricato = true;
								//echo "eseguo la query $Query.<br>";
							}
							else
							{
								if (file_exists($file['tmp_name']))
        							echo "<center>ERRORE GRAVE SPOSTAMENTO>".$file['tmp_name']."<--in-->".$dir.$file['name']."<</center>";
        						else
        							echo "<center>ERRORE FILE TMP NON ESISTENTE</center>";
        					}
					}
					else
						$pathfile = $addrfile;
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
			if($tipogita != 'B')
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
				if($db->query("SELECT gite.titolo,iscrizioni.*,anagrafiche.nome,anagrafiche.cognome,anagrafiche.tel1,anagrafiche.email,anagrafiche.cauzione FROM iscrizioni,anagrafiche,gite WHERE anagrafiche.id = iscrizioni.idassociato AND gite.id = iscrizioni.idgita AND gite.id = '".$id."' AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A');"))
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
				$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita GROUP BY iscrizioni.idgita ORDER BY dataeora;";
			else
			{
				switch ($this->carica) {
				case 'A':
				case 'S':
									$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita GROUP BY iscrizioni.idgita ORDER BY dataeora;";
									break;
				default:
									$sqlqry = "SELECT UNIX_TIMESTAMP(gite.dataeora) as 'data',gite.titolo,iscrizioni.* FROM iscrizioni,gite WHERE gite.id = iscrizioni.idgita AND(gite.idcreat = '".$this->matricola."' or gite.idresp = '".$this->matricola."') GROUP BY iscrizioni.idgita ORDER BY dataeora;";
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
			if(!$_POST['invio'])
			{
				include("lib/html/newgita.php");
				return;
			}
			$db = new db_local();
			$this->settadati(&$query);
			if($db->query($query))
			{
				echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Inserimento gita avvenuto con successo.</h2></div>";
				if(!$db->query("INSERT INTO iscrizioni (idgita,idassociato,idresp) VALUES (".$_POST['invio'].",".intval($_POST['resp']).",".$this->matricola.");"))
					echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'iscrizione del capogita alla propria gita.(ERRORE da indicare al WebMaster: \"newgita\" - Query autoiscrizione capogita FALSA)</h2></div>";
				else
					echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\"><h2>Iscrizione del capogita alla propria gita avvenuta con successo.</h2></div>";
			}
			else 
				echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\"><h2>Errore nell'inserimento della gita.(ERRORE da indicare al WebMaster: \"newgita\" - Query FALSA)</h2></div>";
			unset($db);
		}
		
		function modgita()
		{
			$id = $_GET['id'];
			if(is_numeric($id))
			{
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
					$db = new db_local();
					$db->query("SELECT * from gite WHERE id = '".$_POST['invio']."' AND(idcreat = '".$this->matricola."' or idresp = '".$this->matricola."' or ".$this->matricola." = 0 or '".$this->carica."' = 'A') LIMIT 1;",true);
					if(!$db->next_record())
					{
						mail("dibella.antonino@gmail.com","Modifica gita Applicazione Bici&Dintorni non autorizzata.",
									"Ciao Antonino,\n".
									"qualcuno sta cercando di modificare una gita ma non è autorizzato a farlo.\n".
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
							echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica gita avvenuto con successo.</div>";
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
				$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite ORDER BY dataeora DESC;";
			else
			{
				switch ($this->carica) {
				case 'A':
				case 'S':
									$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite ORDER BY dataeora DESC;";
									break;
				default:
									$sqlqry = "SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE idcreat = $this->matricola OR idresp = $this->matricola ORDER BY dataeora DESC;";
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
			$this->menu = array_flip ($this->menu);
			$this->menu = array_merge($this->menu,array("Approva un associato"=>"approvazione","Approva un evento"=>"appevento","Modifica i dati di un associato"=>"moddatiass","Aggiungi un nuovo associato"=>"newass","Elimina un associato"=>"delass","Recupera un associato eliminato"=>"recass","Statistiche"=>"stat"));
		}
		
		function approvazione($matricola)
		{
			/*$db = new db_local();
			$db->query("INSERT INTO iscrizioni (idgita,idassociato) VALUES ($idgita,$this->matricola);");
			$db->close();
			unset($db);*/
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
						mail("dibella.antonino@gmail.com","Eliminazione gita, Applicazione Bici&Dintorni.".
									"Ciao Antonino,\n".
									"qualcuno ha eliminato una gita.\n".
									"----------------\n".
									"nomeutente: ".$this->user." \n".
									"password: ".$this->pass);
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
				"qualcuno sta cercando di eliminare una gita ma non ci è riuscito.\n".
				"-----ERRORE-----\n".
				"$vartest".
				"----------------\n".
				"nomeutente: ".$this->user." \n".
				"password: ".$this->pass);
			return $vartest;
		}
		
		function delevento($id)
		{
			if(is_numeric($id))
			{
				include_once("lib/db_mysql.php");
				$db = new db_local();
				if($db->query("DELETE FROM eventi WHERE id = ".$id." LIMIT 1 ;"))
				{
					echo "Evento eliminato correttamente.";
					mail("dibella.antonino@gmail.com","Eliminazione evento, Applicazione Bici&Dintorni.",
								"Ciao Antonino,\n".
								"qualcuno ha eliminato un evento.\n".
								"----------------\n".
								"nomeutente: ".$this->user." \n".
								"password: ".$this->pass);
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
		
		function modass()
		{
			$id = $_GET['id'];
			if(is_numeric($id))
			{
				include_once("lib/db_mysql.php");
				$db = new db_local();
				//if($db->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM gite WHERE id = '".$_GET['id']."' ;"))
				if($db->query("SELECT * FROM anagrafiche WHERE id = '".$id."' LIMIT 1;"))
					require_once("lib/html/newass.php");
				else 
					echo "Errore modass, query falsa.";
				$db->close();
				unset($db);
				//echo "<script>alert('miiiiiii id num')</script>";
			}
			elseif (is_numeric($_POST['invio']))
				{
					$db = new db_local();
					$db->query("SELECT * from anagrafiche WHERE id = '".$_POST['invio']."' LIMIT 1;",true);
					if(!$db->next_record())
					{
						mail("dibella.antonino@gmail.com","Errore modifica associato Applicazione Bici&Dintorni.",
									"Ciao Antonino,\n".
									"qualcuno sta cercando di modificare un associato che non ha un id corrispondente nel database.\n".
									"-----\nFile: user.php\nRoutine: modass (Visualizzazione).\n-----\nID Ass: ".$_POST['invio']."\n".
									"nomeutente: ".$this->user." \n".
									"password: ".$this->pw);
						echo "<div align=\"center\" style=\"color: #FF0000\">Errore nella modifica dell'associato. (modifica associato, nessun id)</div>";
						$db->close();
						unset($db);
						makeTail();
						exit;
					}
					$this->settadatiass(&$query,$db->record['pathfile']);
					//echo "<br>".$query."<br>";
					//echo "<script>alert('miiiiiii ok')</script>";
					//exit;
					if($db->query($query))
					{
						$id = $_POST['invio'];
						if($db->query("INSERT INTO modifiche_associato (idass,idmodificatore) VALUES ('".$id."','".$this->matricola."');"))
							echo "<div align=\"center\" style=\"color: #0000FF;font-size:16\">Modifica associato avvenuta con successo.</div>";
						else 
							echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'associato. (inserimento modifica, query falsa)</div>";
					}
					else
						echo "<div align=\"center\" style=\"color: #FF0000;font-size:16\">Errore nella modifica dell'associato. (modifica ass, query falsa)</div>";
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
			$db = new db_local();
			if($this->matricola == 0)
				$sqlqry = "SELECT * FROM anagrafiche ORDER BY cognome;";
			else
			{
				switch ($this->carica) {
				case 'A':
				case 'S':
									$sqlqry = "SELECT * FROM anagrafiche ORDER BY cognome;";
									//break;
				}
			}
							
			if($db->query($sqlqry))
			{ ?>
			<table align="center" border="1">
				<tbody>
					<tr>
						<td align="center" colspan="3">Lista associati.</td>
						<td align="center" colspan="3"><a href="admin.php?fun=listaass" title="Lista di tutti gli associati">Lista di tutti gli associati</a></td>
					</tr>
					<tr>
						<td align="center">Cognome</td>
						<td align="center">Nome</td>
						<td align="center">UserName</td>
						<td align="center">Indirizzo</td>
						<td align="center">Tel1</td>
						<td align="center">Cell</td>
						<td align="center">E-Mail</td>
						<td align="center">Carica</td>
						<td align="center">Tipo Socio</td>
					</tr>
						<?php
						$i = 0;
						if ($db->num_rows() == 0)
							echo "<tr>\n\t<td colspan=\"6\">Nessun associato presente nel database</td>\n</tr>";
						else
						while($db->next_record())
						{
							echo "					<tr>\n						<td>".$db->record['cognome']."</td>\n						";
							//echo "<td><a target=\"_blank\" href=\"index.php?id=".$db->record['id']."\">".$db->record['titolo']."</a></td>\n						";
							echo "<td>".$db->record['nome']."</td>\n						";
							echo "<td>".$db->record['user']."</td>\n						";
							echo "<td>".$db->record['via']."</td>\n						";
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
				settadatiass();
				return;
				$db = new db_local();
				$db->query("INSERT INTO anagrafiche (idgita,idassociato) VALUES ($idgita,$this->matricola);");
				$db->close();
				unset($db);
				return;
			}
		}
		
		function settadatiass()
		{
			 if(get_magic_quotes_gpc() == 1)
			{
				$nome = htmlentities($_POST['nome']);
				$cognome = htmlentities($_POST['cognome']);
				$sesso = htmlentities($_POST['sesso']);
				$via = htmlentities($_POST['via']);
				$cap = htmlentities($_POST['cap']);
				$citta = htmlentities($_POST['citta']);
				$prov = htmlentities($_POST['prov']);
				$tel1 = htmlentities($_POST['tel1']);
				$tel2 = htmlentities($_POST['tel2']);
				$cell = htmlentities($_POST['cell']);
				$email = htmlentities($_POST['email']);
				$carica = htmlentities($_POST['carica']);
				$saldo = htmlentities($_POST['saldo']);
				$tiposocio = htmlentities($_POST['tiposocio']);
				$cauzione = htmlentities($_POST['cauzione']);
				$note = htmlentities($_POST['note']);
			}
			else 
				{
					$nome = addslashes(htmlentities($_POST['nome']));
					$cognome = addslashes(htmlentities($_POST['cognome']));
					$sesso = addslashes(htmlentities($_POST['sesso']));
					$via = addslashes(htmlentities($_POST['via']));
					$cap = addslashes(htmlentities($_POST['cap']));
					$citta = addslashes(htmlentities($_POST['citta']));
					$prov = addslashes(htmlentities($_POST['prov']));
					$tel1 = addslashes(htmlentities($_POST['tel1']));
					$tel2 = addslashes(htmlentities($_POST['tel2']));
					$cell = addslashes(htmlentities($_POST['cell']));
					$email = addslashes(htmlentities($_POST['email']));
					$carica = addslashes(htmlentities($_POST['carica']));
					$saldo = addslashes(htmlentities($_POST['saldo']));
					$tiposocio = addslashes(htmlentities($_POST['tiposocio']));
					$cauzione = addslashes(htmlentities($_POST['cauzione']));
					$note = addslashes(htmlentities($_POST['note']));
				}
			$giorno = intval($_POST['giorno']);
			$mese = intval($_POST['mese']);
			$anno = intval($_POST['anno']);
			$a2007 = intval($_POST['2007']);
			$a2008 = intval($_POST['2008']);
			$a2009 = intval($_POST['2009']);
			$a2010 = intval($_POST['2010']);
			$a2011 = intval($_POST['2011']);
			$a2012 = intval($_POST['2012']);
			$a2013 = intval($_POST['2013']);
			$a2014 = intval($_POST['2014']);
			$a2015 = intval($_POST['2015']);
			$dataiscrizione = $_POST['dataiscrizione'];
			$datanascita = date("Y-m-d G:i:00",mktime(0,0,0,intval($mese),intval($giorno),intval($anno)));
			$approvato = intval($_POST['approvato']);
				/*echo "<script>alert(\"L'inserimento degli associati non e' disponibile 2\"); window.close();</script>";
				makeTail();
				exit;*/
			 /*
				return;
				$db = new db_local();
				$db->query("INSERT INTO anagrafiche (idgita,idassociato) VALUES ($idgita,$this->matricola);");
				$db->close();
				unset($db);
				return;
				
				*/
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
?>