<?php

//Datenbankverbindung aufbauen
function get_db_connection(){
	global $db_host, $db_name, $db_user, $db_pass, $db_charset;

	$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset";
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false
	];

	try {
		$db = new PDO($dsn, $db_user, $db_pass, $options);
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	return $db;
}

//Login Funktion
function login($username, $password){
		$db = get_db_connection();
		$sql = "SELECT * FROM user WHERE username='$username' AND password='$password';";
		$result = $db->query($sql);

		if($result->rowCount() == 1){
			$row = $result->fetch();
			return $row;
		}else{
			return false;
	}
}

function get_user_by_id($user_id){
	$db = get_db_connection();
	$sql = "SELECT * FROM user WHERE id=$user_id;";
}



?>
