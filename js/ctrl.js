let control = 1;
$(document).ready(function(){
	$('.add').each(function(e){
		$(this).bind('click', addField);
	})
})

function addField(){
	control++;
	//console.log(control)

	let clickID = parseInt($(this).attr('id'));
	//console.log(clickID)
	let newID = (clickID+1);

	$newClone = $('#cont_'+clickID).clone(true);
	$newClone.attr('id', 'cont_'+newID);

	$newClone.find('#nom_'+clickID).attr('id','nom_'+newID).val('');
	$newClone.find('#cant_'+clickID).attr('id', 'cant_'+newID).val('');

	$newClone.find('.add').attr('id', newID);
	$newClone.insertAfter($('#cont_'+clickID));

	let can = parseInt($('input[name=count]').val());
	let cal = (can + 1);
	$('input[name=count]').val(cal)

	$('#'+clickID).find('span').removeClass('oi-plus').addClass('oi-circle-x');
	$('#'+clickID).unbind('click', addField);
	$('#'+clickID).bind('click', delField);
}

function delField(){
	$(this).closest('section').remove()
	let cnt = $('input[name=count]').val();
	let calc = (cnt - 1);
	$('input[name=count]').val(calc)
}