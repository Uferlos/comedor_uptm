<?php
include '../php/config.php';
$db = new mysqli(host, usr, pssw, data);
$db->set_charset('utf8');
if($db->connect_errno){
  echo $db->connect_error;
  exit();
}
$x = $_POST['val'];
$query = "SELECT * FROM estudiante WHERE cedula = '$x'";
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
      <h4>Editar datos del o la estudiante</h4>
        <form id="est_upd" autocomplete="off">
          <div class="form-row">
            <div class="form-group col">
              <label for="nom">Nombres</label>
              <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required value="<?php echo $row['nombre'] ?>">
              <small id="nomDesc" class="form-text text-muted">Nombres del o la estudiante</small>
            </div>
            <div class="form-group col">
              <label for="ape">Apellidos</label>
              <input type="text" class="form-control text-only" id="ape" name="ape" aria-describedby="apeDesc" required value="<?php echo $row['apellido'] ?>">
              <small id="apeDesc" class="form-text text-muted">Apellidos del o la estudiante</small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="ci">Cedula</label>
              <input type="text" class="form-control ced" id="ci" name="ci" aria-describedby="ciDesc" required value="<?php echo $row['cedula'] ?>">
              <small id="ciDesc" class="form-text text-muted">Cedula del o la estudiante</small>
            </div>
            <div class="form-group col">
              <label for="carnet">Carnet</label>
              <input type="text" class="form-control" id="carnet" name="carnet" aria-describedby="carnDesc" required value="<?php echo $row['carnet'] ?>">
              <small id="carnDesc" class="form-text text-muted">Carnet del o la estudiante</small>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col">
              <label for="tray">Trayecto</label>
              <select name="tray" class="form-control custom-select" id="tray" required>
                <option value="">Seleccione</option>
                <option value="i">I</option>
                <option value="ii">II</option>
                <option value="iii">III</option>
                <option value="iv">IV</option>
              </select>
              <script>
                document.getElementById("tray").value = "<?php echo $row['trayecto'] ?>"
              </script>
              <small id="trayDesc" class="form-text text-muted">Trayecto que cursa el o la estudiante</small>
            </div>
            <div class="form-group col">
              <label for="pnf">PNF</label>
              <select name="pnf" class="form-control custom-select" id="pnf" required>
              </select>
              <script>
                document.getElementById("pnf").value = "<?php echo $row['carrera'] ?>"
              </script>
              <small id="pnfDesc" class="form-text text-muted">PNF que cursa el o la estudiante</small>
            </div>
          </div>
          <div class="form-row">
            <div class="col"></div>
            <div class="form-group col">
              <label for="secc">Sección</label>
              <select name="secc" class="form-control custom-select" id="secc" required>
                <option value="">Seleccione</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
                <option value="G">G</option>
                <option value="H">H</option>
                <option value="I">I</option>
                <option value="J">J</option>
                <option value="K">K</option>
                <option value="L">L</option>
                <option value="M">M</option>
                <option value="N">N</option>
                <option value="O">O</option>
                <option value="P">P</option>
                <option value="Q">Q</option>
                <option value="R">R</option>
                <option value="S">S</option>
                <option value="T">T</option>
                <option value="U">U</option>
                <option value="V">V</option>
                <option value="W">W</option>
                <option value="X">X</option>
                <option value="Y">Y</option>
                <option value="Z">Z</option>
              </select>
              <small id="seccDesc" class="form-text text-muted">Sección del o la estudiante</small>
              <script>
                document.getElementById("secc").value = "<?php echo $row['seccion'] ?>"
              </script>
            </div>
            <div class="col"></div>
          </div>

          <input type="hidden" name="orden" value="upd">
          <input type="hidden" name="aux" value="<?php echo $x ?>">

          <button type="submit" class="btn btn-primary">Procesar</button>
          <button type="button" class="btn btn-secondary" id="cn_ue">Cancelar</button>
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
