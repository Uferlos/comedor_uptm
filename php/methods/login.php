<?php
include '../config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$usu = $_POST['us'];
$pss = MD5($_POST['ps']);

$query = "SELECT nusu, nom, tipo FROM usuarios WHERE nusu = '$usu' AND clave = '$pss'";

if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}

if($row = $res->fetch_assoc()){

	$arr = array(
		'confirm' => 1,
		'nusu' => $row['nusu'],
		'nom' => $row['nom'],
		'tipo' => $row['tipo']
	);
	echo json_encode($arr);
}else{
	$arr = array('confirm' => 0);
	echo json_encode($arr);
}
?>