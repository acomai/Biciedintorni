<?php
/*
Description: Lista Gite
Shortcode: [listagite2] 
*/
include_once(dirname(__FILE__)."/../lib/db_mysql.php");
$snipdb = new db_local();
if($_GET['limit'] == '0')
	$snipdb->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM Sql145958_1.gite WHERE YEAR(dataeora) = ".date("Y")." AND approvata = 1 ORDER BY dataeora;");
else

	$snipdb->query("SELECT *,UNIX_TIMESTAMP(dataeora) as 'data' FROM Sql145958_1.gite WHERE DATE(dataeora) >= CURDATE() AND approvata = 1 ORDER BY dataeora LIMIT 0,30 ;");
?>
<div style="color: blue;">
	<a style="font-size: 16px;"
		href="http://www.biciedintorni.it/application/index.php?limit=0"
		title="Elenco gite">[Visualizza tutte le gite del <?php echo date("Y");?>]
	</a>�����
	<?php if(date("m") >= 11) {?>
	<a style="font-size: 16px;"
		href="http://www.biciedintorni.it/application/index.php?limit=<?php echo (date("Y")+1);?>"
		title="Elenco gite">[Visualizza tutte le gite del <?php echo (date("Y")+1);?>]
	</a>�����
	<?php } ?>
	<a style="font-size: 16px;"
		href="http://www.biciedintorni.it/application/index.php?fun=creadoc"
		title="Crea Un documento Doc con tutte le gite approvate.">[Scarica doc promemoria gite <?php echo date("Y");?>]
	</a>
</div>
<table>
	<tbody>
		<tr>
			<th class="data">Data</th>
			<th class="facili">Descrizione</th>
			<th class="facili" align="center">Km</th>
			<th class="medie">Difficolt�</th>
		</tr>
		<?php 
while ($snipdb->next_record()) {
	?>
		<tr>
			<td class="data"><?php echo substr($snipdb->record['dataeora'],8,2)."/".substr($snipdb->record['dataeora'],5,2)."/".substr($snipdb->record['dataeora'],0,4); ?></td>
			<td><span class="medie"><a
					href="http://www.biciedintorni.it/application/index.php?id=<?php echo $snipdb->record['id']; ?>"><?php echo $snipdb->record['titolo']; ?></a></span></td>
			<td align="center"><?php echo $snipdb->record['km']; ?></td>
			<td><img
				src="http://www.biciedintorni.it/wordpress/wp-content/uploads/2012/02/<?php 
if($snipdb->record['difficolta'] == 'D' || $snipdb->record['difficolta'] == 'X')
	echo 'bici-impegnativa.png" alt="impegnativa"';
elseif ($snipdb->record['difficolta'] == 'M')
	echo 'bici-media.png" alt="media"';
else
	echo 'bici-facile.png" alt="facile"';
?>/>
			</td>
		</tr>
		<?php 
	}
	unset($snipdb);
?>
	</tbody>
</table>