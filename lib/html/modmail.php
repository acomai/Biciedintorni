<div align="center" id="title"><h2>Modifica E-Mail</h2></div>
<div align="center" style="color:red"><br>I campi con * sono obbligatori.</div>
<form id="frmmodmail" enctype="multipart/form-data" method="post" name="modmail" action="admin.php?fun=modmail&save=1">
  <table id="Tmodmail" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td id="tdora" class="title">Data e ora di inizio invio*</td>
        <td>
        <select size="1" name="giorno" id="giorno" onchange="javascript: caricaOreSucc('giorno','mese','anno','ora');">
        <?php
          	for($i=date("j");$i<=31;$i++)
          	{
				if($db->record['giorno'] == $i)
					echo "<option selected>".$i."</option>\n          ";
				else
					echo "<option>".$i."</option>\n          ";
          	}
        ?>
        </select>
        <select size="1" name="mese" id="mese" onchange="javascript: caricaGiorniSucc('giorno','mese','anno','ora');">
          <?php
          	for($i=date("n");$i<=12;$i++)
          	{
				if($db->record['mese'] == $i)
					echo '<option selected value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
				else
					echo '<option value="'.$i.'">'.$this->mesi[$i]."</option>\n          ";
          	}
          ?>
        </select>
        <select size="1" name="anno" id="anno" onchange="javascript: caricaMesiSucc('giorno','mese','anno','ora');">
          <?php
          	/*for($i=1900;$i<date("Y");$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}*/
			if ($db->record['anno'] < date("Y") or $db->record['anno'] > (date("Y") + 1))
				echo "<option selected>".$db->record['anno']."</option>\n          ";
          	echo "<option";
			if ($db->record['anno'] == date("Y"))
				echo " selected";
			echo ">".date("Y")."</option>\n          ";
          	echo "<option";
			if ($db->record['anno'] == (date("Y") + 1))
				echo " selected";
			echo ">".(date("Y") + 1)."</option>\n          ";
          ?>
        </select>
        <select size="1" name="ora" id="ora">
          <?php
			$i=intval(date("G")+1);
			if($i > $db->record['ora'])
			{
				if($db->record['minuti'] == 0)
					echo "<option selected>".sprintf("%02d", $db->record['ora']).":00</option>\n          ";
				else
					echo "<option selected>".sprintf("%02d", $db->record['ora']).":30</option>\n          ";
			}
          	for($i=intval(date("G")+1);$i<=23;$i++)
          	{
				if($db->record['ora'] == $i && $db->record['minuti'] == 0)
					echo "<option selected>".sprintf("%02d", $i).":00</option>\n          ";
				else
					echo "<option>".sprintf("%02d", $i).":00</option>\n          ";
				if($db->record['ora'] == $i && $db->record['minuti'] == 30)
					echo "<option selected>".sprintf("%02d", $i).":30</option>\n          ";
				else
					echo "<option>".sprintf("%02d", $i).":30</option>\n          ";
          	}
          ?>
        </select>
        </td>
      </tr>
      <tr>
      	<td id="tdgruppo" class="title">Gruppo di destinatari*</td>
      	<td>
      		<select size="1" name="gruppo" id="gruppo">
	          <?php
				$idgruppo = $db->record['idgruppo'];
				$id = $db->record['id'];
				$db->query("select * from gruppimail ;");
				while($db->next_record())
				{
					if($db->record['id'] == $idgruppo)
						echo "<option selected value='".$db->record['id']."'>".$db->record['nome']."</option>\n          ";
					else
						echo "<option value='".$db->record['id']."'>".$db->record['nome']."</option>\n          ";
		        }
				$db->query("select * from email WHERE id = ".$id." ;");
				$db->next_record();
	          ?>
        	</select>
      	</td>
      </tr>
	  <tr>
      	<td id="tdoggetto" class="title">Oggetto</td>
      	<td><input id="oggetto" maxlength="255" size="100" name="oggetto" value="<?php echo $db->record['oggetto']; ?>"></td>
      </tr>
	  <tr>
      	<td id="tdcorpo" class="title">Messaggio<script type="text/javascript" src="lib/js/ckeditor/ckeditor.js"></script>
		<script>
		window.onload = function()
		{
			CKEDITOR.replace( 'corpo',
			{
				toolbar :
				[
					['Source','-','NewPage','Preview'],
					['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker'],
					['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
					['Checkbox', 'Radio'],
					['BidiLtr', 'BidiRtl'],
					'/',
					['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
					['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
					['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					['Link','Unlink','Anchor'],
					['Table','HorizontalRule','Smiley','SpecialChar'],
					'/',
					['Styles','Format','Font','FontSize'],
					['TextColor','BGColor'],
					['Maximize', 'ShowBlocks']
				]
			});
		};
</script></td>
      	<td><textarea name="corpo"><?php echo $db->record['corpo']; ?></textarea></td>
      </tr>
	  <tr>
		<td colspan="2" align="right"><input type="hidden" value='<?php echo $db->record['id']; ?>' name="id"><?php echo ($db->record['giorno'] <= date("d") && $db->record['mese'] <= date("m") && $db->record['anno'] <= date("Y") && $db->record['ora'] <= date("H") && $db->record['minuti'] <= date("i")?"Questa E-Mail &egrave; in sola lettura, in quanto &egrave; gia stata inviata.":"<button type=\"submit\">Invio</button>"); ?></td>
  	  </tr>
    </tbody>
  </table>
</form>
<br/><br/><br/>