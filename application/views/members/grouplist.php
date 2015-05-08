<div class="container">
	<div class="row">
		<div class="col-xs-4">
			<form action="<?=base_url()?>members/panel/getGroups" method="post" id="frmGroups">
				<label for="lstGroup">Elige el grupo</label>
				<select name="lstGroup" id="lstGroup" class="form-control">
					<option value="">--------</option>
					<?php foreach($groups->result() as $g){ ?>
						<option value="<?=$g->id_group?>"><?=$g->id_grade.' '.$g->group_name?></option>
					<?php } ?>	
				</select>
			</form>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-10">
			<?php  foreach($listgroups->result() as $dg){ ?>
			<p class="title"><strong>GRUPO <?=$dg->id_grade.' '.$dg->group_name?></strong></p>
			<p class="pTeacher"><strong>MAESTRO: </strong><?=' '.$dg->teacher_name?></p>
			<button class="btn btn-sm btn-warning" id="btnChangeTeacher">Cambiar maestro</button>
			<button class="btn btn-sm btn-primary" id="btnChangePass">Cambiar contraseña</button>
			<button class="btn btn-sm btn-success" id="btnFile">Subir archivo</button>
			<span id="spnPass" class="ok"></span>
			<input type="hidden" id="txtIdGroupT" value="<?=$dg->id_group?>">
			<span class="loader"></span>
			<?php } ?>
			
		</div>
	</div>
</div>
<div class="container divTeachers">
	<div class="row">
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="tblTechers">
					<caption><strong>ALUMNOS</strong></caption>
					<thead>
						<tr>
							<th>
								NOMBRE
							</th>
							<th>
								APELLIDO P
							</th>
							<th>
								APELLIDO M
							</th>
							<th>
								USUARIO
							</th>
							<th style="text-align:center;">
								ESTATUS
							</th>
							<th style="text-align:center;">
								EDITAR
							</th>
							<th style="text-align:center;">
								BAJA
							</th>
							<th style="text-align:center;">
								CAMBIAR GRUPO
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($liststudents->result() as $ls) { ?>
							<tr>
								<td>
									<?=$ls->student_name?>
								</td>
								<td>
									<?=$ls->student_last_name?>
								</td>
								<td>
									<?=$ls->student_second_last_name?>
								</td>
								<td>
									<?=$ls->student_user?>
								</td>
								<td class="tdStatus" style="text-align:center;">
									<?php if($ls->student_status){ ?>
										<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>
									<?php } else { ?>
										<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>
									<?php } ?>	
								</td>
								<td class="tdButton"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
								<td class="tdButton"><button class="btn btn-danger btn-xs btnDelete" data-identificador="<?=$ls->id_student?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button></td>
								<td class="tdButton"><button class="btn btn-warning btn-xs btnChangeG" data-ide="<?=$ls->id_student?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><hr>
<div class="container divFiles">
	<button class="btn btn-md btn-primary" id="btnShowFiles">Ver archivos</button>
	<div class="row">
		<div class="col-xs-10 divContainerFiles" id="divContainerFiles">
			<?php foreach($files->result() as $f){?>
				<a href="<?=base_url()?>uploads/<?=$f->file_name?>" target="_blank" title="visualizar/descargar archivo"><?=$f->file_name?></a>
				<p style="font-size:10px;">Subido el <?=$f->group_file_date?></p>
			<?php } ?>
		</div>
	</div>
</div>
<div>
	<input type="hidden" id="ruta" value='<?=base_url()?>members/panel/updateStatusStudent'>
	<input type="hidden" id="rutaChangeG" value='<?=base_url()?>members/panel/changeGroup'>
	<input type="hidden" id="rutaChangeT" value='<?=base_url()?>members/panel/changeTeacher'>
	<input type="hidden" id="rutaChangePass" value='<?=base_url()?>members/panel/changePass'>
	<input type="hidden" id="rutaFile" value='<?=base_url()?>members/panel/upload'>
	<input type="hidden" id="rutaAddFile" value='<?=base_url()?>members/panel/addFile'>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Baja de Alumnos</h4>
      </div>
      <div class="modal-body">
        <span class="not">¿Realmente deseas dar de baja a este alumno?</span>
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

<!-- Modal change group-->
<div class="modal fade" id="modalChangeG" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambio de grupo</h4>
      </div>
      <div class="modal-body">
        <label for="lstChangeG">Elige el grupo</label>
		<select name="lstChangeG" id="lstChangeG" class="form-control">
			<option value="">--------</option>
			<?php 
				foreach($listgroups->result() as $dg){
					$idg = $dg->id_group;
				}
				foreach($groups->result() as $g){ 
					if($idg != $g->id_group ){ ?>
						<option value="<?=$g->id_group?>"><?=$g->id_grade.' '.$g->group_name?></option>
			<?php } } ?>	
		</select>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btn btn-primary btnAceptG" id="btnAceptG">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- Modal Change Teacher -->
<div class="modal fade" id="modalChangeTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambio de maestro</h4>
      </div>
      <div class="modal-body">
	      <select name="lstTeacher" id="lstTeacher" class="form-control">
	      	<option value="">----</option>
	       	<?php foreach($teachers->result() as $t){?>
	       		<option value="<?=$t->id_teacher?>"><?=$t->teacher_name?></option>
	       	<?php } ?>	
	      </select>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnChangeT btn btn-primary" id="btnChangeT">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- Modal -->
<div class="modal fade" id="modalChangePass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cambio de contraseña de acceso</h4>
      </div>
      <div class="modal-body">
        <form action="">
        	<div class="control-group">
        		<label for="txtNewPass">Contraseña nueva</label>
        		<input type="text" id="txtNewPass" name="txtNesPass" class="form-control" />
        	</div>
        </form>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnConfirmPass btn btn-primary" id="btnConfirmPass">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

<!-- Modal Files -->
<div class="modal fade" id="modalFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivo</h4>
      </div>
      <div class="modal-body">
      	<input type="file" id="inputFile" />
      	<p class="pLoader" id="pLoader"></p>
      	<input type="hidden" name="txtFile" id="txtFile" />
      	<div class="progress">
		  <div class="progress-bar" id="divProgress" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
		 
  		  </div>
		</div>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnConfirmFile btn btn-primary" id="btnConfirmFile">Agregar archivo</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->