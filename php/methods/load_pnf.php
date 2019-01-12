<?php
include '../config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$query = "SELECT * FROM pnf ORDER BY nom ASC";
if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}

if($res->num_rows){
	$data = "<option value=''>---------</option>";
	while($row = $res->fetch_assoc()){
		$data .= "<option value='".$row['nom']."'>".$row['nom']."</option>";
	}
}else{
	$data = "<option value=''>---------</option>";
}

$response[0] = array('data' => $data);
echo json_encode($response);
?>