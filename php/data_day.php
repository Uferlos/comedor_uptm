<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}
date_default_timezone_set('America/Caracas');
$f = date('Y-m-d');
if($_POST['date'] != ''): $hoy = $_POST['date']; else: $hoy = $f; endif;

$query = "SELECT COUNT(*) AS total FROM asistencia WHERE fecha = '$hoy' ORDER BY fecha ASC";
$query2 = "SELECT COUNT(*) AS total2 FROM asistenciaC WHERE fecha = '$hoy' ORDER BY fecha ASC";
$query3 = "SELECT COUNT(*) AS total3 FROM asistenciaO WHERE fecha = '$hoy' ORDER BY fecha ASC";

$res = $db->query($query);
$row = $res->fetch_assoc();

$res2 = $db->query($query2);
$row2 = $res2->fetch_assoc();

$res3 = $db->query($query3);
$row3 = $res3->fetch_assoc();

$total = ($row['total'] + $row2['total2'] + $row3['total3']);

//pag est
$limit = 10;
$init = 0;

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $init = ($id-1) * $limit;
}else{
  $id = 1;
}

//pag doc
$limitD = 10;
$initD = 0;

if(isset($_POST['idD'])){
  $idD = $_POST['idD'];
  $initD = ($idD-1) * $limitD;
}else{
  $idD = 1;
}

//ot doc
$limitO = 10;
$initO = 0;

if(isset($_POST['idO'])){
  $idO = $_POST['idO'];
  $initO = ($idO-1) * $limitO;
}else{
  $idO = 1;
}


$q = "SELECT asistencia.carnet, estudiante.carnet AS carEs, estudiante.nombre, estudiante.apellido, estudiante.carrera, estudiante.trayecto, estudiante.cedula FROM asistencia INNER JOIN estudiante ON asistencia.carnet = estudiante.carnet WHERE asistencia.fecha = '$hoy' ORDER BY asistencia.fecha ASC LIMIT $init, $limit";

$q2 = "SELECT asistenciaC.ced, docente.nom, docente.ced, docente.ape, docente.tlf FROM asistenciaC INNER JOIN docente ON asistenciaC.ced = docente.ced WHERE asistenciaC.fecha = '$hoy' ORDER BY asistenciaC.fecha ASC LIMIT $initD, $limitD";

$q3 = "SELECT * FROM asistenciaO WHERE fecha = '$hoy' ORDER BY fecha ASC LIMIT $initO, $limitO";

$r1 = $db->query($q);
$r2 = $db->query($q2);
$r3 = $db->query($q3);

$h = explode('-', $hoy);
$fixed = $h[2]."/".$h[1]."/".$h[0];
?>

<input type="hidden" id="fec" value="<?php echo $hoy ?>">
<div class="col"></div>
<div class="col">
<?php if($total > 0): ?>
	<div class="alert alert-info" role="alert">
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
				<thead><th colspan="6">Alumnos Asistentes</th></thead>
				<thead class="thead-dark">
					<th>Nombres</th>
    			<th>Apellidos</th>
    			<th>PNF</th>
    			<th>Trayecto</th>
    			<th>Cedula</th>
          <th>Carnet</th>
				</thead>
				<?php while($ro1 = $r1->fetch_assoc()): ?>
				<tr>
					<td class="text-capitalize"><?php echo $ro1['nombre'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['apellido'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['carrera'] ?></td>
    			<td class="text-uppercase"><?php echo $ro1['trayecto'] ?></td>
    			<td class="text-capitalize"><?php echo $ro1['cedula'] ?></td>
          <td class="text-capitalize"><?php echo $ro1['carEs'] ?></td>
				</tr>
				<?php 
				endwhile;
				$sq = "SELECT asistencia.carnet, estudiante.carnet AS carEs, estudiante.nombre, estudiante.apellido, estudiante.carrera, estudiante.trayecto, estudiante.cedula FROM asistencia INNER JOIN estudiante ON asistencia.carnet = estudiante.carnet WHERE asistencia.fecha = '$hoy' ORDER BY asistencia.fecha ASC";
	      $field = $db->query($sq);
	      $rows = $field->num_rows;
	      $totalE = ceil($rows/$limit);
				?>
				<tfoot>
		      <tr>
		        <td colspan="6">
		          <ul class="pagination justify-content-center"><?php
		          if($id > 1): ?>
		            <li class="page-item">
		              <a id="link" class="page-link" data-page="<?php echo ($id-1); ?>" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="link" class="page-link" data-page="NaN" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php endif;
		          for($i = 1; $i <= $totalE; $i++) :
		            if($i == $id) : ?>
		              <li class="page-item active">
		                <a id="link" class="page-link" data-page="NaN"><?php echo $i ?></a>
		              </li>
		            <?php else: ?>
		            	<li class="page-item">
		              	<a id="link" class="page-link" data-page="<?php echo $i; ?>"><?php echo $i ?></a>
		              </li>
		            <?php endif;
		          endfor;
		          if($id != $total) : ?>
		            <li class="page-item">
		              <a id="link" class="page-link" data-page="<?php echo ($id+1); ?>" aria-label="Next">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="link" class="page-link" data-page="NaN" aria-label="Next">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
		              </a>
		            </li>
		          <?php endif; ?>
		          </ul>
		        </td>
		      </tr>
		    </tfoot>
		  </table>
		  <?php endif; //est table
			
			if($r2->num_rows): ?>
			<table class="table table-bordered">
				<thead><th colspan="4">Docentes Asistentes</th></thead>
				<thead class="thead-dark">
					<th>Nombres</th>
    			<th>Apellidos</th>
    			<th>Cedula</th>
          <th>Teléfono</th>
				</thead>
				<?php while($ro2 = $r2->fetch_assoc()): ?>
				<tr>
					<td class="text-capitalize"><?php echo $ro2['nom'] ?></td>
    			<td class="text-capitalize"><?php echo $ro2['ape'] ?></td>
    			<td class="text-capitalize"><?php echo $ro2['ced'] ?></td>
          <td class="text-capitalize"><?php echo $ro2['tlf'] ?></td>
				</tr>
				<?php 
				$sqD = "SELECT asistenciaC.ced, docente.nom, docente.ced, docente.ape, docente.tlf FROM asistenciaC INNER JOIN docente ON asistenciaC.ced = docente.ced WHERE asistenciaC.fecha = '$hoy' ORDER BY asistenciaC.fecha ASC";
		    $fieldD = $db->query($sqD);
		    $rowsD = $fieldD->num_rows;
		    $totalD = ceil($rowsD/$limitD);
				endwhile;
				?>
				<tfoot>
		      <tr>
		        <td colspan="4">
		          <ul class="pagination justify-content-center"><?php
		          if($id > 1): ?>
		            <li class="page-item">
		              <a id="linkD" class="page-link" data-pageD="<?php echo ($id-1); ?>" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="linkD" class="page-link" data-pageD="NaN" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php endif;
		          for($j = 1; $j <= $totalD; $j++) :
		            if($initD == $idD) : ?>
		              <li class="page-item">
		                <a id="linkD" class="page-link" data-pageD="NaN"><?php echo $j ?></a>
		              </li>
		            <?php else : ?>
		              <?php if($j == $idD) : ?>
		                <li class="page-item active">
		                  <a id="linkD" class="page-link" data-pageD="NaN"><?php echo $j ?></a>
		                </li>
		              <?php else: ?>
		                <li class="page-item">
		                  <a id="linkD" class="page-link" data-pageD="<?php echo $j; ?>"><?php echo $j ?></a>
		                </li>
		              <?php endif;
		            endif;
		          endfor;
		          if($id != $totalD) : ?>
		            <li class="page-item">
		              <a id="linkD" class="page-link" data-pageD="<?php echo ($idD+1); ?>" aria-label="Next">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="linkD" class="page-link" data-pageD="NaN" aria-label="Previous">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php endif; ?>
		          </ul>
		        </td>
		      </tr>
		    </tfoot>
		  <?php endif; //doc table ?>
		  </table>

		  <?php if($r3->num_rows): ?>
			<table class="table table-bordered">
				<thead><th colspan="2">Otros Asistentes</th></thead>
				<thead class="thead-dark">
					<th>Nombres</th>
    			<th>Cedula</th>
				</thead>
				<?php while($ro3 = $r3->fetch_assoc()): ?>
				<tr>
					<td class="text-capitalize"><?php echo $ro3['nomape'] ?></td>
    			<td class="text-capitalize"><?php echo $ro3['ci'] ?></td>
				</tr>
				<?php 
				endwhile;
				$sqo = "SELECT * FROM asistenciaO WHERE fecha = '$hoy' ORDER BY fecha ASC";
	      $fieldo = $db->query($sqo);
	      $rowso = $fieldo->num_rows;
	      $totalO = ceil($rowso/$limitO);
				?>
				<tfoot>
		      <tr>
		        <td colspan="6">
		          <ul class="pagination justify-content-center"><?php
		          if($idO > 1): ?>
		            <li class="page-item">
		              <a id="linkO" class="page-link" data-pageO="<?php echo ($idO-1); ?>" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="linkO" class="page-link" data-pageO="NaN" aria-label="Previous">
		                <span aria-hidden="true">&laquo;</span>
		                <span class="sr-only">Previous</span>
		              </a>
		            </li>
		          <?php endif;
		          for($k = 1; $k <= $totalO; $k++) :
		            if($k == $idO) : ?>
		              <li class="page-item active">
		                <a id="linkO" class="page-link" data-pageO="NaN"><?php echo $k ?></a>
		              </li>
		            <?php else: ?>
		            	<li class="page-item">
		              	<a id="linkO" class="page-link" data-pageO="<?php echo $k; ?>"><?php echo $k ?></a>
		              </li>
		            <?php endif;
		          endfor;
		          if($idO != $total) : ?>
		            <li class="page-item">
		              <a id="linkO" class="page-link" data-pageO="<?php echo ($idO+1); ?>" aria-label="Next">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
		              </a>
		            </li>
		          <?php else : ?>
		            <li class="page-item disabled">
		              <a id="linkO" class="page-link" data-page="NaN" aria-label="Next">
		                <span aria-hidden="true">&raquo;</span>
		                <span class="sr-only">Next</span>
		              </a>
		            </li>
		          <?php endif; ?>
		          </ul>
		        </td>
		      </tr>
		    </tfoot>
		  </table>
		  <?php endif; //ot table ?>
		</div>
	</div>
	<br>
	<button type="button" id="print" class="btn btn-bg btn-success">Imprimir</button>

</div>
<div class="col"></div>

<script>
	$('#print').click(function(){
		window.open("print_daily.php?date=<?php echo $hoy ?>")
	})
</script>