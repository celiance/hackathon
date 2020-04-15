<?php

// Datenbank Verbindung aufbauen
// Siehe: https://www.php-einfach.de/mysql-tutorial/crashkurs-pdo/
// Siehe: https://www.php-einfach.de/mysql-tutorial/verbindung-aufbauen/
// Siehe: https://phpdelusions.net/pdo#dsn

function get_db_connection(){

	/* Die in config.php festgelegten Variablen gelten innerhalb einer Funktion standardmässig NICHT.
	Um sie innerhalb einer Funktion zugänglich zu machen, müssen sie mit dem Schlüsselwort global innerhalb der Funktion gekennzeichnet werden.
	Siehe: https://www.php.net/manual/de/language.variables.scope.php
	*/
	global $db_host, $db_name, $db_user, $db_pass, $db_charset;

	$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset"; // siehe https://en.wikipedia.org/wiki/Data_source_name
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false
	];

	// Einfache Version der DB-Verbindung
	//$db = new PDO($dsn, $user, $pass, $options);

	// Ausführliche Version der DB-Verbindung
	try {
		$db = new PDO($dsn, $db_user, $db_pass, $options);
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	// Wir geben die in der Variablen $db gespeicherte Datenbankverbindung
	//   als Ergebnis der Funktion zurück.
	return $db;
}



/************************ GRUNDLEGENDE BEFEHLE ************************/

// Einloggen
// Der Funktion benötigt zwei Parameter, die E-Mail-Adresse und das Passwort des Users.
function login($email, $password){
	// Wir stellen über die Funktion get_db_connection() (siehe oben) eine DB-Verbindung her
	//   und speichern sie in der Variablen $db.
	//   ($db ist ein Objekt der PDO-Klasse, welche von PHP zur verfügung gestellt wird.)
	$db = get_db_connection();

	// Wir formulieren die SQL-Abfrage und speichern sie in der Variablen $sql.

	//       !!!!! ACHTUNG !!!!!
	// !!!!! Die direkte Formulierung als SQL-Statement ist aus Sicherheitsgründen nicht zu  empfehlen.
	// !!!!! PDO stellt sog. perpared Statements zur Verfügung.
	// !!!!! Sie verhindern wirkungsvoll Hackerangriffe SQL-Injections.
	// !!!!! Siehe: https://www.php-einfach.de/mysql-tutorial/php-prepared-statements/
	// !!!!! Siehe: https://phpdelusions.net/pdo#prepared
	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password';";

	// Mit der query()-Methode schicken wir die SQL-Abfrage an die DB und
	//   speichern das Ergebnis in der Variablen $result.
	$result = $db->query($sql);

	// Die Methode rowCount() liefert die Anzahl der Ergebnisse zurück.
	// Für einen erfolgreichen Login muss genau ein Ergebnis zurückgegeben werden.
	if($result->rowCount() == 1){    // Wenn es genau ein Ergebnis gibt ...
		// ... wandeln wir mit der fetch()-Methode das Ergebnis in ein assoziatives Array um
		//   und speichern es in der Variablen $row.
		// Die Bezeichner des Assoziativen Arrays sind die Namen der Datenbankspalten der Tabelle user.
		$row = $result->fetch();

		// Den Wert aus $row geben wir als Ergebnis der Funktion zurück.
		return $row;
	}else{          // Wenn es mehr oder weniger als genau ein Ergebnis gibt ...
		// ... geben wir als Ergebnis der Fuktion den Wert false zurück.
		return false;
	}
}


/* *********************************************************
/* INSERT BEFEHLE
/* ****************************************************** */


// Registrieren
/* Neue Benutzerdaten werden in die User Datenbank gespeichert */
function save_user($email, $password, $firstname, $lastname){
	$db = get_db_connection();  // DB-Verbindung herstellen (s. login())
	// Das PHP-Datenbank-Interface PDO stellt sog. prpared statements zur Verfügung.
	// siehe: https://www.php-einfach.de/mysql-tutorial/crashkurs-pdo/
	// Dabei stehen im SQL-Statement Fragezeichen als Platzhalter für die zu übertragenden Werte.
	$sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?);";
	// Im folgenden Schritt wird das Statement mit $db->prepare($sql) vorbereitet und in einer Variablen gespeichert.
	$stmt = $db->prepare($sql);
	// Mit der execute()-Methode wird die Abfrage ausgeführt.
	// Dabei müssen die einzusetzenden Werte als Array übermittelt werden.
	// Innerhalb des Arrays müssen die Werte die richtige Reihenfolge haben.
	// Da es sich bei dem Statement um einen INSERT-Befehl handelt,
	//   wird als Ergebnis true fur eine erfolgreiche Speicherung
	//   und false für eine misslungene Speicherung zurückgegeben
	return $stmt->execute(array($email, $password, $firstname, $lastname));
}


// Fragen
function write_question($title, $question){
	$db = get_db_connection();
	$sql = "INSERT INTO threads (title, content) VALUES (?,?);";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($title, $question));
}

function write_question_login($title, $question, $owner_id = 0){
	$db = get_db_connection();
	$sql = "INSERT INTO threads (title, content, owner) VALUES (?,?,?);";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($title, $question, $owner_id));
}

// Antworten
function write_answer($title, $answer_content, $parent_question_id){
	$db = get_db_connection();
$sql = "INSERT INTO threads (title, content, parent_thread_id) VALUES (?,?,?);";
$stmt = $db->prepare($sql);
return $stmt->execute(array($title, $answer_content, $parent_question_id));
}

function write_answer_login($title, $answer_content, $parent_question_id, $owner_id = 0){
	$db = get_db_connection();
$sql = "INSERT INTO threads (title, content, parent_thread_id, owner) VALUES (?,?,?,?);";
$stmt = $db->prepare($sql);
return $stmt->execute(array($title, $answer_content, $parent_question_id, $owner_id));
}

/************************ SELECT BEFEHLE ************************/

// User Daten auslesen
/* Die Daten des eingeloggten Benutzers werden via User_Id ausgelesen */
// Die Funktion verläuft in einer etwas verkürzten Version analog zur login()-Funktion
function get_user_by_id($id){
	$db = get_db_connection();
	$sql = "SELECT * FROM users WHERE id = $id;";
	$result = $db->query($sql);
	return $result->fetch();
}

// Überprüfung, ob die E-Mail-Adresse in der Tabelle users vorhanden ist.
function does_email_exist($email){
	$db = get_db_connection(); // DB-Verbindung herstellen (s. login())
	$sql = "SELECT * FROM users where email = '$email';";
	$result = $db->query($sql);
	if($result->rowCount() > 0){
		return true;
	};
	return false;
}


function get_all_questions(){
	$db = get_db_connection();
	$sql = "SELECT * FROM threads WHERE parent_thread_id = 0;";
	$result = $db->query($sql);
	return $result->fetchAll();
}


function get_question_by_id($id){
	$db = get_db_connection();
	$sql = "SELECT * FROM threads WHERE id=$id;";
	$result = $db->query($sql);
	//return $result->fetchAll();
	$row = $result->fetch();

	// Den Wert aus $row geben wir als Ergebnis der Funktion zurück.
	return $row;
}


function get_answers($id){
	$db = get_db_connection();
	$sql = "SELECT * FROM threads WHERE parent_thread_id=$id;";
	$result = $db->query($sql);
	return $result->fetchAll();
}




/************************ UPDATE BEFEHLE ************************/

function update_thread($title, $question, $thread_id){
	$db = get_db_connection();
	$sql = "UPDATE threads SET title=?, content=? WHERE id=?;";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($title, $question, $thread_id));
}



/************************ DELETE BEFEHLE ************************/

function delete_thread($thread_id){
	$db = get_db_connection();
	$sql = "DELETE FROM threads WHERE id=?;";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($thread_id));
}

function delete_child_threads($thread_id){
	$db = get_db_connection();
	$sql = "DELETE FROM threads WHERE parent_thread_id=?;";
	$stmt = $db->prepare($sql);
	return $stmt->execute(array($thread_id));
}
