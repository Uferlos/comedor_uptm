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

while($row = $res->fetch_assoc()){
	$a = substr($row['nom'], 0, 4);
	$b = explode(' ', $row['nom']);
	echo '<a href="javascript:void(0)" id="list_pnf_'.$a.'" class="list-group-item list" data-parent="#submenu1"><span class="oi oi-chevron-right"></span><span class="d-none d-md-inline text-capitalize">'.$b[0].'</span></a>';
}
?>