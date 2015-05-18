<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1 , maximum-scale=1" />
	<title>ESCUELA MELCHOR OCAMPO</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>css/normalize.css">
	<link rel="stylesheet" href="<?=base_url()?>css/style.css">
	
</head>
<body>
	<nav class="navbar navbar-default menu" role="navigation">
		<div class="container">
			<div class="navbar-header">
			 	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
          		</button>
	           <a class="navbar-brand" href="#">
	           	<img src="<?=base_url()?>img/logo.png" class="logo hidden-sm hidden-xs" />
	           	<img src="<?=base_url()?>img/logo.png" class="logoresp hidden-lg hidden-md" />
	          </a>
			</div>
			<div class="collapse navbar-collapse navbar-right">
				<ul class="nav navbar-nav">
					<li><a href="<?=base_url()?>">Inicio</a></li>
					<li><a href="<?=base_url()?>inicio/escuela">Conócenos</a></li>
					<li><a href="<?=base_url()?>avisos/categoria/1">Noticias</a></li>
					<li><a href="<?=base_url()?>avisos/categoria/2">Avisos</a></li>
					<li><a  href="<?=base_url()?>avisos/categoria/3" >Eventos</a></li>
					<li><a href="<?=base_url()?>alumnos">Alumnos</a></li>
					<li><a href="<?=base_url()?>contacto">Contacto</a></li>
				</ul>
				<form method="post" action="<?=base_url()?>avisos/busqueda" class="navbar-form navbar-left" role="search">
		        <div class="form-group">
			          <input type="text" name="txtSearch" class="form-control" placeholder="Búsqueda" required />
			        </div>
	        		<button type="submit" class="btn btn-default btnSearch">Ir</button>
      			</form>
			</div>			
		</div>

	</nav>