<?php
/**
Db_mysql.php File Doc Comment
 *
 * PHP version 5.3
 * Programma che gestisce l'accesso al db per tutta l'applicazione.
 * Convertito l'accesso a mysqli da Adriano Comai a febbraio 2016.
 * La versione precedente usava mysql, non più supportato da php 7
 *
 * @category Programma
 * @package  Root
 * @author   Adriano Comai <adriano-liste@fastwebnet.it>
 * @license  Proprietà FIAB Torino Bici e Dintorni
 * @link     http://www.biciedintorni.it/
 */

if (file_exists("lib/config.php")) {
    include_once "lib/config.php"; 
}
else {
    include_once "config.php"; 
}

class db_local
{
    var $host = DB_HOST;  
    var $user = DB_USER;  
    var $password = DB_PASS;
    var $database = DB_NAME;
  
    var $link_id  = 0;        // risultato della connessione.
    var $query_id = 0;        // risultato della funzione query() recente.
    var $record   = array();  // risultato corrente della funzionecurrent mysqli_fetch_array().
    var $recordass   = array();  // risultato corrente della funzionecurrent mysqli_fetch_assoc().
    var $row;                    // current row number.

    var $errno    = 0;          // error state della query...
    var $error    = "";

    function halt($msg) 
    {
        printf("<b>database error:</b> %s<br>\n", $msg);
        printf("<b>mysql error</b>: %s (%s)<br>\n", $this->errno, $this->error);
        die("session halted."); // restituisce i messaggi di errore.
    }



    function query($query_string,$new_conn = false) 
    {
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        /* check connection 
        if (mysqli_connect_errno()) {
        	printf("Connect failed: %s\n", mysqli_connect_error());
        	exit();
        }
        
        printf("Initial character set: %s\n", $conn->character_set_name());
        */
        /* change character set to utf8  */
        if (!$conn->set_charset("utf8")) {
        	printf("Error loading character set utf8: %s\n", $conn->error);
        	exit();
        } 
        /*else {
        	printf("Current character set: %s\n", $conn->character_set_name());
        }
        */
        //$result = $conn->query($query_string);
        $this->query_id = $conn->query($query_string);
        $this->link_id = $conn;

        $this->row   = 0;
    
        if (!$this->query_id) {
            $this->halt("invalid sql: ".$query_string); 
        }

        return $this->query_id;
    }

    function next_record($result_type = MYSQLI_BOTH)
    {
        $this->record = mysqli_fetch_array($this->query_id, $result_type);
        $this->row   += 1;

        $stat = is_array($this->record);
        if (!$stat) {
            mysqli_free_result($this->query_id);
            $this->query_id = 0;
        }
        return $stat;
    }

    function num_rows() 
    {
        return mysqli_num_rows($this->query_id);
    }
  
    // restituisce in un vettore i nomi dei campi della tabella specificata.
    // funzione da modificare per adeguarla a mysqli_ Sembra comunque non usata.
    function name_fields($table) 
    {
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
        mysqli_close($this->link_id);
    }    
}
?>