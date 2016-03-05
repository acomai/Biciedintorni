<!DOCTYPE html>
<html lang="it">
<!-- Lista dei libri nella biblioteca di Bici e Dintorni.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - listalibri.php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 text-center">FIAB Torino Bici e Dintorni - Lista libri - <a href="biblioteca.php">Biblioteca</a></div>
	</div>
		<div class="row">
		<div class="col-xs-12">Numero di libri: <?php echo $db->num_rows();?></div>
	</div>
	<!-- Bozza di testata per gestire la lista con Bootstrap. Eliminare classificazione,
	poi convertire la tabella sottostante in stile bootstrap
	<div class="row">
		<div class="col-xs-4 text-center">Titolo</div>
		<div class="col-xs-1 text-center">Argomento</div>
		<div class="col-xs-1 text-center">Nazione</div>
		<div class="col-xs-1 text-center">Autore</div>
		<div class="col-xs-1 text-center">Anno</div>
		<div class="col-xs-1 text-center">Classificazione</div>
		<div class="col-xs-3 text-center">Descrizione</div>
	</div>	
	 -->
	<table>
	  <tr>
	    <th class="title">Titolo</th>
	    <th class="title">Argomento</th>
	    <th class="title">Nazione</th>
	    <!--<td class="title">Citt&agrave;</td>-->
	    <th class="title">Autore</th>
	    <!--<td class="title">Editore</td>-->
	    <th class="title">Anno</th>
	    <!--<td class="title">Lingua</td>
	    <td class="title">Pagine</td>-->
	    <th class="title">Classificazione</th>
	    <th class="title">Descrizione</th>
	    <!--<td class="title">Note</td>
	    <td class="title">Scaffale</td>-->
	  </tr>
<?php
	while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td><b>" . $db->record['titolo'] . "</b><br>" . $db->record['sottotitolo'] . "<br><a href=\"biblioteca.php?fun=vislibro&amp;id=". $db->record['id'] . "\">Visualizza dettagli</a></td>\n";
		echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idarg=". $db->record['idarg'] . "\">" . $db->record['argomento'] . "</a></td>\n";
		echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idnaz=". $db->record['idnaz'] . "\">" . $db->record['nazione'] . "</a></td>\n";
		/*echo "    <td>" . $db->record['citta']."</td>\n";*/
		echo "    <td>" . $db->record['autore'] . "</td>\n";
		/*echo "    <td>" . $db->record['editore'] . "</td>\n";*/
		echo "    <td>" . $db->record['anno'] . "</td>\n";
		/*echo "    <td>" . $db->record['lingua'] . "</td>\n";
		echo "    <td>" . $db->record['pagine'] . "</td>\n";*/
		echo "    <td>" . $db->record['classificazione'] . "</td>\n";
		echo "    <td>" . $db->record['descrizione'] . "</td>\n";
		/*echo "    <td>" . $db->record['note'] . "</td>\n";
		echo "    <td>" . $db->record['scaffale'] . "</td>\n";*/
		echo "  </tr>\n";
	}
	echo "</table>\n";
	$db->close();
	unset($db);
?>
</div>
</body>
</html>