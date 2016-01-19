<?php if($db->next_record())
{ 
	?>
<div align="center" id="title"><h2><?php echo $db->record['titolo']; ?></h2></div>
<br><br>
  <table id="Tvisevento" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo</td>
        <td><?php echo $db->record['titolo']; ?></td>
      </tr>
      <tr>
        <td id="tddata" class="title">Data evento</td>
        <td><div id="tddata">Data: <?php echo substr($db->record['dataeora'],8,2)."/".substr($db->record['dataeora'],5,2)."/".substr($db->record['dataeora'],0,4);?></td>
      </tr>
      <tr>
        <td id="tdora" class="title">Ora</td>
        <td><?php echo substr($db->record['dataeora'],11,2).":".substr($db->record['dataeora'],14,2);?></td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione</td>
        <td><?php echo $db->record['descrizione']; ?></td>
      </tr>      <tr>        <td id="tdfile" class="title">File allegato</td>        <td><?php        if($db->record['pathfile'])        {        ?><a title="File Allegato" target="_blank" href="<?php echo $db->record['pathfile']; ?>">[<?php echo basename($db->record['pathfile']); ?>]</a><?php        }else        {         ?>Nessun file allegato.<?php } ?></td>      </tr>
    </tbody>
  </table>
<?php 
}
else 
{?>
	<div align="center" style="color: #FF0000">Errore vis_gita, query nulla.</div>
<?php 
}
?>