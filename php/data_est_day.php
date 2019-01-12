<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$limit = 10;
$init = 0;

if(isset($_POST['id'])){
  $id = $_POST['id'];
  $init = ($id-1) * $limit;
}else{
  $id = 1;
}

$carnet = isset($_POST['val']) ? $_POST['val'] : '';

$query = "SELECT asistencia.fecha, estudiante.nombre, estudiante.apellido, estudiante.cedula, estudiante.carrera, estudiante.trayecto FROM asistencia INNER JOIN estudiante ON asistencia.carnet = estudiante.carnet WHERE asistencia.carnet = '$carnet' ORDER BY asistencia.fecha ASC LIMIT $init, $limit";

if(!$res = $db->query($query)){
	echo $db->error;
	exit();
}

?>

<div class="col"></div>
<div class="col">
<?php if($res->num_rows): ?>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<th>Nombres</th>
			<th>Apellidos</th>
      <th>Cedula</th>
      <th>Carnet</th>
			<th>PNF</th>
			<th>Trayecto</th>
      <th>Fecha</th>
		</thead>
		<tbody>
    <?php while($row = $res->fetch_assoc()): 
      if($row['fecha'] != ''){
        $h = explode('-', $row['fecha']);
        $fixed = $h[2]."/".$h[1]."/".$h[0];
      }
      ?>
      <tr>
  			<td class="text-capitalize"><?php echo $row['nombre'] ?></td>
  			<td class="text-capitalize"><?php echo $row['apellido'] ?></td>
  			<td class="text-capitalize"><?php echo $row['cedula'] ?></td>
  			<td class="text-capitalize"><?php echo $carnet ?></td>
  			<td class="text-capitalize"><?php echo $row['carrera'] ?></td>
        <td class="text-uppercase"><?php echo $row['trayecto'] ?></td>
        <td><?php echo $fixed ?></td>
      </tr>
    <?php 
      endwhile;
      $squery = "SELECT asistencia.fecha, estudiante.nombre, estudiante.apellido, estudiante.cedula, estudiante.carrera, estudiante.trayecto FROM asistencia INNER JOIN estudiante ON asistencia.carnet = estudiante.carnet WHERE asistencia.carnet = '$carnet' ORDER BY asistencia.fecha";
      $fields = $db->query($squery);
      $rows = $fields->num_rows;
      $total = ceil($rows/$limit);
    ?>
		</tbody>
    <tfoot>
      <tr>
        <td colspan="7">
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
          for($i = 1; $i <= $total; $i++) :
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
<?php else: ?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">¡Reporte vacio!</h4>
	  <p>
	  	No hay registros en la base de datos del comedor para este estudiante.
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