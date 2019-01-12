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
    <?php include '../html/files.html'; ?>
    
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
    <?php include '../html/sidebar.php'; ?>
    <div class="container">              
        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Reporte de asistencias de estudiantes y docentes al comedor</h4>
          <form id="daily" autocomplete="off">
            <div class="form-row">
              <div class="col">
                <label for="cambia">Seleccione</label>
                <select id="cambia" onchange="cambio()" class="form-control custom-select">
                  <option value="">Seleccione</option>
                  <option value="doc">Docente</option>
                  <option value="est">Estudiante</option>
                </select>
              </div>
              <div id="estu" class="form-group col" hidden>
                <label for="carnet">Carnet</label>
                <input type="text" class="form-control" id="carnet" name="carnet" aria-describedby="carnDesc">
                <small id="carnDesc" class="form-text text-muted">Cedula/Carnet del o la estudiante</small>
              </div>
              <div id="doce" class="form-group col" hidden disabled>
                <label for="ced">Cedula</label>
                <input type="text" class="form-control ced" id="ced" name="ced" aria-describedby="cedDesc">
                <small id="cedDesc" class="form-text text-muted">Cedula del o la docente</small>
              </div>
              
            </div>
            <br>
            <button type="submit" class="btn btn-sm btn-info">Ver Reporte</button>
          </form>
          <br>
          <div class="row">
            <div class="col" id="contenido"></div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $.getJSON('../php/methods/load_cedest.php', function(data){
        $('#carnet').typeahead({source:data});
      })

      $.getJSON('../php/methods/load_ced.php', function(data){
        $('#ced').typeahead({source:data});
      })

      $('#picker').pickadate()
    	$(function () {
    	  $('[data-toggle="tooltip"]').tooltip()
    	})

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

      function cambio(){
        let info = document.getElementById('cambia').value
        if(info === ''){
          return false;
        }
        else if(info === 'est'){
          $('#doce').attr('hidden', true)
          $('#doce').attr('disabled', true)
          $('#ced').attr('required', false)
          $('#estu').attr('hidden', false)
          $('#estu').attr('disabled', false)
          $('#carnet').attr('required', true)
          $('form').attr('id', 'daily')
        }else{
          $('#doce').attr('hidden', false)
          $('#doce').attr('disabled', false)
          $('#ced').attr('required', true)
          $('#estu').attr('hidden', true)
          $('#estu').attr('disabled', true)
          $('#estu').attr('required', false)
          $('form').attr('id', 'dailyC')
        }
      }

      $(document).on('click', '#link', function(e){
        e.preventDefault()
        var id = $(this).attr("data-page")
        
        if(id === 'NaN'){
          return false;
        }

        $('#contenido').load('../php/data_est_day.php',{'id':id})
      })

      $(document).on('submit', '#daily', function(e){
        e.preventDefault()
        var est = $('#carnet').val();
        $.ajax({
          type: 'post',
          dataType: 'html',
          url: '../php/data_est_day.php',
          data: {val: est}
        })
        .done(function(data){
          $('#contenido').html(data);
        })
      })

      $(document).on('submit', '#dailyC', function(e){
        e.preventDefault()
        var ced = $('#ced').val();
        $.ajax({
          type: 'post',
          dataType: 'html',
          url: '../php/data_doc_day.php',
          data: {val: ced}
        })
        .done(function(data){
          $('#contenido').html(data);
        })
      })

      $(document).on('click', '#linkD', function(e){
        e.preventDefault()
        var idD = $(this).attr("data-pageD")
        console.log(idD)
        if(idD === 'NaN'){
          return false;
        }

        $('#contenido').load('../php/data_doc_day.php',{'idD':idD})
      })
    </script>
    <div id="content"></div>
    <?php include '../html/footer.html'; ?>
  </body>
</html>
<?php } ?>