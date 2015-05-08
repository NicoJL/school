
<div class="container divTeachers">
	<div class="row">
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="tblTechers">
					<caption><strong>ALUMNOS INACTIVOS</strong></caption>
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
								HABILITAR
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
								<td class="tdStudent">
									<span><?=$ls->student_user?></span>
								</td>
								<td class="tdStatus" style="text-align:center;">
									<?php if($ls->student_status){ ?>
										<span class="glyphicon glyphicon-ok ok" aria-hidden="true"></span>
									<?php } else { ?>
										<span class="glyphicon glyphicon-remove not" aria-hidden="true"></span>
									<?php } ?>	
								</td>
								<td class="tdButton"><button class="btn btn-info btn-xs btnAllow" data-identificador="<?=$ls->id_student?>"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button></td>
								
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div>
	<input type="hidden" id="ruta" value='<?=base_url()?>members/panel/allowStudent'>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Activación de Alumnos</h4>
      </div>
      <div class="modal-body">
        <span class="not">¿Realmente deseas activar a este alumno?</span>
        <p id="pUser" class="not"></p>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" class="btnConfirmAllow btn btn-warning" id="btnConfirmAllow">Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->

