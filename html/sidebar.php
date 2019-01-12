<div class="col-md-2 float-left col-1 pl-0 pr-0 collapse width hide" id="sidebar">
  <div class="list-group border-0 card text-center text-md-left">
    
    <a href="#menu0" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-person"></span>
      <span class="d-none d-md-inline">Registros</span>
    </a>

    <div class="collapse" id="menu0">
      <a href="javascript:void(0)" id="reg_est" class="list-group-item" data-parent="#menu0">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Estudiantes
      </a>
      <a href="javascript:void(0)" id="reg_doc" class="list-group-item" data-parent="#menu0">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Docentes
      </a>
      <a href="javascript:void(0)" id="reg_estC" class="list-group-item" data-parent="#menu0">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Comedor
      </a>
    </div>
<?php if(($_COOKIE['lvl'] == 1)): ?>
    <a href="javascript:void(0)" id="list_est_day" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
      <span class="oi oi-browser"></span>
      <span class="d-none d-md-inline">Asistencia Diaria</span>
    </a>
<?php endif; ?>
    <a href="#menu1" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-document"></span>
      <span class="d-none d-md-inline">Ver Estudiantes</span>
    </a>

    <div class="collapse" id="menu1">
      <a href="javascript:void(0)" id="list_est_reg" class="list-group-item" data-parent="#menu1">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar con servicio</span>
      </a>
      <a href="javascript:void(0)" id="list_est_nr" class="list-group-item" data-parent="#menu1">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar sin servicio</span>
      </a>
      <a href="javascript:void(0)" id="list_est" class="list-group-item" data-parent="#menu1">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar Todos</span>
      </a>
      <a href="#submenu1" class="list-group-item" data-toggle="collapse" aria-expanded="false">
        Listar por PNF
      </a>
      <div class="collapse" id="submenu1">
        <!-- lista dinamica de pnf -->
      </div>
    </div>

    <a href="#menu5" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-document"></span>
      <span class="d-none d-md-inline">Ver Docentes</span>
    </a>

    <div class="collapse" id="menu5">
      <a href="javascript:void(0)" id="list_doc_reg" class="list-group-item" data-parent="#menu5">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar con servicio</span>
      </a>
      <a href="javascript:void(0)" id="list_doc_nr" class="list-group-item" data-parent="#menu5">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar sin servicio</span>
      </a>
      <a href="javascript:void(0)" id="list_doc" class="list-group-item" data-parent="#menu5">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar Todos</span>
      </a>
    </div>
<?php if(($_COOKIE['lvl'] == 1)): ?>
    <a href="#menu2" id="stock" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-cart"></span>
      <span class="d-none d-md-inline">Inventario</span>
    </a>

    <div class="collapse" id="menu2">
      <a href="javascript:void(0)" id="st_r" class="list-group-item" data-parent="#menu2">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Agregar
      </a>
      <a href="javascript:void(0)" id="st_l" class="list-group-item" data-parent="#menu2">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar
      </a>
      <a href="javascript:void(0)" id="st_d" class="list-group-item" data-parent="#menu2">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Uso Diario
      </a>
    </div>

    <a href="#menu3" id="report" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-clipboard"></span>
      <span class="d-none d-md-inline">Reportes</span>
    </a>

    <div class="collapse" id="menu3">
      <a href="javascript:void(0)" id="re_daily" class="list-group-item" data-parent="#menu3">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Diario
      </a>
      <a href="javascript:void(0)" id="re_week" class="list-group-item" data-parent="#menu3">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Semanal
      </a>
      <a href="javascript:void(0)" id="re_month" class="list-group-item" data-parent="#menu3">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Mensual
      </a>
    </div>

    <a href="#menu4" id="pnfs" class="list-group-item d-inline-block collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
      <span class="oi oi-book"></span>
      <span class="d-none d-md-inline">PNF</span>
    </a>

    <div class="collapse" id="menu4">
      <a href="javascript:void(0)" id="add_pnf" class="list-group-item" data-parent="#menu4">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Agregar
      </a>
      <a href="javascript:void(0)" id="list_pnf" class="list-group-item" data-parent="#menu4">
        <span class="oi oi-chevron-right"></span>
        <span class="d-none d-md-inline">Listar
      </a>
    </div>

    <a href="javascript:void(0)" id="reg_admin" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
      <span class="oi oi-shield"></span>
      <span class="d-none d-md-inline">Nuevo Usuario</span>
    </a>

<?php endif; ?>
    <a href="javascript:void(0)" id="change_pss" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
      <span class="oi oi-key"></span>
      <span class="d-none d-md-inline">Cambiar Clave</span>
    </a>

    <a href="javascript:void(0)" id="logout" class="list-group-item d-inline-block collapsed" data-parent="#sidebar">
      <span class="oi oi-power-standby"></span>
      <span class="d-none d-md-inline">Cerrar Sesión</span>
    </a>
  </div>
</div>
<script>
  $(document).ready(function(){
    $('#submenu1').load('../php/methods/load_side_pnf.php');
  })
</script>
