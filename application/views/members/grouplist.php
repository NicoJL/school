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
			<p><strong>MAESTRO: </strong><?=' '.$dg->teacher_name?></p>
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
								APELLIDO PATERNO
							</th>
							<th>
								APELLIDO MATERNO
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
								DAR DE BAJA
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
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div>
	<input type="hidden" id="ruta" value='<?=base_url()?>members/panel/updateStatusStudent'>
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