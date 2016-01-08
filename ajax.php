<?php

/*
Implementare il controllo del nick sul database,
la gestione della pressione dei tasti dovrebbe funzionare (controllare bene con dei nick).
*/



switch ($_GET['f'])
{
	case 'cg':
				for ($i=1;$i<=date("t",mktime(0,0,0,$_GET['mese'],1,$_GET['anno']));$i++)
				  if($_GET['giorno'] == $i)
        			echo "<option value=\"$i\" selected=\"selected\">$i</option>\n";
        		  else
        			echo "<option value=\"$i\">$i</option>\n";
    			break;
   case 'cgsucc':
   					if(intval($_GET['mese']) == intval(date("m")) and intval($_GET['anno']) == intval(date("Y")))
   						$partenza = intval(date("j"));
   					else
   						$partenza = 1;
   					if ($partenza > intval(date("t",mktime(0,0,0,$_GET['mese'],1,$_GET['anno']))))
   						$partenza = intval(date("t",mktime(0,0,0,$_GET['mese'],1,$_GET['anno'])));
					for ($i = $partenza;$i<=date("t",mktime(0,0,0,$_GET['mese'],1,$_GET['anno']));$i++)
					  if($_GET['giorno'] == $i)
	        			echo "<option value=\"$i\" selected=\"selected\">$i</option>\n";
	        		  else
	        			echo "<option value=\"$i\">$i</option>\n";
	    			break;
   case 'cmsucc':
  					include("lib/class.php");
   					if(intval($_GET['anno']) == intval(date("Y")))
   						$partenza = intval(date("n"));
   					else
   						$partenza = 1;
					
					for($i=$partenza;$i<=12;$i++)
		          	{
		          		if($_GET['mese'] == $i)
		          			echo '<option value="'.$i.'" selected=\"selected\">'.$mesi[$i]."</option>\n          ";
	          			else
	          				echo '<option value="'.$i.'">'.$mesi[$i]."</option>\n          ";
		          	}
	    			break;
	case 'cosucc':
		   			if(intval($_GET['giorno']) == intval(date("j")) and intval($_GET['mese']) == intval(date("m")) and intval($_GET['anno']) == intval(date("Y")))
		   				$partenza = intval(date("G"))+1;
   					else
   						$partenza = 0;
					for($i=$partenza;$i<=23;$i++)
		          	{
		          		echo "<option>".sprintf("%02d", $i).":00</option>\n          ";
		          		echo "<option>".sprintf("%02d", $i).":30</option>\n          ";
		          	}
		    		break;
  case 'cn':
				echo 'OK';
  			//echo '<input maxlength="20" size="20" tabindex="3" name="username" onchange=\'javascript: window.clearInterval(x); x = window.setInterval("controllaNick()", 3000);\'>';
  			break;
  case 'ap':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di approvare una gita, ti ricordo che se non è un amministratore non ha il link all'approvazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->appgita($_GET['num']);
  			break;
  case 'apass':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di approvare una gita, ti ricordo che se non è un amministratore non ha il link all'approvazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->appass($_GET['num']);
  			break;
  case 'ape':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di approvare una gita, ti ricordo che se non è un amministratore non ha il link all'approvazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->appevento($_GET['num']);
  			break;
  case 'el':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->delgita($_GET['num']);
  			break;
  case 'elass':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->delass($_GET['num']);
  			break;
  case 'elisc':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->delisc($_GET['num']);
  			break;
  case 'isc':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->iscrivi($_GET['num'],$_GET['ass']);
  			break;
  case 'ele':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->delevento($_GET['num']);
  			break;
  case 'ellibro':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->dellibro($_GET['num']);
  			break;
  case 'elcartina':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di eliminare una gita, ti ricordo che se non è un amministratore non ha il link all'eliminazione quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
				echo $user->delcartina($_GET['num']);
  			break;
  case 'na':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			/*if($user->carica != 'A')
  			{
  				mail("dibella.antonino@gmail.com","Attacco all'applicazione gite","Ciao Antonino,\nqualcuno che non è un'amministratore ha tentato di aggiungere un associato (cliccando sull'aggiunta che c'è nell'inserimento di una gita o nella modifica, quindi è entrato gia li..), ti ricordo che se non è un amministratore non ha il link alla modifica o all'aggiunta di una gita quindi significa che COSTUI ha inserito il link manualmente...\n ID=".$user->matricola);
  				exit;
  			}*/
  			include_once("lib/db_mysql.php");
  			$db = new db_local();
  			$db->query("SELECT * FROM anagrafiche WHERE carica = 'C' OR carica = 'A' ;");
      		echo "<select onchange=\"newass();\" size=\"1\" name=\"resp\">\n";
      		while($db->next_record())
      		{
      			/*if(intval($db->record['id']) == intval($user->record['id']))
      				$s = "selected ";*/
      			echo "\t<option ".$s."value=\"".intval($db->record['id'])."\">".$db->record['nome']." ".$db->record['cognome']."</option>\n";
      			/*$s = "";*/
      		}
      		echo "\t<option value=\"-1\">Aggiungi un nuovo responsabile</option>";
      		echo "</select>";
      		//echo "<script>Wnewass.close();</script>";
      		//echo "PERFETTO";
  			break;
  case 'lsmail':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			include_once("lib/db_mysql.php");
  			$db = new db_local();
			$campo = str_replace("'","",$_GET['campo']);
			$campo = str_replace('"','',$campo);
  			$db->query("SELECT * FROM anagrafiche where id > 0 and id not in (select id from TMPSelezionati".$user->matricola.") and (email is not null and trim(email) <> '') order by ".$campo." ;");
      		?><table>
						<tr class="title">
							<td onclick="orderby('cognome,nome')"><u>Cognome, Nome</u></td>
						<?php 
						if(date("Y") >= "2007") echo "<td onclick=\"orderby('a2007 desc,cognome,nome')\"><u>2007</u></td>";
						if(date("Y") >= "2008") echo "<td onclick=\"orderby('a2008 desc,cognome,nome')\"><u>2008</u></td>";
						if(date("Y") >= "2009") echo "<td onclick=\"orderby('a2009 desc,cognome,nome')\"><u>2009</u></td>";
						if(date("Y") >= "2010") echo "<td onclick=\"orderby('a2010 desc,cognome,nome')\"><u>2010</u></td>";
						if(date("Y") >= "2011") echo "<td onclick=\"orderby('a2011 desc,cognome,nome')\"><u>2011</u></td>";
						if(date("Y") >= "2012") echo "<td onclick=\"orderby('a2012 desc,cognome,nome')\"><u>2012</u></td>";
						if(date("Y") >= "2013") echo "<td onclick=\"orderby('a2013 desc,cognome,nome')\"><u>2013</u></td>";
						if(date("Y") >= "2014") echo "<td onclick=\"orderby('a2014 desc,cognome,nome')\"><u>2014</u></td>";
						if(date("Y") >= "2015") echo "<td onclick=\"orderby('a2015 desc,cognome,nome')\"><u>2015</u></td>";
						echo "</tr>\n";
        			while($db->next_record())
					{
						echo "<tr id=\"soc".$db->record['id']."\" onclick=\"seleziona('".$db->record['id']."')\"><td>".$db->record['cognome'].",&nbsp;".$db->record['nome']."</td>";
	        			if(date("Y") >= "2007") echo "<td>".($db->record['a2007']==1?"Si":"No")."</td>";
						if(date("Y") >= "2008") echo "<td>".($db->record['a2008']==1?"Si":"No")."</td>";
						if(date("Y") >= "2009") echo "<td>".($db->record['a2009']==1?"Si":"No")."</td>";
						if(date("Y") >= "2010") echo "<td>".($db->record['a2010']==1?"Si":"No")."</td>";
						if(date("Y") >= "2011") echo "<td>".($db->record['a2011']==1?"Si":"No")."</td>";
						if(date("Y") >= "2012") echo "<td>".($db->record['a2012']==1?"Si":"No")."</td>";
						if(date("Y") >= "2013") echo "<td>".($db->record['a2013']==1?"Si":"No")."</td>";
						if(date("Y") >= "2014") echo "<td>".($db->record['a2014']==1?"Si":"No")."</td>";
						if(date("Y") >= "2015") echo "<td>".($db->record['a2015']==1?"Si":"No")."</td>";
	        			echo "</tr>\n";
					}
					?></table>
					<?php
  			break;
	case 'soctotemp':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			include_once("lib/db_mysql.php");
  			$db = new db_local();
			$id = $_GET['id'];
			$db->query("Select id from TMPSelezionati".$user->matricola." where id = ".$id." ;");
			if(!$db->next_record())
			{
				$db->query("insert into TMPSelezionati".$user->matricola." (id) values ($id);");
				echo "OK";
			}
  			break;
	case 'listasel':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			include_once("lib/db_mysql.php");
			$db = new db_local();
  			$db->query("SELECT id,cognome,nome,email FROM anagrafiche where id in (select id from TMPSelezionati".$user->matricola.") order by cognome,nome;");
      		?><table width="100%">
						<tr class="title">
							<td>Cognome, Nome</td>
							<td width="50%">E-Mail</td>
						</tr>
						<?php
        			while($db->next_record())
					{?>
						<tr id="sel<?php echo $db->record['id']; ?>" onclick="selezionasel('<?php echo $db->record['id']; ?>')">
							<td><?php echo $db->record['cognome'].",&nbsp;".$db->record['nome']; ?></td>
							<td><?php echo $db->record['email']; ?></td>
	        			</tr>
					<?php
					}
					?></table>
					<?php
  			break;
	case 'temptosoc':
  			$dove = "admin.php";
  			include("lib/check_login.php");
  			include_once("lib/db_mysql.php");
  			$db = new db_local();
			$id = $_GET['id'];
			if(is_numeric($id))
				$db->query("delete from TMPSelezionati".$user->matricola." where id = ".$id." ;");
  			break;
	case 'elgruppo':
  			$dove = "admin.php";
  			include("lib/check_login.php");
			echo $user->delgruppo($_GET['num']);
  			break;
	case 'elmail':
  			$dove = "admin.php";
  			include("lib/check_login.php");
			echo $user->delmail($_GET['num']);
  			break;
			
}
?>