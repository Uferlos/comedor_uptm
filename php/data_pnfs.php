<?php
if(($_COOKIE['usu'] == null) || ($_COOKIE['nom'] == null) || ($_COOKIE['lvl'] == null)){
  header('location: ../');
}else{

include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$x = $_POST['val'];

$limit = 10;

if(isset($_POST['id'])){
  $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
}else{
  $id = 1;
}

$init = (($id-1) * $limit);

$query = "SELECT * FROM estudiante WHERE carrera LIKE '%$x%' ORDER BY nombre ASC LIMIT $init, $limit";

$res = $db->query($query);

?>
<input type="hidden" id="id" value="<?php echo $x ?>">
<div class="row">
  <div class="col">
  <?php if($res->num_rows): ?>
  	<table class="table table-bordered">
  		<thead class="thead-dark">
  			<th>Nombres</th>
  			<th>Apellidos</th>
  			<th>PNF</th>
  			<th>Trayecto</th>
  			<th>Cedula</th>
        <th>Carnet</th>
        <th>Opciones</th>
  		</thead>
  		<tbody>
      <?php while($row = $res->fetch_assoc()): ?>
        <tr>
    			<td class="text-capitalize"><?php echo $row['nombre'] ?></td>
    			<td class="text-capitalize"><?php echo $row['apellido'] ?></td>
    			<td class="text-capitalize"><?php echo $row['carrera'] ?></td>
    			<td class="text-uppercase"><?php echo $row['trayecto'] ?></td>
    			<td class="text-capitalize"><?php echo $row['cedula'] ?></td>
          <td class="text-capitalize"><?php echo $row['carnet'] ?></td>
          <td>
            <button id="del_est" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Eliminar del sistema" value="<?php echo $row['cedula'] ?>">
              <span class="oi oi-ban"></span>
            </button>
            <button id="upd_est" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar datos" value="<?php echo $row['cedula'] ?>">
              <span class="oi oi-pencil"></span>
            </button>
          </td>
        </tr>
      <?php 
        endwhile;
        $squery = "SELECT * FROM estudiante WHERE carrera LIKE '%$x%'";
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
                <a class="page-link" data-page="<?php echo ($id-1); ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link" data-page="NaN" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
            <?php endif;
            for($i = 1; $i <= $total; $i++) :
              if($init == $id) : ?>
                <li class="page-item active">
                  <a class="page-link" data-page="NaN"><?php echo $i ?></a>
                </li>
              <?php else : ?>
                <?php if($i == $id) : ?>
                  <li class="page-item active">
                    <a class="page-link" data-page="NaN"><?php echo $i ?></a>
                  </li>
                <?php else: ?>
                  <li class="page-item">
                    <a class="page-link" data-page="<?php echo $i ?>"><?php echo $i ?></a>
                  </li>
                <?php endif;
              endif;
            endfor;
            if($id != $total) : ?>
              <li class="page-item">
                <a class="page-link" data-page="<?php echo ($id+1) ?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            <?php else : ?>
              <li class="page-item disabled">
                <a class="page-link" href="NaN" aria-label="Previous">
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
  <?php else:
   $sideQ = "SELECT nom from pnf WHERE nom LIKE '%$x%'";
   $sideRes = $db->query($sideQ);
   $sideR = $sideRes->fetch_assoc();
  ?>
    <h4>Listado de estudiantes por PNF</h4>
    <br>
    <br>
  	<div class="alert alert-success" role="alert">
		  <h4 class="alert-heading">¡Registro de estudiantes vacio!</h4>
		  <p>
		  	No hay estudiantes de <?php echo $sideR['nom'] ?> registrados en la base de datos del comedor.
		  </p>
		</div>
  <?php endif; ?>
  </div>
</div>
<?php } ?>