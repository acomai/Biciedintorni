<?php
include_once("lib/db_mysql.php");
$db = new db_local();
$db->query("SELECT * FROM anagrafiche;",true);

$length = '4';
$withchar = 'no';
if (!$lowers){ $lowers = 'no'; }
if (!$uppers){ $uppers = 'no'; }
if (!$nums){ $nums = 'yes'; }

/*$char[] = 'a'; $char[] = 'b'; $char[] = 'c'; $char[] = 'd'; $char[] = 'e';$char[] = 'f';$char[] = 'g';$char[] = 'h';$char[] = 'i';
$char[] = 'j'; $char[] = 'k'; $char[] = 'l'; $char[] = 'm'; $char[] = 'n';$char[] = 'o';$char[] = 'p';$char[] = 'q';$char[] = 'r';
$char[] = 's'; $char[] = 't'; $char[] = 'u'; $char[] = 'v'; $char[] = 'w';$char[] = 'x';$char[] = 'y';$char[] = 'z';

$char[] = 'A';$char[] = 'B';$char[] = 'C';$char[] = 'D';$char[] = 'E';$char[] = 'F';$char[] = 'G';$char[] = 'H';$char[] = 'I';
$char[] = 'J';$char[] = 'K';$char[] = 'L';$char[] = 'M';$char[] = 'N';$char[] = 'O';$char[] = 'P';$char[] = 'Q';$char[] = 'R';
$char[] = 'S';$char[] = 'T';$char[] = 'U';$char[] = 'V';$char[] = 'W';$char[] = 'X';$char[] = 'Y';$char[] = 'Z';
*/
$char[] = '0';$char[] = '1';$char[] = '2';$char[] = '3';$char[] = '4';$char[] = '5';$char[] = '6';$char[] = '7';$char[] = '8';$char[] = '9';

$num = count($char);$num -= 1;
while($db->next_record())
{
	for ($i = 0; $i < 9; $i++){
		srand((double)microtime()*1000000);
		$randnum = rand(0,$num);
		$password .= "$char[$randnum]";
		$randnum = rand(0,$num);
		$password .= "$char[$randnum]";
		//$seme = (double)microtime()*1000000;
		//echo ">".$seme."<<br>";
		//echo ">".$randnum."---".$char[$randnum]."<<br>";
	}
	$db2 = new db_local();
	$password = substr("$password",0,$length);
	$user = $db->record["user"];
	$pass = str_replace(' ','',strtolower($db->record["nome"].$password));
	$pass = str_replace("'",'',$pass);
	$pass = str_replace(".",'',$pass);
	$pass = str_replace(";",'',$pass);
	$pass = str_replace(":",'',$pass);
	$pass = str_replace('"','',$pass);
	$strqry = "UPDATE anagrafiche SET passch = '0', pass = MD5('".$pass."'), pw = '".$pass."' WHERE anagrafiche.user = '".$user."' AND anagrafiche.carica = 'AS'  LIMIT 1;";
	//$strqry = "UPDATE anagrafiche SET passch = '0', pw = '$pass' WHERE anagrafiche.user = '$user' AND anagrafiche.carica = 'AS'  LIMIT 1;";
	$db2->query($strqry,true);
//	echo "$strqry <br> username=".$user."<br>password=".$password."<br>--------<br>";
	
	if ($db->record["carica"] == 'AS')
		echo "username = ".$user."     --->     email = ".$db->record["email"]."<br>password = ".$pass."<br><br>";
	$password = "";
	$pass = "";
}
$db->close();
$db2->close();
//UPDATE `anagrafiche` SET `pass` = MD5('ciaobella') WHERE `anagrafiche`.`id` = 000000 LIMIT 1;
?>