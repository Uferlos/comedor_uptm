<?php
include 'config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
	echo $db->connect_error;
	exit();
}

$x = isset($_POST['val']) ? $_POST['val'] : '';
date_default_timezone_set('America/Caracas');
$today = date('Y-m-d');

$query = "SELECT * FROM docente WHERE ced = '$x' ORDER BY nom ASC";
$res = $db->query($query);
$row = $res->fetch_assoc();

$query2 = "SELECT fecha FROM asistenciaC WHERE ced = '$row[ced]' AND fecha = '$today'";
$res2 = $db->query($query2);
$row2 = $res2->fetch_assoc();
?>

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
    
    <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width hide" id="sidebar">
      <div class="list-group border-0 card text-center text-md-left">
        <a href="javascript:void(0)" id="login" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
          <span class="oi oi-key"></span>
          <span class="d-none d-md-inline">Iniciar Sesión</span>
        </a>
        <a href="javascript:void(0)" id="est" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
          <span class="oi oi-person"></span>
          <span class="d-none d-md-inline">Estudiantes</span>
        </a>
        <a href="javascript:void(0)" id="doc" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
          <span class="oi oi-person"></span>
          <span class="d-none d-md-inline">Docentes</span>
        </a>
        <a href="javascript:void(0)" id="ot" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
          <span class="oi oi-person"></span>
          <span class="d-none d-md-inline">Otros</span>
        </a>
      </div>
    </div>

    <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
      <h4>Asistencia de docentes al comedor</h4>
    <?php if($res->num_rows): ?>
    	<table class="table table-bordered">
    		<thead class="thead-dark">
    			<th>Nombres</th>
    			<th>Apellidos</th>
    			<th>Cedula</th>
    			<th>Asistencia</th>
    		</thead>
    		<tbody>
    			<td class="text-capitalize"><?php echo $row['nom'] ?></td>
    			<td class="text-capitalize"><?php echo $row['ape'] ?></td>
    			<td class="text-capitalize"><?php echo $row['ced'] ?></td>
    			<td>
    			<?php if($row2['fecha'] == $today): ?>
    				<span class="oi oi-check"></span>
    			<?php else: ?>
    				<button type="button" id="reg_asisDoc" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Registrar asistencia" value="<?php echo $today.','.$row['ced'] ?>">
    					<span class="oi oi-clipboard"></span>
    				</button>
    			<?php endif; ?>
    			</td>
    		</tbody>
    	</table>
    <?php else: ?>
    	<div class="alert alert-success" role="alert">
			  <h4 class="alert-heading">¡Docente sin registrar!</h4>
			  <p>
			  	El docente no esta registrado en la base de datos del comedor.
			  </p>
			</div>
    <?php endif; ?>
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