<?php

//header("content-type: application/json");

/*
try {
    $myPDO = new PDO('sqlite:/var/www/html/demo.db');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
*/

require_once('creds.php');

try {
    $DBH = new PDO("mysql:host=localhost;dbname=chrisdb", $user, $password, array(PDO::ATTR_PERSISTENT => false));
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo $e->getMessage(); 
}

$index = 0;
if (isset($_GET["index"])) {
	$index = $_GET["index"];
}

$stmt = $DBH->prepare("select * from messages where id > :index order by id asc");
$stmt->execute( array(":index" => $index) );

$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
$json=json_encode($results);
echo $json;

?>
