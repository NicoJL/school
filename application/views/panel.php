<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel de alumnos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<style>

		html,body{
			background-color: #8C1111;
			color: #fff;
		}

		.grupo{
			
			font-size: 20px;
			font-weight: bold;

		}

		.wrapper{
			background-color: #cbcbcb;
			color:#000;
			margin-top: 50px;
			min-height: 500px;
		}

	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 wrapper">
				<p class="pull-right"><a href="<?=base_url()?>alumnos/cerrar"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>Cerrar Sesión</a></p>
				<p class="grupo"><strong><?=$grado?></strong>  <strong><?=$grupo?></strong></p><hr>
				<p>Bienvenido <strong><?=$user?></strong></p>
				<hr>
				<p>ARCHIVOS</p>
				<?php if($files->num_rows()>0){?>
				<?php foreach($files->result() as $fl){?>
					<a href="<?=base_url()?>uploads/<?=$fl->file_name?>" target="_blank" title="visualizar/descargar archivo"><?=$fl->file_name?></a>
					<p style="font-size:10px;">Subido el <?=$fl->group_file_date?></p>
				<?php }} else { ?>
				<p>No hay archivos en este grupo</p>
				<?php } ?>
			</div>
			
		</div>
	</div>

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>