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
		<div class="col-xs-12 text-center"><h4>FIAB Torino Bici e Dintorni - Lista libri per <?php echo $ordinamento;?> - <a href="biblioteca.php">Biblioteca</a></h4></div>
	</div>
		<div class="row">
		<div class="col-xs-12">Numero di libri: <strong><?php echo $db->num_rows();?></strong></div>
	</div>
	<hr />
	<!-- Testata per gestire la lista con Bootstrap. -->
	<div class="row">
		<div class="col-xs-3 text-center"><strong>Titolo</strong></div>
		<div class="col-xs-1 text-center"><strong>Anno</strong></div>
		<div class="col-xs-1 text-center"><strong>Classif.</strong></div>		
		<div class="col-xs-1 text-center"><strong>Tipo</strong></div>
		<div class="col-xs-1 text-center"><strong>Nazione</strong></div>
		<div class="col-xs-2 text-center"><strong>Autore</strong></div>
		<div class="col-xs-3 text-center"><strong>Descrizione</strong></div>
	</div>	
	 
	<!--  <table>
	  <tr>
	    <th class="title">Titolo </th>
	    <th class="title">Anno </th>
	    <th class="title">Tipo </th>
	    <th class="title">Nazione </th>
	    <th class="title">Autore </th>
	    <th class="title">Descrizione</th>
	  </tr>-->
<?php
	while ($db->next_record()) {
		echo "<div class='row'>";
		echo "<div class='col-xs-3'>" . "<a href=\"biblioteca.php?fun=vislibro&amp;id=". $db->record['id'] . "\">" .
		$db->record['titolo'] . "</a></b><br>" . $db->record['sottotitolo'] . "<br><br></div>";
		echo "<div class='col-xs-1'>" . $db->record['anno'] . "</div>";
		echo "<div class='col-xs-1'>" . $db->record['classificazione'] . "</div>";
		echo "<div class='col-xs-1'><a href=\"biblioteca.php?sez=libri&amp;idarg=". $db->record['idarg'] . "\">" . $db->record['argomento'] . "</a></div>";
		echo "<div class='col-xs-1'><a href=\"biblioteca.php?sez=libri&amp;idnaz=". $db->record['idnaz'] . "\">" . $db->record['nazione'] . "</a></div>";
		echo "<div class='col-xs-2'>" . $db->record['autore'] . "</div>";
		echo "<div class='col-xs-3'>" . $db->record['descrizione'] . "</div>";
		echo "</div>";
	}
	
	/*while ($db->next_record()) {
		echo "  <tr>\n";
		echo "    <td><b>" . "<a href=\"biblioteca.php?fun=vislibro&amp;id=". $db->record['id'] . "\">" .
				$db->record['titolo'] . "</a></b><br>" . $db->record['sottotitolo'] . "<br><br></td>\n";
				echo "    <td>" . $db->record['anno'] . "</td>\n";
				echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idarg=". $db->record['idarg'] . "\">" . $db->record['argomento'] . "</a></td>\n";
				echo "    <td><a href=\"biblioteca.php?sez=libri&amp;idnaz=". $db->record['idnaz'] . "\">" . $db->record['nazione'] . "</a></td>\n";
				echo "    <td>" . $db->record['autore'] . "</td>\n";
				echo "    <td>" . $db->record['descrizione'] . "</td>\n";
				echo "  </tr>\n";
	}
	echo "</table>\n";
	*/
	$db->close();
	unset($db);
?>
</div>
</body>
</html>