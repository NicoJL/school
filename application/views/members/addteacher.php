<div class="container container-actions">
	<div class="row">
		<div class="col-sm-6 col-xs-offset-3">
			<p class="title" style="text-align:center;font-weight:bold;">AGREGAR MAESTROS</p>
			<form action="<?=base_url()?>members/panel/addTeacher" method="post">
				<div class="form-group">
					<label for="lstTipos">Tipo</label>
					<select name="lstTipos" id="lstTipos" class="form-control">
						<?php foreach ($types->result() as $t) { ?>
							<option value="<?=$t->id_type?>"><?=$t->type_name?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="txtName">Nombre</label>
					<input name="txtName" id="txtName" class="form-control" type="text" required />
				</div>
				<div class="form-group">
					<label for="txtUser">Nombre de inicio de sesión</label>
					<input name="txtUser" id="txtUser" class="form-control" type="text" required />
				</div>
				<div class="form-group">
					<label for="txtPass">Contraseña de acceso</label>
					<input type="text" name="txtPass" id="txtPass" class="form-control" required />
				</div>
				<div class="form-group">
					<div class="col-xs-2 col-xs-offset-5">
						<input type="submit" class="btn btn-primary" value="Registrar">
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