<?php
if(($_COOKIE['usu'] == null) || ($_COOKIE['nom'] == null) || ($_COOKIE['lvl'] == null)){
  header('location: ../');
}else{

include '../php/config.php';

$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$usu = $_COOKIE['usu'];

$query = "SELECT id, clave FROM usuarios WHERE nusu = '$usu'";
$res = $db->query($query);
$row = $res->fetch_assoc();

?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/camera-iris.png">
    <?php include 'files.html'; ?>

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
        
        <?php include 'sidebar.php'; ?>

        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Cambio de clave de acceso</h4>
          <form id="updPass" autocomplete="off">
            <div class="form-row">
              <div class="form-group col">
                <label for="oldP">Clave Actual</label>
                <input type="password" class="form-control" id="oldP" name="oldP" aria-describedby="oldPDesc" required>
                <small id="oldPDesc" class="form-text text-muted">Clave de acceso actual</small>
              </div>
              <div class="form-group col">
                <label for="pass">Nueva Clave</label>
                <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passDesc" required>
                <small id="passDesc" class="form-text text-muted">Nueva clave de acceso</small>
              </div>
              <div class="form-group col">
                <label for="rPass">Confirmar clave</label>
                <input type="password" class="form-control" id="rPass" name="rPass" aria-describedby="rPassDesc" required>
                <small id="rPassDesc" class="form-text text-muted">Confirmar la nueva clave de acceso</small>
              </div>
            </div>

            <input type="hidden" name="orden" value="editar">
            <input type="hidden" name="aux" value="<?php echo $row['id'] ?>">
            <input type="hidden" name="currP" value="<?php echo $row['clave'] ?>">

            <button type="submit" class="btn btn-primary">Procesar</button>
            <button type="button" class="btn btn-secondary" id="main">Cancelar</button>
          </form>
        </div>
      </div>

      </div>
    </div>
    
    <script>
      $('.text-only').keydown(function(v){
        if ((v.keyCode > 47 && v.keyCode < 58)){
          v.preventDefault();
        }
      });
    </script>

    <div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>

<?php 
}
?>