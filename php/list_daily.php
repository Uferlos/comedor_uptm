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
      
        <?php include '../html/sidebar.php'; ?>
              
        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Reporte diario de bandejas</h4>
          <form id="daily">
            <div class="form-row">
              <div class="col"></div>
              <div class="form-group col">
                <label for="day">Fecha a consultar</label>
                <input type="text" name="date" id="picker" class="form-control">
                <br>
                <button type="submit" class="btn btn-sm btn-info">Ver Reporte</button>
              </div>
              <div class="col"></div>
            </div>
          </form>
          <div class="row">
            <div class="col" id="contenido"></div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $('#picker').pickadate()
    	$(function () {
    	  $('[data-toggle="tooltip"]').tooltip()
    	})

      $(document).on('submit', '#daily', function(e){
        e.preventDefault()
        var fecha = $('#daily').serialize()
        $.ajax({
          type: 'post',
          dataType: 'html',
          url: '../php/data_day.php',
          data: fecha
        })
        .done(function(data){
          $('#contenido').html(data)
        })
      })

      $(document).on('click', '#link', function(e){
        e.preventDefault()
        var dat = $('#fec').val()
        var id = $(this).attr("data-page")
        
        if(id === 'NaN'){
          return false;
        }

        $('#contenido').load('../php/data_day.php',{'date':dat, 'id':id})
      })

      $(document).on('click', '#linkD', function(e){
        e.preventDefault()
        var dat = $('#fec').val()
        var idD = $(this).attr("data-pageD")
        
        if(idD === 'NaN'){
          return false;
        }

        $('#contenido').load('../php/data_day.php',{'date':dat, 'idD':idD})
      })

      $(document).on('click', '#linkO', function(e){
        e.preventDefault()
        var dat = $('#fec').val()
        var idO = $(this).attr("data-pageO")
        
        if(idO === 'NaN'){
          return false;
        }

        $('#contenido').load('../php/data_day.php',{'date':dat, 'idO':idO})
      })
    </script>
    <div id="content"></div>
    <?php include '../html/footer.html'; ?>
  </body>
</html>
<?php } ?>