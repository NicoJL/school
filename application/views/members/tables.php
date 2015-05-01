<script src="<?=base_url()?>js/jquery.dataTables.min.js"></script>
<script>
	$(function(){
		$('#tblTechers').DataTable({
			//"bLengthChange": false,
			'oLanguage': {
	            "oPaginate": {
	                "sFirst": "Inicio",
	                "sLast": "Último",
	                "sNext": "Siguiente",
	                "sPrevious": "Anterior"
	            },
	            "sLengthMenu": "Mostrar _MENU_ resultados",
	            "sSearch": "Búsqueda",
	            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
	            "sZeroRecords": "No hay resultados disponibles"
			}
		});
	});
</script>