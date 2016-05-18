<!DOCTYPE html>
<html lang="it">
<!-- Biblioteca di Bici e Dintorni.
Visualizzazione singolo libro  -->
<head>
  <title>FIAB Torino Bici e Dintorni - vislibro.php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
<?php if($db->next_record())
{ 
	?>

<div class="row">
	<div class="col-xs-12 text-center">FIAB Torino Bici e Dintorni - Visualizzazione libro - <a href="javascript:history.back()">Elenco libri</a> - <a href="biblioteca.php">Biblioteca</a></div>
</div>
<div class="row">
	<div class="col-xs-12 text-center title"><h4><?php echo "<b>".$db->record['titolo'] . "</b><br>" . $db->record['sottotitolo']; ?></h4></div>
</div>
<br>
  <table id="Tvisevento" align="center" style="text-align: left;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
      <tr>
        <td id="tdtitolo" class="title">Titolo</td>
        <td><?php echo "<b>".$db->record['titolo'] . "</b><br>" . $db->record['sottotitolo']; ?></td>
      </tr>
      <tr>
        <td id="tdnazione" class="title">Nazione</td>
        <td><?php echo $db->record['nazione'];?></td>
      </tr>
	  <tr>
        <td id="tdcitta" class="title">Citt&agrave;</td>
        <td><?php echo $db->record['citta'];?></td>
      </tr>
	  <tr>
        <td id="tdautore" class="title">Autore</td>
        <td><?php echo $db->record['autore'];?></td>
      </tr>
	  <tr>
        <td id="tdeditore" class="title">Editore</td>
        <td><?php echo $db->record['editore'];?></td>
      </tr>
	  <tr>
        <td id="tdanno" class="title">Anno</td>
        <td><?php echo $db->record['anno'];?></td>
      </tr>
      <tr>
        <td id="tdlingua" class="title">Lingua</td>
        <td><?php echo $db->record['lingua'];?></td>
      </tr>
	  <tr>
        <td id="tdscala" class="title">Pagine</td>
        <td><?php echo $db->record['pagine'];?></td>
      </tr>
      <tr>
        <td id="tddescrizione" class="title">Descrizione</td>
        <td><?php echo $db->record['descrizione'];?></td>
      </tr>
	  <tr>
        <td id="tdnote" class="title">Note</td>
        <td><?php echo $db->record['note'];?></td>
      </tr>
	  <tr>
        <td id="tdscaffale" class="title">Scaffale</td>
        <td><?php echo $db->record['scaffale'];?></td>
      </tr>
    </tbody>
  </table>
  <?php 
}
else 
{?>
	<div align="center" style="color: #FF0000">Errore vis_cart, query nulla.</div>
<?php 
}
?>
</div>

<?php 
$idlibro = $db->record['id'];

//verifica se il libro è registrato come "in prestito"

//parametri connessione al DB
$servername = "62.149.150.56";
$username = "Sql145958";
$password = "c36d0fc2";
$dbname = "Sql145958_1";

// Create connection
$conn2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn2->connect_error) {
	die("Connection failed: " . $conn2->connect_error);
}

// impostazione flag che indica se il libro risulta in prestito
$inprestito = false;

$sql2 = "SELECT * FROM prestiti WHERE idlibro = $idlibro ORDER BY dataprestito DESC;" ;
$result2 = $conn2->query($sql2);

if ($result2->num_rows > 0) {
	// output data of each row
	while ($row = $result2->fetch_assoc()) {			
		//test per datarestituzione = null
		if (is_null($row['datarestituzione'])) {
			$inprestito = true;
		}		
	}
} 

if ($inprestito) {
	echo "<h3 style='color:red; text-align:center'>Il libro è in prestito</h3>";
}
?>


</body>
</html>