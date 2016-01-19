<?php 
	include_once("lib/db_mysql.php");
	$db = new db_local();
	$numtable = $this->matricola;
	$db->query("CREATE TABLE IF NOT EXISTS TMPSelezionati".$numtable." (ID INT(6));");
	$db->query("DELETE FROM TMPSelezionati".$numtable.";");
	$db->query("SELECT * FROM anagrafiche where id > 0 and (email is not null and trim(email) <> '') order by cognome,nome ;");
?><div align="center" id="title"><h2>Nuovo Gruppo</h2></div>
<div align="center" style="color:red">I campi con * sono obbligatori.</div>
<form id="frmnewgruppo" enctype="multipart/form-data" method="post" name="newgruppo" action="admin.php?fun=newgruppo&invio=1">
  <table id="Tnewgruppo" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td id="tdnome" class="title">Nome gruppo*</td>
        <td><input id="nome" maxlength="255" size="100" name="nome"></td>
      </tr>
      <tr>
        <td id="tddescri" class="title">Descrizione gruppo*</td>
        <td><input id="descri" maxlength="4000" size="100" name="descri"></td>
      </tr>
      <tr>
        <td id="tdsoci" colspan="2">
		<script>
			var selezionati = false;
			var selezionato = false;
		</script>
        	<table width="100%">
        		<tr>
        			<td width="47%" style="vertical-align:top;"><div id="listasoci" style="height:400px;overflow:auto; border-right:thin solid">
						<table>
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
						echo "</tr>";
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
	        			echo "</tr>";
					}
					?></table>
					</div></td>
        			<td width="6%" style="border-right:thin solid"><div heigth="100%" style="padding-left:2px;">
					<input type="button" value="&gt;&gt;" onclick="aggiungiagruppo()"><br>
					<input type="button" value="&lt;&lt;" onclick="rimuovidalgruppo()"></div></td>
        			<td width="47%" style="vertical-align:top;"><div id="listaselezionati" style="height:400px;overflow:auto;padding-left:2px;vertical-align:top;">
						<table width="100%">
							<tr class="title">
								<td width="50%">Cognome, Nome</td>
								<td width="50%">E-Mail</td>
							</tr>
						</table>
					</div></td>
        		</tr>
        	</table>
        </td>
      </tr>
	  <tr>
		<td colspan="2" align="right"><input type="hidden" value='1' name="invio"><button type="button" onclick="controllaFormGruppo();">Invio</button></td>
  	  </tr>
    </tbody>
  </table>
</form>
<br/><br/><br/>