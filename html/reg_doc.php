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
          <h4>Registro de docentes</h4>
            <form id="doc_add" autocomplete="off">
              <div class="form-row">
                <div class="form-group col">
                  <label for="nom">Nombres</label>
                  <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required>
                  <small id="nomDesc" class="form-text text-muted">Nombres del o la docente</small>
                </div>
                <div class="form-group col">
                  <label for="ape">Apellidos</label>
                  <input type="text" class="form-control text-only" id="ape" name="ape" aria-describedby="apeDesc" required>
                  <small id="apeDesc" class="form-text text-muted">Apellidos del o la docente</small>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label for="ci">Cedula</label>
                  <input type="text" class="form-control ced" id="ci" name="ci" aria-describedby="ciDesc" required>
                  <small id="ciDesc" class="form-text text-muted">Cedula del o la docente</small>
                </div>
                <div class="form-group col">
                  <label for="tlf">Teléfono</label>
                  <input type="text" class="form-control num-only" id="tlf" name="tlf" aria-describedby="tlfDesc" required>
                  <small id="tlfDesc" class="form-text text-muted">Teléfono del o la docente</small>
                </div>
              </div>

              <input type="hidden" name="orden" value="add">

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

       $('#tlf').mask('(0000)-0000000',{placeholder: '(____)-_______', clearIfNotMatch: true});

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
    </script>

		<div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>

<?php
}
?>