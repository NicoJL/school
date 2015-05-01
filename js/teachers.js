$(function(){

	var ruta = $('#ruta').val();
	$('.btnDelete').click(function(){
		 identificador = $(this).data('identificador');
		$('#myModal').modal('show');
		hermano = $(this).parent().parent().find('td.tdStatus');
		
	});

	$('.btnConfirmDelete').on('click',function(){
		deleteTeacher(identificador);
	});

	function deleteTeacher(id){
		
		$.ajax({
			url:ruta,
			beforeSend:function(){

			},
			type:'post',
			data:{'id':id},
			dataTye:'text',
			success:function(response){
				hermano.html('<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>');
			},
	        complete:function(xhr)
	        {
	            $('#myModal').modal('hide');
	        },
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        }


		});
	}

});