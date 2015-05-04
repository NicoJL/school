$(function(){

	var ruta = $('#ruta').val();
	$('#lstGroup').on('change',function(){
		$('#frmGroups').submit();
	});

	$('.btnDelete').click(function(){
		 identificador = $(this).data('identificador');
		$('#myModal').modal('show');
		hermano = $(this).parent().parent().find('td.tdStatus');
		
	});

	$('.btnConfirmDelete').on('click',function(){
		$(this).attr('disabled','true');
		deleteStudent(identificador);
	});

	function deleteStudent(id){
		
		$.ajax({
			url:ruta,
			beforeSend:function(){
				$('.loader').css('display','inline-block');
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
	            $('.loader').css('display','none');
	            $('.btnConfirmDelete').removeAttr('disabled');
	        },
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        },
	        timeout:15000


		});
	}

});