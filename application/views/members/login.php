<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1 , maximum-scale=1" />
	<title><?=$title?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<style>
		body,html{
			background: #286090;
			height: 100%;
			margin:0;
			max-width: 100%;
			width: 100%

		}
		.divLogin{
			background-color: white;
			border:1px solid #286090;
			border-radius:3px;
			box-shadow: 0px 3px 3px rgba(0,0,0,0.5);
			margin-top:10%;
			padding: 10px;
		}

	</style>
</head>
<body>
	<div class="container container-login">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 col-xs-9 col-xs-offset-1 divLogin">
				<p style="text-align:center;font-weight:bold;color:#286090;">INGRESO DE USUARIOS</p>
				<form action="<?=base_url()?>members/panel/checkLogin" method="post">
					<div class="form-group">
						<label for="txtUser">Usuario</label>
						<input type="text" id="txtUser" name="txtUser" class="form-control" />
					</div>
					<div class="form-group">
						<label for="txtPass">Contraseña</label>
						<input type="password" id="txtPass" name="txtPass" class="form-control" />
					</div>
						<input type="submit" class="btn btn-info pull-right" value="Ingresar" />
				</form>
				<div class="not">
					<?=validation_errors()?>
				</div>
				<span class="not"><?=$msj?></span>
			</div>
		</div>
	</div>
</body>
</html>