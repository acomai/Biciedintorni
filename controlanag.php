<?php 
include_once("lib/db_mysql.php");
include_once("lib/class.php");
$dbanag2008 = new db_local();
$dbanag = new db_local();
$dbanag2008->query("SELECT * FROM anag2008");
$i = 0;
while($dbanag2008->next_record())
{
	$dbanag->query("SELECT * FROM anagrafiche WHERE TRIM(nome) LIKE \"%".trim($dbanag2008->record['nome'])."%\" AND TRIM(cognome) LIKE \"%".trim($dbanag2008->record['cognome'])."%\"");
	echo "SELECT * FROM anagrafiche WHERE TRIM(nome) LIKE \"%".trim($dbanag2008->record['nome'])."%\" AND TRIM(cognome) LIKE \"%".trim($dbanag2008->record['cognome'])."%\"<br>";
	echo "nrow: ".$dbanag->num_rows()."<br>";
	if($dbanag->num_rows() == 1 && $dbanag->next_record() )
	{
		$dbanag2008->query("SELECT id FROM anag2008 WHERE '".trim($dbanag->record['nome'])."' LIKE CONCAT(CONCAT('\"%',TRIM(nome)),'%\"') AND '".trim($dbanag->record['cognome'])."' LIKE CONCAT(CONCAT('\"%',TRIM(cognome)),'%\"')");
		echo "SELECT id FROM anag2008 WHERE '".trim($dbanag->record['nome'])."' LIKE CONCAT(CONCAT('\"%',TRIM(nome)),'%\"') AND '".trim($dbanag->record['cognome'])."' LIKE CONCAT(CONCAT('\"%',TRIM(cognome)),'%\"')<br>";
		echo "nrow: ".$dbanag2008->num_rows()."<br>";
		if($dbanag2008->num_rows() == 1 && $dbanag2008->next_record())
		{
			$id = $dbanag2008->record['id'];
			$dbanag2008->query("DELETE FROM anag2008 WHERE id = ".$id);
			$dbanag2008->query("SELECT * FROM anag2008 AND id > ".$id);	
			$i++;
			
			//  "SELECT id FROM anag2008 WHERE 'ciccio' LIKE CONCAT(CONCAT('%',TRIM(nome)),'%') AND 'ciccio' LIKE CONCAT(CONCAT('%',TRIM(cognome)),'%')"
			
		}
		$id = 0;
	}
}
echo "Eliminate: $i righe."
?>