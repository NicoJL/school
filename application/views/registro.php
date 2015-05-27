<div class="container divLogin">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4 login">
			<form action="<?=base_url()?>alumnos/registro" method="post">
				<div class="form-group">
					<label for="lstGroup">Grupo</label>
					<select name="lstGroup" id="lstGroup" class="form-control">
						<option value="">--------</option>
						<?php foreach($groups->result() as $g){ ?>
							<option value="<?=$g->id_group?>"><?=$g->id_grade.' '.$g->group_name?></option>
						<?php } ?>	
					</select>
				</div>
				<div class="form-group">
					<label for="txtName">Nombre</label>
					<input type="text" name="student_name" id="txtName" class="form-control" required />
				</div>
				<div class="form-group">
					<label for="txtAp">Apellido Paterno</label>
					<input type="text" name="student_last_name" id="txtAp" class="form-control" required />
				</div>
				<div class="form-group">
					<label for="txtAm">Apellido Materno</label>
					<input type="text" name="student_second_last_name" id="txtAm" class="form-control" required />
				</div>
				<div class="form-group">
					<label for="txtUser">Usuario</label>
					<input type="text" name="student_user" id="txtUser" class="form-control" required />
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary pull-right" value="Registrar" />
				</div>
			</form>
			<div class="not">
				<?=validation_errors()?>
			</div>
			<span class="not"><?=$msj?></span>
		</div>
	</div>
</div>