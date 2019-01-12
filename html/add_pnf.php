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

        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Registro de nuevo PNF</h4>
            <form id="pnfAdd" autocomplete="off">
              <div class="form-row">
                <div class="form-group col">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control text-only" id="pnfNom" name="pnfNom" aria-describedby="nomDesc" required>
                  <small id="nomDesc" class="form-text text-muted">Nombre del PNF</small>
                </div>
                <div class="form-group col">
                  <label for="cterm">Código</label>
                  <input type="text" class="form-control num-only" id="cterm" name="cterm" aria-describedby="ctermDesc" required>
                  <small id="ctermDesc" class="form-text text-muted">Código del carnet del PNF</small>
                </div>
              </div>

              <input type="hidden" name="orden" value="addPnf">

              <button type="submit" class="btn btn-primary">Procesar</button>
              <button type="button" class="btn btn-secondary" id="main">Cancelar</button>
            </form>
          </div>
        </div>

      </div>
    </div>
		
		<script type="text/javascript">
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