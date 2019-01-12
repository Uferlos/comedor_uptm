<?php
include '../config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$nom = $_POST['val'];

$query = "SELECT cterm FROM pnf WHERE nom = '$nom'";
if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}
$row = $res->fetch_assoc();

echo $row['cterm'];

?>