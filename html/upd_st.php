<?php
include '../php/config.php';
$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$x = $_POST['val'];
$query = "SELECT * FROM inventario WHERE id = '$x'";
$res = $db->query($query);
$row = $res->fetch_assoc();
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
    
    <?php include 'sidebar.php'; ?>

    <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
      <h4>Actualizar datos y cantidad de ingredientes en inventario</h4>
        <form id="st_upd" autocomplete="off">
          <div class="form-row">
            <div class="form-group col">
              <label for="nom">Nombre</label>
              <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required value="<?php echo $row['nom'] ?>">
              <small id="nomDesc" class="form-text text-muted">Ingrediente</small>
            </div>
            <div class="form-group col">
              <label for="cant">Cantidad (en KG)</label>
              <input type="text" class="form-control num-only" id="cant" name="cant" aria-describedby="cantDesc" required value="<?php echo $row['cant'] ?>">
              <small id="cantDesc" class="form-text text-muted">Cantidad</small>
            </div>
          </div>

          <input type="hidden" name="aux" value="<?php echo $x ?>">
          <input type="hidden" name="orden" value="upd">

          <button type="submit" class="btn btn-primary">Procesar</button>
          <button type="button" class="btn btn-secondary" id="cn_us">Cancelar</button>
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
  $('.num-only').keydown(function(e){
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) != -1 ||
     (e.keyCode == 65 && e.ctrlKey == true) || (e.keyCode == 67 && e.ctrlKey == true) ||
     (e.keyCode == 88 && e.ctrlKey == true) || (e.keyCode == 86 && e.ctrlKey == true) ||
     (e.keyCode >= 35 && e.keyCode <= 39)) {
      return;
    }
    if ((e.shifKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
      e.preventDefault();
    }
  });
</script>

<div id="content"></div>