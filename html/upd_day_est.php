<?php
include '../php/config.php';
$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}

$x = $_POST['val'];
$query = "SELECT nombre, apellido FROM estudiante WHERE carnet = '$x'";
$res = $db->query($query);
$row = $res->fetch_assoc();

$q2 = "SELECT * FROM registro WHERE carnet = '$x'";
$re2 = $db->query($q2);
$ro2 = $re2->fetch_assoc();
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
      <h4>Actualizar los días de servicio de comedor para el estudiante</h4>
        <form id="dEst_upd" autocomplete="off">
          <div class="form-row">
            <div class="form-group col-sm-4">
              <label for="nom">Nombre</label>
              <input type="text" class="form-control text-only" id="nom" aria-describedby="nomDesc" required value="<?php echo $row['nombre'].' '.$row['apellido'] ?>" readonly>
              <small id="nomDesc" class="form-text text-muted">Alumno</small>
            </div>
            <div class="form-group col">
              <label for="days">Días Validos</label><br>
              <select name="days[]" id="days" class="form-control custom-select" required multiple>
                <option value="lunes">Lunes</option>
                <option value="martes">Martes</option>
                <option value="miercoles">Miercoles</option>
                <option value="jueves">Jueves</option>
                <option value="viernes">Viernes</option>
              </select>
              <small id="daysDesc" class="form-text text-muted">Días que el o la estudiante asiste al comedor</small>
              <script>
                let d = "<?php echo $ro2['dias']; ?>".split(' - ');
                for(let i = 0; i < d.length; i++){
                  $("#days option[value="+d[i]+"]").attr('selected', true);
                }
              </script>
            </div>
          </div>

          <input type="hidden" name="aux" value="<?php echo $ro2['id'] ?>">
          <input type="hidden" name="orden" value="updRegEst">

          <button type="submit" class="btn btn-primary">Procesar</button>
          <button type="button" class="btn btn-secondary" id="gblde">Cancelar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('select[multiple]').multiselect({
      buttonText: function(options, select) {
        if (options.length === 0) {
          return 'Seleccione...';
        }
        else {
          var labels = [];
          options.each(function() {
            if ($(this).attr('label') !== undefined) {
              labels.push($(this).attr('label'));
            }
            else {
              labels.push($(this).html());
            }
          });
          return labels.join(', ') + '';
        }
      }
    });
  })
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