<?php
if(($_COOKIE['usu'] == null) || ($_COOKIE['nom'] == null) || ($_COOKIE['lvl'] == null)){
	header('location: ../');
}else{
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/camera-iris.png">
    <?php include 'files.html'; ?>
    <link rel="stylesheet" type="text/css" href="../css/multiselect.css">
    <link rel="stylesheet" type="text/css" href="../css/typeahead.css">
    <script src="../js/multiselect.js"></script>
    <script src="../js/typeahead.js"></script>
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
    
    <?php include 'sidebar.php'; ?>
    
    <div class="container">
      <div class="row d-flex d-md-block flex-nowrap wrapper">
        <div class="justify-content-md-center p-md-5 m-md text-center">
          <h4>Registro de comensales a utilizar el servicio del comedor</h4>
            <form id="add_reg" autocomplete="off">
              <div class="form-row">
                <div class="col">
                  <label for="cambia">Seleccione</label>
                  <select id="cambia" onchange="cambio()" class="form-control custom-select">
                    <option value="">Seleccione</option>
                    <option value="doc">Docente</option>
                    <option value="est">Estudiante</option>
                  </select>
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
                </div>
                <div id="estu" class="form-group col">
                  <label for="carnet">Carnet</label>
                  <input type="text" class="form-control num-only" id="carnet" name="carnet" aria-describedby="carnDesc">
                  <small id="carnDesc" class="form-text text-muted">Carnet del o la estudiante</small>
                </div>
                <div id="doce" class="form-group col" hidden disabled>
                  <label for="ced">Cedula</label>
                  <input type="text" class="form-control ced" id="ced" name="ced" aria-describedby="cedDesc">
                  <small id="cedDesc" class="form-text text-muted">Cedula del o la docente</small>
                </div>
              </div>

              <input type="hidden" id="orden" name="orden">

              <button type="submit" class="btn btn-primary">Procesar</button>
              <button type="button" class="btn btn-secondary" id="main">Cancelar</button>
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
        placeholder: 'V/E-00.000.000',
        clearIfNotMatch: true
      });

      $.getJSON('../php/methods/load_carnet.php', function(data){
        $('#carnet').typeahead({source:data});
      })

      $.getJSON('../php/methods/load_ced.php', function(data){
        $('#ced').typeahead({source:data});
      })

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
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) != -1 || //allow backspace, delete, tab, escape, enter and .
        (e.keyCode == 65 && e.ctrlKey == true) || //allow ctrl+a
        (e.keyCode == 67 && e.ctrlKey == true) || //allow ctrl+c
        (e.keyCode == 88 && e.ctrlKey == true) || //allow ctrl+x
        (e.keyCode == 86 && e.ctrlKey == true) || //allow ctrl+v
        (e.keyCode >= 35 && e.keyCode <= 39)) { //allow home, end, left, right
        return;
      }
        if ((e.shifKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
          e.preventDefault();
        }
      });

      function cambio(){
        let info = document.getElementById('cambia').value
        if(info === 'est'){
          $('#doce').attr('hidden', true)
          $('#doce').attr('disabled', true)
          $('#doce').attr('required', false)
          $('#estu').attr('hidden', false)
          $('#estu').attr('disabled', false)
          $('#estu').attr('required', true)
          $('#orden').val('addReg')
        }else{
          $('#doce').attr('hidden', false)
          $('#doce').attr('disabled', false)
          $('#doce').attr('required', true)
          $('#estu').attr('hidden', true)
          $('#estu').attr('disabled', true)
          $('#estu').attr('required', false)
          $('#orden').val('addRegC')
        }
      }
    </script>

		<div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>

<?php
}
?>