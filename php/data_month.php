<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}
date_default_timezone_set('America/Caracas');
$f = date('m');
if($_POST['date'] != ''): $mes = $_POST['date']; else: $mes = $f; endif;

$query = "SELECT COUNT(*) AS total FROM asistencia WHERE month = '$mes' ORDER BY fecha ASC";
$query2 = "SELECT COUNT(*) AS total2 FROM asistenciaC WHERE month = '$mes' ORDER BY fecha ASC";
$query3 = "SELECT COUNT(*) AS total3 FROM asistenciaO WHERE month = '$mes' ORDER BY fecha ASC";

$res = $db->query($query);
$row = $res->fetch_assoc();

$res2 = $db->query($query2);
$row2 = $res2->fetch_assoc();

$res3 = $db->query($query3);
$row3 = $res3->fetch_assoc();

$total = ($row['total'] + $row2['total2'] + $row3['total3']);
?>

<div class="col"></div>
<div class="col">
<?php if($total > 0): ?>
	<div class="alert alert-info" role="alert">
	  <h4 class="alert-heading">Reporte de bandejas para este Mes</h4>
	  <p>
	  	Total de bandejas entregadas en el mes 
	  	<?php echo $mes.": ". $total ?>
	  </p>
	</div>
	<br>
	<button type="button" id="print" class="btn btn-bg btn-success">Imprimir</button>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">¡Reporte vacio!</h4>
	  <p>
	  	No hay registros en la base de datos del comedor para este mes.
	  </p>
	</div>
<?php endif; ?>
</div>
<div class="col"></div>

<script>
	$('#print').click(function(){
		window.print()
	})
</script>