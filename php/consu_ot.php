<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$ci = $_POST['ci'];
$nomape = $_POST['nomape'];

date_default_timezone_set('America/Caracas');
$today = date('Y-m-d');
$week = date('W');
$month = date('m');

$query = "INSERT INTO asistenciaO VALUES(null, '$nomape', '$ci', '$today', '$week', '$month')";

if($db->query($query)): ?>
  <script>
    alert('¡Registrado!')
  </script><?php
else: ?>
  <script>
    alert("Error <?php echo $db->error; ?>")
  </script><?php
endif;
?>