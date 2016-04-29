<!DOCTYPE html>
<html lang="it">
<!-- Gestisce il recupero delle password per l'applicativo di Bici e Dintorni.
	Ci si arriva dalle pagine delle gite, con "Iscriviti", oppure chiedendo di entrare
	nell'area riservata.  -->
<head>
  <title>FIAB Torino Bici e Dintorni - richiesta reimpostazione password area riservata</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">

<?php
/**
 * Reqpass.php File Doc Comment
 *
 * PHP version 5.3
 * Programma che permette di inviare una email all'utente che
 * non ricorda la password
 *
 * @category Programma
 * @package  /lib
 * @author   Antonino Di Bella 
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */
include_once(dirname(__FILE__)."/class.php");
 //makeHead("Amministrazione - Recupero password"); ?>

<div class="row">
		<div class="col-xs-12 text-center"><h3>FIAB Torino Bici e Dintorni - Reimpostazione password area soci</h3></div></div>
  <form class="form-group" name="login" method="post" action="http://www.biciedintorni.it/application/admin.php?reqpass=1&sub=1">
	<!-- <table align="center" width="200px">
	  <tr class="row">
		<td align="center"><p>Per recuperare la password dovete compilare i campi sottostanti.<br>Il sistema cercherà nel database i vostri dati e se esistono vi invierà automaticamente una e-mail.</p></td>
	  </tr>
	  <tr class="row">
		<td><input class="form-control" type="text" placeholder="nome" size="50" name="nome" maxlength="50" required></td>
	  </tr>
	  <tr class="row">
		<td><input class="form-control" placeholder="cognome" type="text" size="50" name="cognome" maxlength="50" required></td>
	  </tr>
	  <tr class="row">
		<td><input class="form-control" placeholder="indirizzo email" type="text" size="50" name="email" maxlength="50" required></td>
	  </tr>
	  <tr  class="row">
		<td align="right" >
			<input type="submit" class="btn" value="Invia"/>
		</td>
	  </tr>
	  <tr  class="row">
		<td><a style="text-decoration:none;" href="http://www.biciedintorni.it/wordpress/">Torna alla Home Page del sito.</a></td>
	  </tr>
	  <tr>
		<td><? echo $message; ?></td>
	  </tr>
	</table> -->
	  <div class="row">
		<div class="col-xs-12 text-center">Per reimpostare la password dovete compilare i campi sottostanti.<br>Il sistema cercherà nel database i vostri dati e se esistono vi invierà automaticamente una email.</div>
	  </div>
	  <div class="row">
		<div class="col-xs-12"><input class="form-control" type="text" placeholder="nome" 
		size="50" name="nome" maxlength="50" required></div>
	  </div>
	  <div class="row">
		<div class="col-xs-12"><input class="form-control" placeholder="cognome" 
		type="text" size="50" name="cognome" maxlength="50" required></div>
	  </div>
	  <div class="row">
		<div class="col-xs-12"><input class="form-control" placeholder="indirizzo email" 
		type="email" size="50" name="email" maxlength="50" required></div>
	  </div>
	  <div  class="row">
		<div class="col-xs-12" align="right" ><input type="submit" class="btn" value="Invia"/></div>
	  </div>
	  <div  class="row">
		<div class="col-xs-12"><a href="http://www.biciedintorni.it/wordpress/">Torna alla Home Page del sito.</a></div>
	  </div>
	  <div  class="row">
		<div class="col-xs-12"><? echo $message; ?></div>
	  </div>
  </form>


<?php
 makeTail(); ?>
 
   </div>
 </body>
</html>