$(function(){

	var ruta = $('#rutaDel').val();

	$('.btnDelete').click(function(){
		idNew = $(this).data('identificador');
		ren = $(this).parent().parent();
		$('#btnConfirmDel').removeAttr('disabled');
		$('#myModal').modal('show');
	});

	$('#btnConfirmDel').on('click',function(){
		$(this).attr('disabled','true');

		$.ajax({

			url:ruta,
			type:'post',
			data:{'id':idNew},
			dataType:'text',
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			success:function(response){
				if(response)
					ren.remove();
				else
					alert('ocurrio un error al eliminar');
			},
			 complete:function(xhr)
	        {
	            $('#myModal').modal('hide');
	            $('.loader').css('display','none');
	            $('#btnConfirmDel').removeAttr('disabled');
	        },
			error:function(xhr,error,estado){
				alert(xhr+" "+error+" "+estado)
			},
			timeout:15000

		});	

	});

});