<div class="container container-actions">
	<div class="row">
		<div class="col-sm-6 col-xs-offset-3">
			<p class="title" style="text-align:center;font-weight:bold;">AGREGAR GRUPOS</p>
			<form action="<?=base_url()?>members/panel/addGroup" method="post">
				<div class="form-group">
					<label for="lstGrade">Grado</label>
					<select name="lstGrade" id="lstGrade" class="form-control">
						<?php foreach ($grades->result() as $g) { ?>
							<option value="<?=$g->id_grade?>"><?=$g->grade_name?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="lstTeacher">Maestro</label>
					<select name="lstTeacher" id="lstTeacher" class="form-control">
						<?php foreach ($teachers->result() as $t) { ?>
							<option value="<?=$t->id_teacher?>"><?=$t->teacher_name?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="lstNameGroup">Grupo</label>
					<select name="lstNameGroup" id="lstNameGroup"class="form-control">
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
						<option value="D">D</option>
						<option value="E">E</option>
						<option value="F">E</option>
					</select>
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