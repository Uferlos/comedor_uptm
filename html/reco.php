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
        
         <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width hide" id="sidebar">
          <div class="list-group border-0 card text-center text-md-left">
            <a href="javascript:void(0)" id="login" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-key"></span>
              <span class="d-none d-md-inline">Administrador</span>
            </a>
            <a href="javascript:void(0)" id="est" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-person"></span>
              <span class="d-none d-md-inline">Estudiante</span>
            </a>
          </div>
        </div>

        <div id="contenedor" class="justify-content-md-center p-3 p-md-5 m-md-3 text-center">
          <h4>Recuperacion de clave de acceso</h4>
            <form id="noPass" autocomplete="off">
              <div class="form-row">
                <div class="form-group col">
                  <label for="nom">Nombre</label>
                  <input type="text" class="form-control text-only" id="nom" name="nom" aria-describedby="nomDesc" required>
                  <small id="nomDesc" class="form-text text-muted">Nombre de usuario</small>
                </div>
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

              <input type="hidden" name="orden" value="recu">

              <button type="submit" class="btn btn-primary">Procesar</button>
              <button type="button" class="btn btn-secondary" id="index">Cancelar</button>
            </form>
          </div>
        </div>

      </div>
    </div>
		
    <script>
      $('.text-only').keydown(function(v){
        if ((v.keyCode > 47 && v.keyCode < 58)){
          v.preventDefault();
        }
      });
    </script>

		<div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>