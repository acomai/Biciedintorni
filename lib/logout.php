<?php
	// phpversion = 4
	session_start();
	// session hack to make sessions on old php4 versions work
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	unset($_SESSION['dove']);
	if(isset($db))
	{
		$db->close(); 
		unset($db);
	}
	session_destroy();
	$sessionPath = session_get_cookie_params(); 
	setcookie(session_name(), "", 0, $sessionPath["path"], $sessionPath["domain"]);
	include("admin.php")
?>