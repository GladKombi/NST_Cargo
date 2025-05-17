<?php
try {
	session_start();

	// $connexion=new PDO('mysql:dbname=.....; host=mysql.us.cloudlogin.co', '.....', '.....');
	$connexion = new PDO('mysql:dbname=nst_cargo_bd; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e;
}
