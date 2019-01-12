/* #################### HOME #################### */
$(document).on('click', '#est', function(){
	$('#content').load('../html/s_est.html')
})

$(document).on('click', '#doc', function(){
	$('#content').load('../html/s_doc.html')
})

$(document).on('click', '#ot', function(){
	$('#content').load('../html/s_ot.html')
})

$(document).on('click', '#login', function(){
	$('#content').load('../html/login.html')
})

/* #################### LOGIN #################### */
$(document).on('submit', '#send', function(e){
	e.preventDefault();
	let user = $('#user').val()
	let pass = $('#password').val()
	$.ajax({
		url: '../php/methods/login.php',
		type: 'post',
		dataType: 'json',
		data: {
			us: user,
			ps: pass
		},
	})
	.done(function(res){
		if(res['confirm'] != 1){
			alert('¡Usuario y/o Clave Incorrectos!')
			$('#user').val('').focus()
			$('#password').val('')
		}else{
			alert('¡Usuario aceptado!')
			Cookies.set('usu', res['nusu'], {path: '/', expires: 0.3})
			Cookies.set('nom', res['nom'], {path: '/', expires: 0.3})
			Cookies.set('lvl', res['tipo'], {path: '/', expires: 0.3})
			location.href = '../html/start.php'
		}
	})
})

/* #################### LOGOUT #################### */
$(document).on('click', '#logout', function(){
	Cookies.remove('usu', {path:'/'})
	Cookies.remove('nom', {path:'/'})
	Cookies.remove('lvl', {path:'/'})
	location.href = '../'
})

/* #################### LINKS #################### */
$(document).on('click', '#main', function(){
	location.href = '../html/start.php'
})

$(document).on('click', '#index', function(){
	location.href = '../html/index.php'
})

$(document).on('click', '#reg_est', function(){
	location.href = "../html/reg_est.php"
})

$(document).on('click', '#reg_doc', function(){
	location.href = "../html/reg_doc.php"
})


$(document).on('click', '#reg_estC', function(){
	location.href = "../html/reg_estC.php"
})

$(document).on('click', '#st_r', function(){
	location.href = "../html/reg_inv.php"
})

$(document).on('click', '#st_l', function(){
	location.href = "../php/list_inv.php"
})

$(document).on('click', '#st_d', function(){
	location.href = "../html/stock_d.php"
})

$(document).on('click', '#list_est', function(){
	location.href = "../php/list_estu.php"
})

$(document).on('click', '#list_doc', function(){
	location.href = "../php/list_doc.php"
})

$(document).on('click', '#list_doc_reg', function(){
	location.href = "../php/list_days_doc.php"
})

$(document).on('click', '#list_est_reg', function(){
	location.href = "../php/list_days_est.php"
})

$(document).on('click', '#list_est_day', function(){
	location.href = "../php/list_est_daily.php"
})

$(document).on('click', '#list_est_nr', function(){
	location.href = "../php/list_ns_est.php"
})

$(document).on('click', '#list_doc_nr', function(){
	location.href = "../php/list_ns_doc.php"
})

/* ******************************************************** */
/* *************** LISTADO DINAMICO DE PNF **************** */
/* ******************************************************** */

$(document).on('click', '.list', function(){
	let id = $(this).attr('id')
	let arr = id.split('_')
	$('body').load('../php/list_pnfs.php', {'val':arr[2]})
})

/* ******************************************************** */
/* ******************************************************** */
/* ******************************************************** */

$(document).on('click', '#re_daily', function(){
	location.href = "../php/list_daily.php"
})

$(document).on('click', '#re_week', function(){
	location.href = "../php/list_week.php"
})

$(document).on('click', '#re_month', function(){
	location.href = "../php/list_month.php"
})

$(document).on('click', '#cn_ue', function(){
	location.href = "../php/list_estu.php"
})

$(document).on('click', '#cn_ud', function(){
	location.href = "../php/list_doc.php"
})

$(document).on('click', '#cn_us', function(){
	location.href = "../php/list_inv.php"
})

$(document).on('click', '#gblde', function(){
	location.href = "../php/list_days_est.php"
})

$(document).on('click', '#cn_up', function(){
	location.href = "../php/list_pnf.php"
})

$(document).on('click', '#reg_admin', function(){
	location.href = "../html/add_admin.php"
})

$(document).on('click', '#change_pss', function(){
	location.href = "../html/change.php"
})

$(document).on('click', '#add_pnf', function(){
	location.href = "../html/add_pnf.php"
})

$(document).on('click', '#list_pnf', function(){
	location.href = "../php/list_pnf.php"
})

/* #################### FUNCTIONS #################### */
$(document).on('submit', '#est_add', function(e){
	e.preventDefault()
	let form = $('#est_add').serialize()
	$.ajax({
		url: '../php/class/estudiantes.php',
		type:'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		window.location.reload()
	})
})

$(document).on('submit', '#st_add', function(e){
	e.preventDefault()
	let form = $('#st_add').serialize()
	$.ajax({
		url: '../php/class/inventario.php',
		type:'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		window.location.reload()
	})
})

$(document).on('submit', '#sEst', function(e){
	e.preventDefault()
	let dat = $('#searchField').val()
	if(dat === ''){
		return false;
	}
	$('body').load('../php/consu_estu.php', {val:dat})
})

$(document).on('submit', '#sDoc', function(e){
	e.preventDefault()
	let dat = $('#searchField').val()
	if(dat === ''){
		return false;
	}
	$('body').load('../php/consu_doc.php', {val:dat})
})

$(document).on('submit', '#sOt', function(e){
	e.preventDefault()
	let cc = $('#fieldCC').val()
	let na = $('#fieldNA').val()
	if(cc === '' || na === ''){
		return false;
	}
	$.ajax({
		url: '../php/consu_ot.php',
		type: 'post',
		data: {nomape:na,ci:cc}
	})
	.done(function(res){
		$('#content').html(res)
		window.location.reload()
	})
	
})

$(document).on('click', '#reg_asis', function(){
	let arr = this.value.split(',')
	let day = arr[0]
	let car = arr[1]
	$.ajax({
		url: '../php/class/asistencias.php',
		type: 'post',
		data: {dd:day, ct:car, orden:'add'},
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res);
		$('body').load('../php/consu_estu.php', {val:car})
	})
})

$(document).on('click', '#reg_asisDoc', function(){
	let arr = this.value.split(',')
	console.log(arr)
	let day = arr[0]
	let ced = arr[1]
	$.ajax({
		url: '../php/class/asistencias.php',
		type: 'post',
		data: {dd:day, ced:ced, orden:'addC'},
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res);
		$('body').load('../php/consu_doc.php', {val:ced})
	})
})

$(document).on('click', '#del_est', function(){
	let ced = this.value
	let conf = confirm('¿Desea eliminar este registro?');
  if(conf){
		$.ajax({
			url: '../php/class/estudiantes.php',
			type: 'post',
			data: {orden: 'del', aux: ced},
			dataType: 'html'
		})
		.done(function(res){
			$('#content').html(res)
			window.location.reload()
		})
	}
})

$(document).on('click', '#del_st', function(){
	let id = this.value
	let conf = confirm('¿Desea eliminar este registro?');
  if(conf){
		$.ajax({
			url: '../php/class/inventario.php',
			type: 'post',
			data: {orden: 'del', aux: id},
			dataType: 'html'
		})
		.done(function(res){
			$('#content').html(res)
			window.location.reload()
		})
	}
})

$(document).on('click', '#upd_est', function(){
	let ced = this.value
	$.ajax({
		url: '../html/upd_est.php',
		type: 'post',
		data: {val:ced},
		dataType: 'html'
	})
	.done(function(res){
		$('body').html(res)
	})
})

$(document).on('submit', '#est_upd', function(e){
	e.preventDefault()
	let form = $('#est_upd').serialize()
	$.ajax({
		url: '../php/class/estudiantes.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#list_est').click()
	})
})

$(document).on('click', '#upd_st', function(){
	let id = this.value
	$.ajax({
		url: '../html/upd_st.php',
		type: 'post',
		data: {val:id},
		dataType: 'html'
	})
	.done(function(res){
		$('body').html(res)
	})
})

$(document).on('submit', '#st_upd', function(e){
	e.preventDefault()
	let form = $('#st_upd').serialize()
	$.ajax({
		url: '../php/class/inventario.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#st_l').click()
	})
})

$(document).on('submit', '#usuAdd', function(e){
	e.preventDefault()
	let form = $('#usuAdd').serialize()
	$.ajax({
		url: '../php/class/usuarios.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
	})
})

$(document).on('submit', '#noPass', function(e){
  e.preventDefault();
  var form = $('#noPass').serialize();
  $.ajax({
  	url: '../php/class/usuarios.php',
    type: 'post',
    data: form,
    dataType: 'json'
  })
  .done(function(datos){
    if(datos['valida'] === 1){
      alert('¡Datos aprovados!')
      $('#contenedor').load('../html/recovery.php', {aux:datos['id'], oldP:datos['pass']})
    }else{
      alert('¡Datos incorrectos, intente de nuevo!')
      $('#ask').val('')
      $('#res').val('')
      $('#nom').val('').focus()
    }
  });
});

$(document).on('submit', '#recovery', function(e){
  e.preventDefault();
  var form = $('#recovery').serialize();
  $.ajax({
  	url: '../php/class/usuarios.php',
    type: 'post',
    data: form,
    dataType: 'html'
  })
  .done(function(html){
    $('#content').html(html)
  })
})

$(document).on('submit', '#updPass', function(e){
  e.preventDefault();
  var form = $('#updPass').serialize();
  $.ajax({
  	url: '../php/class/usuarios.php',
    type: 'post',
    data: form,
    dataType: 'html'
  })
  .done(function(html){
    $('#content').html(html)
  })
})

$(document).on('submit', '#stdi', function(e){
	e.preventDefault()
	let form = $('#stdi').serialize()
	$.ajax({
		url: '../php/class/inventario.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
	})
})

$(document).on('submit', '#pnfAdd', function(e){
	e.preventDefault()
	let form = $('#pnfAdd').serialize()
	$.ajax({
		url: '../php/class/main.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		window.location.reload()
	})
})

$(document).on('click', '#upd_pnf', function(){
	let id = this.value
	$.ajax({
		url: '../html/edit_pnf.php',
		type: 'post',
		data: {val:id},
		dataType: 'html'
	})
	.done(function(res){
		$('body').html(res)
	})
})

$(document).on('submit', '#pnf_upd', function(e){
	e.preventDefault()
	let form = $('#pnf_upd').serialize()
	$.ajax({
		url: '../php/class/main.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#list_pnf').click()
	})
})

$(document).on('click', '#del_pnf', function(){
	let id = this.value
	let conf = confirm('¿Desea eliminar este registro?');
  if(conf){
		$.ajax({
			url: '../php/class/main.php',
			type: 'post',
			data: {orden: 'delPnf', aux: id},
			dataType: 'html'
		})
		.done(function(res){
			$('#content').html(res)
			window.location.reload()
		})
	}
})

$(document).on('submit', '#add_reg', function(e){
	e.preventDefault()
	let form = $('#add_reg').serialize()
	$.ajax({
		url: '../php/class/main.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#main').click()
	})
})

$(document).on('submit', '#doc_add', function(e){
	e.preventDefault()
	let form = $('#doc_add').serialize()
	$.ajax({
		url: '../php/class/docentes.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		window.location.reload()
	})
})

$(document).on('click', '#upd_doc', function(){
	let ced = this.value
	$.ajax({
		url: '../html/upd_doc.php',
		type: 'post',
		data: {val:ced},
		dataType: 'html'
	})
	.done(function(res){
		$('body').html(res)
	})
})

$(document).on('submit', '#doc_upd', function(e){
	e.preventDefault()
	let form = $('#doc_upd').serialize()
	$.ajax({
		url: '../php/class/docentes.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#list_doc').click()
	})
})

$(document).on('click', '#del_doc', function(){
	let ced = this.value
	let conf = confirm('¿Desea eliminar este registro?');
  if(conf){
		$.ajax({
			url: '../php/class/docentes.php',
			type: 'post',
			data: {orden: 'del', aux: ced},
			dataType: 'html'
		})
		.done(function(res){
			$('#content').html(res)
			window.location.reload()
		})
	}
})

$(document).on('click', '#edt_esD', function(){
	let car = this.value
	$.ajax({
		url: '../html/upd_day_est.php',
		type: 'post',
		data: {val:car},
		dataType: 'html'
	})
	.done(function(res){
		$('body').html(res)
	})
})

$(document).on('submit', '#dEst_upd', function(e){
	e.preventDefault()
	let form = $('#dEst_upd').serialize()
	$.ajax({
		url: '../php/class/main.php',
		type: 'post',
		data: form,
		dataType: 'html'
	})
	.done(function(res){
		$('#content').html(res)
		$('#list_est_reg').click()
	})
})