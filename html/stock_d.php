<?php
if(($_COOKIE['usu'] == null) || ($_COOKIE['nom'] == null) || ($_COOKIE['lvl'] == null)){
	header('location: ../');
}else{
$today = date('Y-m-d')
?>

<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../img/camera-iris.png">
    <?php include 'files.html'; ?>

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
      <div class="row d-flex d-md-block flex-nowrap wrapper">
        
        <?php include 'sidebar.php'; ?>

        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Ingredientes a usar al día</h4>
            <form id="stdi" autocomplete="off">
              <section class="form-row cant" id="cont_1">
                <div class="form-group col">
                  <label for="">Ingrediente</label>
                  <select name="id_inv[]" class="form-control custom-select" id="nom_1" required>
                  </select>
                  <small class="form-text text-muted">Ingrediente a usar</small>
                </div>
                <div class="form-group col">
                  <label for="">Cantidad (en KG)</label>
                  <input type="text" class="form-control num-only" id="cant_1" name="cant[]" required>
                  <small class="form-text text-muted">Cantidad a usar</small>
                </div>
                <div class="form-group col-md-2">
                  <br>
                  <button type="button" id="1" class="btn btn-info add">
                    <span class="oi oi-plus"></span>
                  </button>
                </div>
              </section>

              <input type="hidden" name="orden" value="dis">
              <input type="hidden" name="count" value="1">

              <button type="submit" class="btn btn-primary">Procesar</button>
              <button type="button" class="btn btn-secondary" id="main">Cancelar</button>
            </form>
          </div>
        </div>

      </div>
    </div>
		<script src="../js/ctrl.js"></script>
    <script>
      $.getJSON('../php/methods/load_inv.php', function(data){
        $('#nom_1').html(data[0].info);
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
      $(document).keypress(function(e) {
        if(e.keyCode === 13){
          console.log(control)
          $('#'+control).click();
          return false;
        }
      });
    </script>

		<div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>

<?php
}
?>