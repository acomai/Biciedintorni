<?php
if (file_exists("lib/config.php"))
	require_once("lib/config.php");
else
	require_once("config.php");
class db_local {
  var $host = DB_HOST;  
  var $user = DB_USER;  
  var $password = DB_PASS;
  var $database = DB_NAME;
  
  var $link_id  = 0;		// risultato della funzione mysql_connect().
  var $query_id = 0;		// risultato della funzione mysql_query() recente.
  var $record   = array();  // risultato corrente della funzionecurrent mysql_fetch_array().
  var $recordass   = array();  // risultato corrente della funzionecurrent mysql_fetch_assoc().
  var $row;					// current row number.

  var $errno    = 0;  		// error state della query...
  var $error    = "";

  function halt($msg) {
	printf("<b>database error:</b> %s<br>\n", $msg);
	printf("<b>mysql error</b>: %s (%s)<br>\n", $this->errno, $this->error);
	die("session halted."); // restituisce i messaggi di errore.
  }

# connessione al Database.
  function connect($new_conn = false) {
	if ( 0 == $this->link_id ) {
		$this->link_id = mysql_connect($this->host, $this->user, $this->password,$new_conn);
	  	$this->errno = mysql_errno();
		$this->error = mysql_error();
	  
	  if (!$this->link_id)
		$this->halt("link-id == false, connect failed");
	  
	  if (!mysql_query(sprintf("use %s",$this->database),$this->link_id))
		$this->halt("cannot use database ".$this->database);
	}
  }

  function query($query_string,$new_conn = false) {
	$this->connect($new_conn);

	$this->query_id = mysql_query($query_string,$this->link_id);
	$this->row   = 0;
	$this->errno = mysql_errno();
	$this->error = mysql_error();
	
	if (!$this->query_id)
	  $this->halt("invalid sql: ".$query_string);

	return $this->query_id;
  }

  function next_record($result_type = MYSQL_BOTH)
  {
	$this->record = mysql_fetch_array($this->query_id,$result_type);
	$this->row   += 1;
	$this->errno = mysql_errno();
	$this->error = mysql_error();

	$stat = is_array($this->record);
	if (!$stat) {
	  mysql_free_result($this->query_id);
	  $this->query_id = 0;
	}
	return $stat;
  }

  function num_rows() {
	return mysql_num_rows($this->query_id);
  }
  
  # restituisce in un vettore i nomi dei campi della tabella specificata.
  function name_fields($table) {
	$vet = array ();
	$campi = mysql_list_fields($this->database, $table, $this->link_id);
	$colonne = mysql_num_fields($campi);

	for ($i = 0; $i < $colonne; $i++) {
	  $vet[] = mysql_field_name($campi, $i);
	}
	return $vet;
  }

  function close()
  {
	#if($this->link_id)
	  #mysql_free_result($this->query_id);
	mysql_close($this->link_id);
  }	
}
?>