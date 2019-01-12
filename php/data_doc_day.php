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

$ced = isset($_POST['val']) ? $_POST['val'] : '';

$query = "SELECT asistenciaC.fecha, docente.nom, docente.ced, docente.ape, docente.tlf FROM asistenciaC INNER JOIN docente ON asistenciaC.ced = docente.ced WHERE asistenciaC.ced = '$ced' ORDER BY asistenciaC.fecha ASC LIMIT $init, $limit";

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
  			<td class="text-capitalize"><?php echo $row['nom'] ?></td>
  			<td class="text-capitalize"><?php echo $row['ape'] ?></td>
  			<td class="text-capitalize"><?php echo $ced ?></td>
        <td><?php echo $fixed ?></td>
      </tr>
    <?php 
      endwhile;
      $squery = "SELECT asistenciaC.ced, docente.nom, docente.ced, docente.ape, docente.tlf FROM asistenciaC INNER JOIN docente ON asistenciaC.ced = docente.ced WHERE asistenciaC.ced = '$ced' ORDER BY asistenciaC.fecha ASC";
      $fieldD = $db->query($squery);
      $rowsD = $fieldD->num_rows;
      $totalD = ceil($rowsD/$limit);
    ?>
		</tbody>
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
          for($i = 1; $i <= $totalD; $i++) :
            if($init == $id) : ?>
              <li class="page-item">
                <a id="linkD" class="page-link" data-pageD="NaN"><?php echo $i ?></a>
              </li>
            <?php else : ?>
              <?php if($i == $id) : ?>
                <li class="page-item active">
                  <a id="linkD" class="page-link" data-pageD="NaN"><?php echo $i ?></a>
                </li>
              <?php else: ?>
                <li class="page-item">
                  <a id="linkD" class="page-link" data-pageD="<?php echo $i; ?>"><?php echo $i ?></a>
                </li>
              <?php endif;
            endif;
          endfor;
          if($id != $totalD) : ?>
            <li class="page-item">
              <a id="linkD" class="page-link" data-pageD="<?php echo ($id+1); ?>" aria-label="Next">
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
	</table>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
	  <h4 class="alert-heading">¡Reporte vacio!</h4>
	  <p>
	  	No hay registros en la base de datos del comedor para este docente.
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