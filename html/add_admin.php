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

    <div class="container-fluid">
      <div class="row d-flex d-md-block flex-nowrap wrapper">
        
        <?php include 'sidebar.php'; ?>

        <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Registro de nuevo usuario</h4>
            <form id="usuAdd" autocomplete="off">
              <div class="form-row">
                <div class="form-group col">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required>
                  <small id="nomDesc" class="form-text text-muted">Nombre de usuario</small>
                </div>
                <div class="form-group col">
                  <label for="ape">Apellido</label>
                  <input type="text" class="form-control text-only" id="ape" name="ape" aria-describedby="apeDesc" required>
                  <small id="apeDesc" class="form-text text-muted">Apellidos del usuario</small>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label for="nusu">Usuario</label>
                  <input type="text" class="form-control" id="nusu" name="nusu" aria-describedby="nusuDesc" required>
                  <small id="nusuDesc" class="form-text text-muted">Nombre de acceso</small>
                </div>
                <div class="form-group col">
                  <label for="tlf">Teléfono</label>
                  <input type="text" class="form-control" id="tlf" name="tlf" aria-describedby="tlfDesc" required>
                  <small id="tlfDesc" class="form-text text-muted">Teléfono del usuario</small>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label for="pass">Clave</label>
                  <input type="password" class="form-control" id="pass" name="pass" aria-describedby="passDesc" required>
                  <small id="passDesc" class="form-text text-muted">Clave de acceso</small>
                </div>
                <div class="form-group col">
                  <label for="rPass">Confirmar clave</label>
                  <input type="password" class="form-control" id="rPass" name="rPass" aria-describedby="rPassDesc" required>
                  <small id="rPassDesc" class="form-text text-muted">Confirmar clave de acceso</small>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" aria-describedby="emailDesc" required>
                  <small id="emailDesc" class="form-text text-muted">Correo Electronico del usuario</small>
                </div>
                <div class="form-group col">
                  <label for="tipo">Tipo</label>
                  <select name="tipo" class="form-control custom-select" id="tipo" aria-describedby="tipoDesc" required>
                    <option value="">---------</option>
                    <option value="1">Administrador</option>
                    <option value="2">Común</option>
                  </select>
                  <small id="tipoDesc" class="form-text text-muted">Tipo de usuario</small>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col">
                  <label for="ask">Pregunta</label>
                  <input type="text" class="form-control text-only" id="ask" name="ask" aria-describedby="askDesc" required>
                  <small id="askDesc" class="form-text text-muted">Pregunta de seguridad</small>
                </div>
                <div class="form-group col">
                  <label for="res">Respuesta</label>
                  <input type="text" class="form-control text-only" id="res" name="res" aria-describedby="resDesc" required>
                  <small id="resDesc" class="form-text text-muted">Respuesta de seguridad</small>
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
		
		<script type="text/javascript">
			$('#ci').mask('A-00.000.000',{
			  'translation':{
			    A:{pattern: /[VE,ve]/}
			  },
			  clearIfNotMatch: true
			});

			$('#tlf').mask('(0000)-000-0000');

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