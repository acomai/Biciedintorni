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
 makeHead("Amministrazione - Recupero password"); ?>
<div align="center" style="font-style: italic;"><h3>Amministrazione - Recupero password</h3></div><br>
  <form name="login" method="post" action="http://www.biciedintorni.it/application/admin.php?reqpass=1&sub=1">
	<table align="center" width="200px">
	  <tr>
		<td colspan="2" align="center">Per recuperare la password dovete compilare i campi sottostanti.<br>Il sistema cercher&agrave; nel database i vostri dati e se esistono vi invier&agrave; automaticamente una e-mail.</td>
	  </tr>
	  <tr>
		<td>Nome:</td><td><input class="inp" type="text" size="50" name="nome" maxlength="50"></td>
	  </tr>
	  <tr>
		<td>Cognome:</td><td><input class="inp" type="text" size="50" name="cognome" maxlength="50"></td>
	  </tr>
	  <tr>
		<td>E-Mail:</td><td><input class="inp" type="text" size="50" name="email" maxlength="50"></td>
	  </tr>
	  <tr>
		<td colspan="2" align="right">
			<input type="submit" value="Invia"/>
		</td>
	  </tr>
	  <tr>
		<td colspan="2" align="right"><a style="text-decoration:none;" href="http://www.biciedintorni.it/wordpress/">Torna alla Home Page del sito.</a></td>
	  </tr>
	  <tr>
		<td colspan="2" align="right"><? echo $message; ?></td>
	  </tr>
	</table>
  </form>
</div>

<?php
 makeTail(); ?>