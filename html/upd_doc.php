<?php
include '../php/config.php';
$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}
$x = $_POST['val'];
$query = "SELECT * FROM docente WHERE ced = '$x'";
$res = $db->query($query);
$row = $res->fetch_assoc();
?>

<script>
  $.getJSON('../php/methods/load_pnf.php', function(data){
    $('#pnf').html(data[0].data);
  })
</script>
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
      <h4>Editar datos del o la docente</h4>
        <form id="doc_upd" autocomplete="off">
          <div class="form-row">
            <div class="form-group col">
              <label for="nom">Nombres</label>
              <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required value="<?php echo $row['nom'] ?>">
              <small id="nomDesc" class="form-text text-muted">Nombres del o la docente</small>
            </div>
            <div class="form-group col">
              <label for="ape">Apellidos</label>
              <input type="text" class="form-control text-only" id="ape" name="ape" aria-describedby="apeDesc" required value="<?php echo $row['ape'] ?>">
              <small id="apeDesc" class="form-text text-muted">Apellidos del o la docente</small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="ci">Cedula</label>
              <input type="text" class="form-control ced" id="ci" name="ci" aria-describedby="ciDesc" required value="<?php echo $row['ced'] ?>">
              <small id="ciDesc" class="form-text text-muted">Cedula del o la docente</small>
            </div>
            <div class="form-group col">
              <label for="tlf">Teléfono</label>
              <input type="text" class="form-control num-only" id="tlf" name="tlf" aria-describedby="tlfDesc" required value="<?php echo $row['tlf'] ?>">
              <small id="tlfDesc" class="form-text text-muted">Teléfono del o la docente</small>
            </div>
          </div>

          <input type="hidden" name="orden" value="upd">
          <input type="hidden" name="aux" value="<?php echo $x ?>">

          <button type="submit" class="btn btn-primary">Procesar</button>
          <button type="button" class="btn btn-secondary" id="cn_ud">Cancelar</button>
        </form>
      </div>
    </div>

  </div>
</div>

<script>

  $('.ced').mask('A-00.000.000',{
    'translation':{
      A:{pattern: /[VE,ve]/}
    },
    clearIfNotMatch: true
  });

  $('.text-only').keydown(function(v){
    if ((v.keyCode > 47 && v.keyCode < 58)){
      v.preventDefault();
    }
  });
</script>
<div id="content"></div>
