$(function(){

	var ruta = $('#ruta').val() , rutaEdit = $('#rutaEdit').val(),
	btnAccion = $('#tblTeachers');

	//$('.btnDelete').click(function(){
	btnAccion.on('click','tr .btnDelete',function(){	
		 identificador = $(this).data('identificador');
		$('#myModal').modal('show');
		hermano = $(this).parent().parent().find('td.tdStatus');
		
	});

	$('.btnConfirmDelete').on('click',function(){
		$(this).attr('disabled','true');
		deleteTeacher(identificador);
	});

	//$('.btnAllow').on('click',function(){
	btnAccion.on('click','tr .btnAllow',function(){		
		idAllow = $(this).data('idacive');
		hermano = $(this).parent().parent().find('td.tdStatus');
		load = $(this).parent().parent().find('td.tdStatus span.loading');
		allowTeacher(idAllow);
	});


	$('.btnConfirmEdit').on('click',function(){
		$(this).attr('disabled','true');
		updateTeacher();
	});


	//$('.btnEdit').click(function(){
	btnAccion.on('click','tr .btnEdit',function(){
		cleanFields();
		idTeacher = $(this).data('idteacher');
		idType = $(this).parent().parent().find('td span.spntype');
		nameT = $(this).parent().parent().find('td:first-child()');
		userT = $(this).parent().parent().find('td:nth-child(2)');
		passT = $(this).parent().parent().find('td:nth-child(3)');
		$('#txtNameT').val(nameT.text());
		$('#txtUser').val(userT.text());
		$('#txtPass').val(passT.text());
		$('#txtIdTeacher').val(idTeacher);
		$('#lstTipos option').each(function(){
			if($(this).val() == parseInt(idType.text()))
				$(this).attr('selected',true);
		});

		$('#modalEdit').modal('show');
	});

	function allowTeacher(id){
		
		$.ajax({
			url:ruta,
			beforeSend:function(){
				load.css('display','inline-block');
			},
			type:'post',
			data:{'id':id},
			dataTye:'text',
			success:function(response){
				if(response)
					hermano.html('<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>');
					
			},
	        complete:function(xhr)
	        {
	            load.css('display','none');
	           // $('.btnConfirmDelete').removeAttr('disabled');
	        },
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado);
	        },
	       timeout:15000


		});
	}


	function cleanFields(){
		$('#txtNameT').val('');
		$('#txtUser').val('');
		$('#txtPass').val('');
		$('#txtIdTeacher').val('');
	}


	function deleteTeacher(id){
		
		$.ajax({
			url:ruta,
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			type:'post',
			data:{'id':id},
			dataTye:'text',
			success:function(response){
				if(response)
					hermano.html('<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>');
				else
					hermano.html('<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>');
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


	function updateTeacher(id){

		$.ajax({

			url:rutaEdit,
			type:'post',
			data:$('#frmEditTeacher').serialize(),
			dataTye:'text',
			beforeSend:function(){
				$('.loader').css('display','inline-block');
			},
			success:function(response){
				if(response){
					nameT.text($('#txtNameT').val());
					userT.text($('#txtUser').val()); 
					passT.text($('#txtPass').val()); 
					idType.text($('#lstTipos option:selected').val());
				}
				else
					alert('hubo conflictos al realizar la edición de datos');
			},
			complete:function(){
				$('#modalEdit').modal('hide');
	            $('.loader').css('display','none');
	            $('.btnConfirmEdit').removeAttr('disabled');
			},
			error:function(xhr,error,estado)
	        {
	            alert(xhr+" "+error+" "+estado)
	        },
	       timeout:15000

		});
	}

});