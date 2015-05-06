$(function(){

	var ruta = $('#ruta').val() , rutaChangeG = $('#rutaChangeG').val(),
	rutaChangeT = $('#rutaChangeT').val() , groupId = $('#txtIdGroupT').val(),
	rutaPass = $('#rutaChangePass').val();
	$('#btnConfirmPass').attr('disabled','true');

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


	$('#btnConfirmPass').click(function(){
		changePass();
	});

	$('#btnChangeT').click(function(){
		$(this).attr('disabled','true');
		changeTeacher();

	});

	$('#btnChangeTeacher').click(function(){
		$('#modalChangeTeacher').modal('show');
	});

	$('#lstChangeG').on('change',function(){
		group = $(this).val();
	});

	$('#txtNewPass').keyup(function(){
		$('#btnConfirmPass').removeAttr('disabled');
	});

	$('#bntChangePass').click(function(){
		$('#txtNewPass').val('');
		$('#modalChangePass').modal('show');
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
					alert('ocurrio un error al agregar el nuevo grupo');
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


	$('#lstTeacher').change(function(){
		teacherId = $(this).val();
		teacherName = $('option:selected',this).text();
	});

	function changePass(){
		newPass = $('#txtNewPass').val();
		if(newPass != ""){
			$.ajax({
				url:rutaPass,
				beforeSend:function(){
					$('.loader').css('display','inline-block');
				},
				type:'post',
				data:{'id_group':groupId , 'group_password':newPass},
				dataTye:'text',
				success:function(response){
					if(response)
						$('#spnPass').text('Contraseña modificada');
					else
						alert('revisa el inicio de sesión en este grupo con la nueva contraseña');
				},
		        complete:function(xhr)
		        {
		            $('#modalChangePass').modal('hide');
		            $('.loader').css('display','none');
		            $('#btnConfirmPass').attr('disabled','true');
		        },
				error:function(xhr,error,estado)
		        {
		            alert(xhr+" "+error+" "+estado)
		        },
		        timeout:15000

			});
		}
		else
			alert('la contraseña nueva no puede ser un valor vacio');
	}

	function changeTeacher(){
		$.ajax({
			url:rutaChangeT,
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			type:'post',
			data:{'id_group':groupId , 'id_teacher':teacherId},
			dataTye:'text',
			success:function(response){
				if(response)
					$('.pTeacher').html('<strong>MAESTRO: </strong>'+teacherName);
				else
					alert('ocurrio un error al cambiar el maestro');
			},
	        complete:function(xhr)
	        {
	            $('#modalChangeTeacher').modal('hide');
	            $('.loader').css('display','none');
	            $('#btnChangeT').removeAttr('disabled');
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