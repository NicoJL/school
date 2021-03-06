<div class="container divTeachers">
	<div class="row">
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="tblTechers">
					<caption><strong>LISTA DE MAESTROS</strong></caption>
					<thead>
						<tr>
							<th>
								NOMBRE
							</th>
							<th>
								USUARIO
							</th>
							<th>
								CONTRASEÑA
							</th>
							<th>
								TIPO
							</th>
							<th>
								ESTATUS
							</th>
							<th style="text-align:center;">
								EDITAR
							</th>
							<th style="text-align:center;">
								DESACTIVAR
							</th>
							<th style="text-align:center;">
								ACTIVAR
							</th>
						</tr>
					</thead>
					<tbody id="tblTeachers">
						<?php foreach($teachers->result() as $t){ ?>
						<tr>
							<td><?=$t->teacher_name?></td>
							<td><?=$t->teacher_nick_name?></td>
							<td><?=$t->teacher_password?></td>
							<td style="text-align:center;"><span class="spntype"><?=$t->id_type?></span></td>
							<td class="tdStatus" style="text-align:center;">
								<?php if($t->teacher_status){ ?>
									<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>
									<span class="loading"></span>
								<?php } else { ?>
									<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>
									<span class="loading"></span>
								<?php } ?>	
							</td>
							<td class="tdButton"><button class="btn btn-primary btn-xs btnEdit" data-idteacher="<?=$t->id_teacher?>" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
							<td class="tdButton"><button class="btn btn-danger btn-xs btnDelete" data-identificador="<?=$t->id_teacher?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button></td>
							<?php if($t->teacher_status){ ?>
									<td class="tdButton"><button class="btn btn-warning btn-xs btnAllow" disabled><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button></td>
								<?php } else { ?>
									<td class="tdButton"><button class="btn btn-warning btn-xs btnAllow" data-idacive="<?=$t->id_teacher?>"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button></td>
								<?php } ?>	

						</tr>	
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div>
	<input type="hidden" id="ruta" value='<?=base_url()?>members/panel/updateStatus' />
	<input type="hidden" id="rutaEdit" value='<?=base_url()?>members/panel/editTeacher' />
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Baja de Maestros</h4>
      </div>
      <div class="modal-body">
        <span class="not">¿Realmente deseas dar de baja a este maestro?</span>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnConfirmDelete btn btn-danger">Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar datos</h4>
      </div>
      <div class="modal-body">
      	<form action="" id="frmEditTeacher" method="post">
      		<div class="form-group">
      			<label for="txtNameT">Nombre</label>
      			<input type="text" name="teacher_name" id="txtNameT" class="form-control" />
      		</div>
      		<div class="form-group">
      			<label for="txtUser">Usuario</label>
      			<input type="text" name="teacher_nick_name" id="txtUser" class="form-control" />
      		</div>
      		<div class="form-group">
      			<label for="txtPass">Contraseña</label>
      			<input type="password" name="teacher_password" id="txtPass" class="form-control" />
      			<input type="hidden" name="id_teacher" id="txtIdTeacher" />
      		</div>
      		<div class="form-group">
				<label for="lstTipos">Tipo</label>
				<select name="id_type" id="lstTipos" class="form-control">
					<?php foreach ($types->result() as $t) { ?>
						<option value="<?=$t->id_type?>"><?=$t->type_name?></option>
					<?php } ?>
				</select>
			</div>
      	</form>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnConfirmEdit btn btn-primary">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->