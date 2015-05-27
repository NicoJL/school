<div class="container divLogin">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 login">
			<form action="<?=base_url()?>alumnos/checkLogin" method="post">
				<div class="form-group">
					<label for="txtUser">Usuario</label>
					<input type="text" name="txtUser" id="txtUser" class="form-control" required />
				</div>
				<div class="form-group">
					<label for="txtPass">Contraseña</label>
					<input type="password" name="txtPass" id="txtPass" class="form-control" required />
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" value="Ingresar" />
				</div>
			</form>
			<div class="not">
				<?=validation_errors()?>
			</div>
			<span class="not"><?=$msj?></span>
			<div>
				<a href="<?=base_url()?>alumnos/registro">Registrate</a>
			</div>
		</div>
	</div>
</div>