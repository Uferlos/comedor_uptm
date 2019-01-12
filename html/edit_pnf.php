<?php
include '../php/config.php';
$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$x = $_POST['val'];
$query = "SELECT * FROM pnf WHERE id = '$x'";
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
      <h4>Editar datos de PNF</h4>
        <form id="pnf_upd" autocomplete="off">
          <div class="form-row">
            <div class="form-group col">
              <label for="nom">Nombre</label>
              <input type="text" class="form-control text-only" id="pnfNom" name="pnfNom" aria-describedby="nomDesc" required value="<?php echo $row['nom'] ?>">
              <small id="nomDesc" class="form-text text-muted">Nombre del PNF</small>
            </div>
            <div class="form-group col">
              <label for="cterm">Código</label>
              <input type="text" class="form-control num-only" id="cterm" name="cterm" aria-describedby="ctermDesc" required value="<?php echo $row['cterm'] ?>">
              <small id="ctermDesc" class="form-text text-muted">Código del carnet del PNF</small>
            </div>
          </div>

          <input type="hidden" name="orden" value="updPnf">
          <input type="hidden" name="aux" value="<?php echo $x ?>">

          <button type="submit" class="btn btn-primary">Procesar</button>
          <button type="button" class="btn btn-secondary" id="cn_up">Cancelar</button>
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