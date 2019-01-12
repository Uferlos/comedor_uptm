<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$hoy = $_GET['date'];

$query = "SELECT COUNT(*) AS total FROM asistencia WHERE fecha = '$hoy' ORDER BY fecha ASC";
$query2 = "SELECT COUNT(*) AS total2 FROM asistenciaC WHERE fecha = '$hoy' ORDER BY fecha ASC";

$res = $db->query($query);
$row = $res->fetch_assoc();

$res2 = $db->query($query2);
$row2 = $res2->fetch_assoc();

$total = ($row['total'] + $row2['total2']);

$q = "SELECT asistencia.carnet, estudiante.carnet AS carEs, estudiante.nombre, estudiante.apellido, estudiante.carrera, estudiante.trayecto, estudiante.cedula FROM asistencia INNER JOIN estudiante ON asistencia.carnet = estudiante.carnet WHERE asistencia.fecha = '$hoy' ORDER BY asistencia.fecha ASC";

$q2 = "SELECT asistenciaC.ced, docente.nom, docente.ced, docente.ape, docente.tlf FROM asistenciaC INNER JOIN docente ON asistenciaC.ced = docente.ced WHERE asistenciaC.fecha = '$hoy' ORDER BY fecha ASC";

$r1 = $db->query($q);
$r2 = $db->query($q2);


$h = explode('-', $hoy);
$fixed = $h[2]."/".$h[1]."/".$h[0];
include '../html/files.html';
?>
<div class="container-fluid">
<div class="col"><br></div>
<div class="col">
<?php if($total > 0): ?>
	<div class="alert alert-info" role="alert" align="center">
	  <h4 class="alert-heading">Reporte de bandejas para este día</h4>
	  <p>
	  	Total de bandejas entregadas el día 
	  	<?php echo $fixed.": ". $total ?>
	  </p>
	</div>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">¡Reporte vacio!</h4>
	  <p>
	  	No hay registros en la base de datos del comedor para este dia (<?php echo $fixed ?>).
	  </p>
	</div>
<?php endif; ?>

	<div class="row">
		<div class="col">
			
			<?php if($r1->num_rows): ?>
			<table class="table table-bordered">
				<thead><th colspan="6" style="text-align: center;">Alumnos Asistentes</th></thead>
				<tr>
					<th>Nombres</th>
    			<th>Apellidos</th>
    			<th>PNF</th>
    			<th>Trayecto</th>
    			<th>Cedula</th>
          <th>Carnet</th>
				</tr>
				<?php while($ro1 = $r1->fetch_assoc()): ?>
				<tr>
					<td class="text-capitalize"><?php echo $ro1['nombre'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['apellido'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['carrera'] ?></td>
    			<td class="text-uppercase"><?php echo $ro1['trayecto'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['cedula'] ?></td>
          <td class="text-capitalize"><?php echo $ro1['carEs'] ?></td>
				</tr>
				<?php endwhile; ?>
			</table>
		  <?php endif; //est table
			
			if($r2->num_rows): ?>
			<table class="table table-bordered">
				<thead><th colspan="4" style="text-align: center;">Docentes Asistentes</th></thead>
				<tr>
					<th>Nombres</th>
    			<th>Apellidos</th>
    			<th>Cedula</th>
          <th>Teléfono</th>
				</tr>
				<?php while($ro2 = $r2->fetch_assoc()): ?>
				<tr>
					<td class="text-capitalize"><?php echo $ro2['nom'] ?></td>
    			<td class="text-capitalize"><?php echo $ro2['ape'] ?></td>
    			<td class="text-capitalize"><?php echo $ro2['ced'] ?></td>
          <td class="text-capitalize"><?php echo $ro2['tlf'] ?></td>
				</tr>
				<?php endwhile;
			endif; //doc table ?>
		  </table>
		</div>
	</div>
	<br>

</div>
<div class="col"></div>

<script>
	window.print()
</script>