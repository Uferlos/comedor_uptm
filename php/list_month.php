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
          <h4>Reporte mensual de bandejas</h4>
          <form id="month">
            <div class="form-row">
              <div class="col"></div>
              <div class="form-group col">
                <label>Mes a consultar</label>
                <select name="date" class="select custom-select" required>
                  <option value="">--------</option>
                  <option value="01">Enero</option>
                  <option value="02">Febrero</option>
                  <option value="03">Marzo</option>
                  <option value="04">Abril</option>
                  <option value="05">Mayo</option>
                  <option value="06">Junio</option>
                  <option value="07">Julio</option>
                  <option value="08">Agosto</option>
                  <option value="09">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
                <br>
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
    	$(function () {
    	  $('[data-toggle="tooltip"]').tooltip()
    	})

      $(document).on('submit', '#month', function(e){
        e.preventDefault()
        var fecha = $('#month').serialize();
        $.ajax({
          type: 'post',
          dataType: 'html',
          url: '../php/data_month.php',
          data: fecha
        })
        .done(function(data){
          $('#contenido').html(data);
        })
      })
    </script>
    <div id="content"></div>
    <?php include '../html/footer.html'; ?>
  </body>
</html>
<?php } ?>