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

//Registrieren Funktion
function register($username, $email, $password){
	$db = get_db_connection();
	$sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?);";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($username, $email, $password));
}

// Überprüfung, ob die E-Mail-Adresse in der Tabelle users vorhanden ist.
function email_check($email){
	$db = get_db_connection(); // DB-Verbindung herstellen (s. login())
	$sql = "SELECT * FROM user where email = '$email';";
	$result = $db->query($sql);
	if($result->rowCount() > 0){
		return true;
	};
	return false;
}

function get_user_by_id($id){
	$db = get_db_connection();
	$sql = "SELECT * FROM user WHERE id = $id;";
	$result = $db->query($sql);
	return $result->fetch();
}

function request_input($title, $description, $user, $category_id){
	$db = get_db_connection();
	$sql = "INSERT INTO request (title, description, autor, category_id) VALUES (?, ?, ?, ?);";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($title, $description, $user, $category_id));
}


function get_request(){
	$db = get_db_connection();
	$sql = "SELECT * FROM request ORDER BY id DESC;";
	$result = $db->query($sql);
	return $result->fetchAll();
}

function get_category(){
	$db = get_db_connection();
	$sql = "SELECT * FROM categories;";
	$result = $db->query($sql);
	return $result->fetchAll();
}

function get_category_by_id($id){
	$db = get_db_connection();
	$sql = "SELECT * FROM categories WHERE id=$id;";
	$result = $db->query($sql);
	$row = $result->fetch();
	return $row;
}

function get_request_by_category(){
	$db = get_db_connection();
	$sql = "SELECT * FROM request WHERE category_id = $category;";
	$result = $db->query($sql);
	$row = $result->fetch();
	return $row;
}

?>
