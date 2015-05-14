<div class="container container-actions">
	<div class="row">
		<div class="col-sm-6 col-xs-offset-3">
			<p class="title" style="text-align:center;font-weight:bold;">PERFIL</p>
			<form action="<?=base_url()?>members/panel/editPerfil" method="post">
				<?php foreach($usuario->result() as $user){ ?>
				<div class="form-group">
					<label for="txtName">Nombre</label>
					<input name="txtName" id="txtName" class="form-control" type="text" value="<?=$user->teacher_name?>" required />
				</div>
				<div class="form-group">
					<label for="txtUser">Nombre de inicio de sesión</label>
					<input name="txtUser" id="txtUser" class="form-control" type="text" value="<?=$user->teacher_nick_name?>" required />
				</div>
				<div class="form-group">
					<label for="txtPass">Contraseña de acceso</label>
					<input type="text" name="txtPass" id="txtPass" class="form-control" value="<?=$user->teacher_password?>" required />
					<input type="hidden" name="txtId" id="txtId" value="<?=$user->id_teacher?>" />
					<input type="hidden" name="txtIdType" id="txtIdType" value="<?=$user->id_type?>" />
				</div>
				<?php } ?>
				<div class="form-group">
					<div class="col-xs-2 col-xs-offset-5">
						<input type="submit" class="btn btn-primary" value="Modificar datos">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<?=validation_errors()?>
						<?=$msj?>
					</div>
				</div>
			</form>
			
		</div>

	</div>

</div>
