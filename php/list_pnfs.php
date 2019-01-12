<script type="text/javascript">
$(document).ready(function() {
  $('#results').load('../php/data_pnfs.php', {'val':'<?php echo $_POST['val'] ?>' })
  
  $('#results').on('click', '.pagination a', function (e){
    e.preventDefault()
    var page = $(this).attr('data-page')
    var id = $('#id').val()
    if(page == 'NaN'){
      return false
    }
    $('#results').load('../php/data_pnfs.php',{'id':page, 'val':id})
  });
});
</script>

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

    <?php include '../html/sidebar.php'; ?>
          
    <div class="justify-content-md-center p-3 p-md-5 m-md-3 text-center" id="results">
      <h4>Listado de estudiantes por PNF</h4>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
<div id="content"></div>
<?php include '../html/footer.html'; ?>