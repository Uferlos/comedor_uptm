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
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row d-flex d-md-block flex-nowrap wrapper">
        <div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width hide" id="sidebar">
          <div class="list-group border-0 card text-center text-md-left">
            <a href="javascript:void(0)" id="login" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-key"></span>
              <span class="d-none d-md-inline">Iniciar Sesión</span>
            </a>
            <a href="javascript:void(0)" id="est" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-person"></span>
              <span class="d-none d-md-inline">Estudiantes</span>
            </a>
            <a href="javascript:void(0)" id="doc" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-person"></span>
              <span class="d-none d-md-inline">Docentes</span>
            </a>
            <a href="javascript:void(0)" id="ot" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
              <span class="oi oi-person"></span>
              <span class="d-none d-md-inline">Otros</span>
            </a>
          </div>
        </div>

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="../img/front.png" height="650" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="../img/comedor.jpg" height="650" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="../img/uni.jpg" height="650" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
          <div class="bg-primary mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 py-3">
              <h2 class="display-5">Misión</h2>
              <p class="lead">
                Contribuir a la formación y desarrollo integral del estudiante a través del
                ofrecimiento de servicios con condiciones de equidad social a fin de
                desarrollar sus potencialidades emprendedoras en cada una de sus
                actividades, que permitan desarrollar capacidades y competencias,
                garantizando su vinculación efectiva y sentido de pertinencia con la
                institución tanto a nivel académico, como personal, social y asistencial.
              </p>
            </div>
          </div>
          <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
            <div class="my-3 p-3">
              <h2 class="display-5">Visión</h2>
              <p class="lead">
                Ser reconocido por liderizar un modelo de gestión de desarrollo
                estudiantil, con la capacidad de respuesta oportuna y amplia, capas de
                fortalecer los servicios de atención socio económico, mediante el
                reforzamiento de actividades para que los servicios existentes tengan una
                mayor cobertura y lo que están por implementarse logren satisfacer las
                necesidades de la comunidad estudiantil con el orgullo de pertenecer a
                nuestra alma mater siendo reconocida por organizaciones civiles, estatales, y
                nacionales.
              </p>
            </div>
          </div>
        </div>

        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
          <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
            <div class="my-3 p-3">
              <h2 class="display-5">Requisitos para el servicio del comedor</h2>
              <p class="lead">
                Presentar carnet estudiantil vigente
                en el caso de no poseer carnet estudiantil presentar constancia de estudio.
              </p>
            </div>
          </div>
          <div class="bg-primary mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center text-white overflow-hidden">
            <div class="my-3 py-3">
              <h2 class="display-5">Requisitos para optar por el uso del comedor</h2>
              <p class="lead">
                Para poder utilizar el servicio del comedor se deberá registrar en el lapso
                de tiempo establecido por el departamento de Bienestar Estudiantil.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="content"></div>
    <?php include 'footer.html'; ?>
  </body>
</html>

<?php
error_reporting(E_ERROR);
if(($_COOKIE['usu'] != null) || ($_COOKIE['ape'] != null) || ($_COOKIE['lvl'] != null)): ?>
  <script type="text/javascript">
    Cookies.remove('usu', {path:'/'});
    Cookies.remove('nom', {path:'/'});
    Cookies.remove('lvl', {path:'/'})
  </script>
<?php endif; ?>