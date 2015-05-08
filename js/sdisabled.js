$(function(){

	var ruta = $('#ruta').val();
	$('#pUser').text('');

	$('.btnAllow').click(function(){
		idS = $(this).data('identificador');
		n = $(this).parent().parent().find('td.tdStudent span');
		hermano = $(this).parent().parent().find('td.tdStatus');
		$('#pUser').text(n.text());
		$('#myModal').modal('show');

	});

	$('#btnConfirmAllow').click(function(){
		$(this).attr('disabled','true');
		allowStudent(idS);
	});


	function allowStudent(){

		$.ajax({
			url:ruta,
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			type:'post',
			data:{'id':idS},
			dataTye:'text',
			success:function(response){
				if(response == 1 || response == '1')
					hermano.html('<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>');
				else
					alert('ocurrio un error al activar al alumno');
			},
	        complete:function(xhr)
	        {
	            $('#myModal').modal('hide');
	            $('.loader').css('display','none');
	            $('#btnConfirmAllow').removeAttr('disabled');
	        },
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        },
	        timeout:15000
		});
	}

});