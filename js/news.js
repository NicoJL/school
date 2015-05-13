$(function(){
	var rutaFile = $('#rutaFile').val() , file = $('#txtJs').data('ruta');
	$('#pLoader').text('');

	$('#inputFile').on('change',uploadFile);

	function uploadFile(e){
		e.preventDefault();
		document.querySelector('#divProgress').style.width = '0%';
		$('#pLoader').text('');
		$('#txtFile').val('');
		var files = e.target.files;
		if(window.FormData){
			for(var i = 0; i<files.length; i++){
				var file = files[i];
					if(file.size<=2097152){
						if(file.type.match(/image.*/)){
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
