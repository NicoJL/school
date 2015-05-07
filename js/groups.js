$(function(){

	var ruta = $('#ruta').val() , rutaChangeG = $('#rutaChangeG').val(),
	rutaChangeT = $('#rutaChangeT').val() , groupId = $('#txtIdGroupT').val(),
	rutaPass = $('#rutaChangePass').val() , nameFile;
	$('#spnPass').text('');
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

	$('#btnConfirmFile').click(addFiles);

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

	$('#btnFile').click(function(){
		document.querySelector('#divProgress').style.width = '0%';
		$('#btnConfirmFile').attr('disabled','true');
		$('#pLoader').text('');
		$('#inputFile').val('');
		$('#txtFile').val('');
		$('#modalFile').modal('show');
	});

	$('#inputFile').on('change',uploadFile);

	$('#lstChangeG').on('change',function(){
		group = $(this).val();
	});

	$('#txtNewPass').keyup(function(){
		$('#btnConfirmPass').removeAttr('disabled');
	});

	$('#btnChangePass').click(function(){
		$('#txtNewPass').val('');
		$('#modalChangePass').modal('show');
	});


	function addFiles(){
		rutaAddFile = $('#rutaAddFile').val();
		$.ajax({

			url:rutaAddFile,
			type:'post',
			data:{'id_group':groupId,'file_name':$('#txtFile').val()},
			dataTye:'text',
			beforeSend:function(){
				$('#btnConfirmFile').attr('disabled','true');
				$('.loader').css('display','inline-block');
			},
			success:function(response){
				if(response)
					$('#spnPass').text('archivo guardado en el grupo');
				else
					alert('hubo un error al insertar el archivo');
			},
			complete:function(){
				$('#modalFile').modal('hide');
	            $('.loader').css('display','none');
	            $('#btnConfirmFile').removeAttr('disabled');
			},
			error:function(xhr,error,estado){
				alert(xhr+" "+error+" "+estado);
			},
			timeout:15000

		});
	}

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
	            alert(xhr+" "+error+" "+estado);
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
		            alert(xhr+" "+error+" "+estado);
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
	            alert(xhr+" "+error+" "+estado);
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
	            alert(xhr+" "+error+" "+estado);
	        },
	        timeout:15000


		});
	}


	function uploadFile(e){
		e.preventDefault();
		var rutaFile = $('#rutaFile').val();
		document.querySelector('#divProgress').style.width = '0%';
		$('#pLoader').text('');
		var files = e.target.files;
		if(window.FormData){
			for(var i = 0; i<files.length; i++){
				var file = files[i];
					if(file.size<=2097152){
						if(file.type.match(/image|pdf|doc|docx.*/)){
							var FD = new FormData();
							FD.append('user_file',file);
							ajax = new XMLHttpRequest();
							ajax.open('POST',rutaFile,true);
							ajax.addEventListener('load',function(e){
								if(this.status == 200){
									if(this.response!='error'){
										$('#txtFile').val(this.response);
										nameFile = this.response;
										$('#pLoader').text('Archivo cargado');
										$('#btnConfirmFile').removeAttr('disabled');
									}
									else{
										$('#pLoader').text('No se pudo subir el archivo');
									}
								}
							});
							$('#pLoader').text('Subiendo el archivo....');
							ajax.upload.addEventListener('progress',function(e){
								if(e.lengthComputable){
									document.querySelector('#divProgress').style.width = ((e.loaded / e.total) * 100)+'%';
								}
							});
							ajax.send(FD);
					}else{
						$('#pLoader').text('El tipo de archivo no esta permitido');
					}
				}else{
					$('#pLoader').text('El archivo supera los 2Mb permitidos');
				}
			}
		}else{
			$('#pLoader').text('Utiliza un navegador mas moderno para realizar esta operación');
		}
	}

});