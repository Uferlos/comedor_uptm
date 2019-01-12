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

$limit = 10;
$init = 0;

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $init = ($id-1) * $limit;
}else{
  $id = 1;
}

$query = "SELECT * FROM estudiante WHERE carrera = 'turismo' ORDER BY nombre ASC LIMIT $init, $limit";
$res = $db->query($query);

?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/camera-iris.png">
    <?php include '../html/files.html'; ?>

    <title>UPTM</title>
  </head>

  <body>
    <nav class="site-header sticky-top py-1">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="javascript:void(0)" id="bar" data-target="#sidebar" data-toggle="collapse">
          <span class="oi oi-menu" title="Menú" aria-hidden="true"></span> Menú          
        </a>
        <a class="py-2 d-none d-md-inline-block" href="javascript:void(0)" id="main">Inicio</a>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row d-flex d-md-block flex-nowrap wrapper">

        <?php include '../html/sidebar.php'; ?>
              
        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
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
              			<td class="text-capitalize"><?php echo $row['trayecto'] ?></td>
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
                  $squery = "SELECT * FROM estudiante WHERE carrera = 'turismo'";
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
                          <a class="page-link" href="?id=<?php echo ($id-1); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item disabled">
                          <a class="page-link" href="javascript:void(0)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                      <?php endif;
                      for($i = 1; $i <= $total; $i++) :
                        if($init == $id) : ?>
                          <li class="page-item active">
                            <a class="page-link" href="javascript:void(0)"><?php echo $i ?></a>
                          </li>
                        <?php else : ?>
                          <?php if($i == $id) : ?>
                            <li class="page-item active">
                              <a class="page-link" href="javascript:void(0)"><?php echo $i ?></a>
                            </li>
                          <?php else: ?>
                            <li class="page-item">
                              <a class="page-link" href="?id=<?php echo $i; ?>"><?php echo $i ?></a>
                            </li>
                          <?php endif;
                        endif;
                      endfor;
                      if($id != $total) : ?>
                        <li class="page-item">
                          <a class="page-link" href="?id=<?php echo ($id+1); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      <?php else : ?>
                        <li class="page-item disabled">
                          <a class="page-link" href="javascript:void(0)" aria-label="Previous">
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
            	<div class="alert alert-success" role="alert">
        			  <h4 class="alert-heading">¡Registro de estudiantes vacio!</h4>
        			  <p>
        			  	No hay estudiantes de turismo registrados en la base de datos del comedor.
        			  </p>
        			</div>
            <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
    <script type="text/javascript">
    	$(function () {
    	  $('[data-toggle="tooltip"]').tooltip()
    	})
    </script>
    <div id="content"></div>
    <?php include '../html/footer.html'; ?>
  </body>
</html>
<?php } ?>