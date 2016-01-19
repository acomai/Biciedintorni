<div align="center" id="title"><h2>Nuova E-Mail</h2></div>
<div align="center" style="color:red"><br>I campi con * sono obbligatori.</div>
<form id="frmnewmail" enctype="multipart/form-data" method="post" name="newmail" action="admin.php?fun=newmail">
  <table id="Tnewmail" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td id="tdora" class="title">Data e ora di inizio invio*</td>
        <td>
        <select size="1" name="giorno" id="giorno" onchange="javascript: caricaOreSucc('giorno','mese','anno','ora');">
        <?php
          	for($i=date("j");$i<=31;$i++)
          	{
          		echo "<option>".$i."</option>\n          ";
          	}
        ?>
        </select>
        <select size="1" name="mese" id="mese" onchange="javascript: caricaGiorniSucc('giorno','mese','anno','ora');">
          <?php
          	for($i=date("n");$i<=12;$i++)
          	{
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
          	echo "<option";
			if (date("n")<=11)
				echo " selected";
			echo ">".date("Y")."</option>\n          ";
          	echo "<option";
			if (date("n")>11)
				echo " selected";
			echo ">".(date("Y") + 1)."</option>\n          ";
          ?>
        </select>
        <select size="1" name="ora" id="ora">
          <?php
          	for($i=intval(date("G")+1);$i<=23;$i++)
          	{
          		echo "<option>".sprintf("%02d", $i).":00</option>\n          ";
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
				while($db->next_record())
				{
		          	echo "<option value='".$db->record['id']."'>".$db->record['nome']."</option>\n          ";
		        }
	          ?>
        	</select>
      	</td>
      </tr>
	  <tr>
      	<td id="tdoggetto" class="title">Oggetto</td>
      	<td><input id="oggetto" maxlength="255" size="100" name="oggetto"></td>
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
      	<td><textarea name="corpo"></textarea></td>
      </tr>
	  <tr>
		<td colspan="2" align="right"><input type="hidden" value='1' name="invio"><button type="submit">Invio</button></td>
  	  </tr>
    </tbody>
  </table>
</form>
<br/><br/><br/>