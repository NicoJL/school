$(function(){

	var ruta = $('#ruta').val() , rutaChangeG = $('#rutaChangeG').val();

	$('#lstGroup').on('change',function(){
		$('#frmGroups').submit();
	});

	$('.btnDelete').click(function(){
		 identificador = $(this).data('identificador');
		$('#myModal').modal('show');
		hermano = $(this).parent().parent().find('td.tdStatus');
		
	});

	$('#btnAceptG').click(function(){
		$(this).attr('disabled','true');
		changeGroup(group,idS);
	});

	$('.btnChangeG').click(function(){
		idS = $(this).data('ide');
		$('#modalChangeG').modal('show');
		ren = $(this).parent().parent();
	});

	$('.btnConfirmDelete').on('click',function(){
		$(this).attr('disabled','true');
		deleteStudent(identificador);
	});

	$('#lstChangeG').on('change',function(){
		group = $(this).val();
	});

	function changeGroup(id,id_student){
		$.ajax({
			url:rutaChangeG,
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			type:'post',
			data:{'id_group':id , 'id_student':id_student},
			dataTye:'text',
			success:function(response){
				if(response)
					ren.css('background-color','#E86C19');
				else
					alert('ocurrio un error agregar el nuevo grupo');
			},
	        complete:function(xhr)
	        {
	            $('#modalChangeG').modal('hide');
	            $('.loader').css('display','none');
	            $('#btnAceptG').removeAttr('disabled');
	        },
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        },
	        timeout:15000


		});
	}

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