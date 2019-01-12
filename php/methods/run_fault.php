<?php
include '../config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$f = date('Y-m-d');
$dia = date('l');

$qA = "SELECT carnet FROM asistencia WHERE fecha = '$f'";

$qR = "SELECT dias, carnet FROM registro";

$resA = $db->query($qA);
$resR = $db->query($qR);

$cedA = array(); //todos asistentes
$cedR = array(); //todos registrados

$cedG = array(); //asistentes del dia
$cedF = array(); //faltantes

while($rA = mysqli_fetch_array($resA)){
	$cedA[] = $rA[0];
}
while($rR = mysqli_fetch_array($resR)){
	$cedR[] = $rR[1];
}

/*
if($dia == 'Monday'){$dfix = 'Lunes';}
elseif($dia == 'Tuesday'){$dfix = 'Martes';}
elseif($dia == 'Wednesday'){$dfix = 'Miercoles';}
elseif($dia == 'Thursday'){$dfix = 'Jueves';}
elseif($dia == 'Friday'){$dfix = 'Viernes';}
*/

for($i = 0; $i < count($cedR); $i++){
	for($j = 0; $j < count($cedA); $j++){
		if($cedR[$i] == $cedA[$j]){
			$cedG[] = $cedA[$j];
		}
	}
}


var_dump($cedR, $cedA, $cedG, $cedF);
?>