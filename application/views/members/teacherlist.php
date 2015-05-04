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
								ESTATUS
							</th>
							<th style="text-align:center;">
								EDITAR DATOS
							</th>
							<th style="text-align:center;">
								DAR DE BAJA
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($teachers->result() as $t){ ?>
						<tr>
							<td><?=$t->teacher_name?></td>
							<td><?=$t->teacher_nick_name?></td>
							<td><?=$t->teacher_password?></td>
							<td class="tdStatus" style="text-align:center;">
								<?php if($t->teacher_status){ ?>
									<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>
								<?php } else { ?>
									<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>
								<?php } ?>	
							</td>
							<td class="tdButton"><button class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
							<td class="tdButton"><button class="btn btn-danger btn-xs btnDelete" data-identificador="<?=$t->id_teacher?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button></td>
						</tr>	
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div>
	<input type="hidden" id="ruta" value='<?=base_url()?>members/panel/updateStatus'>
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