<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1 , maximum-scale=1" />
	<title>TITULO</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	
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
					<li><a href="index.html">Inicio</a></li>
					<li><a href="#">Escuela</a></li>
					<li><a href="galeria.html">Noticias</a></li>
					<li><a href="contacto.html">Avisos</a></li>
					<li><a href="contacto.html">Eventos</a></li>
					<li><a href="contacto.html">Alumnos</a></li>
					<li><a href="contacto.html">Contacto</a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search">
		        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Búsqueda">
			        </div>
	        		<button type="submit" class="btn btn-default btnSearch">Ir</button>
      			</form>
			</div>			
		</div>

	</nav>