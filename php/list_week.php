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

        <?php include '../html/sidebar.php';
        date_default_timezone_set('America/Caracas');
        $y = date('Y');
        $aw = date('W');
        $tw = date('W', mktime(0,0,0,12,28,$y));
        ?>
              
        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <form id="week">
            <div class="form-row">
              <div class="col"></div>
              <div class="form-group col">
                <label for="day">Semana a consultar (Semana actual <?php echo $aw; ?>)</label>
                <select name="date" class="select custom-select" required>
                  <option value="">--------</option>
                <?php for($c = 1; $c <= $tw; $c++): ?>
                  <option value="<?php echo $c ?>">Semana <?php echo $c ?></option>
                <?php endfor; ?>
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
      $('#picker').pickadate()
    	$(function () {
    	  $('[data-toggle="tooltip"]').tooltip()
    	})

      $(document).on('submit', '#week', function(e){
        e.preventDefault()
        var fecha = $('#week').serialize();
        $.ajax({
          type: 'post',
          dataType: 'html',
          url: '../php/data_week.php',
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