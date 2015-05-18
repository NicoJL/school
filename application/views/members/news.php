<div class="container">
	<div class="row">
		<div class="col-xs-10">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="tblTechers">
					<caption>LISTA DE NOTICIAS</caption>
					<thead>
						<tr>
							<th>
								TÍTULO
							</th>
							<th>
								IMAGEN
							</th>
							<th>
								AUTOR
							</th>
							<th>
								EDITAR
							</th>
							<th>
								ELIMINAR
							</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($news->result() as $nw){ ?>
						<tr class="trNews">
							<td><?=$nw->notice_title?></td>
							<td class="tdImagen"><img src="<?=base_url()?>uploads/<?=$nw->notice_picture?>" alt="" /></td>
							<td><?=$nw->teacher_name?></td>
							<td class="tdButton"><a href="<?=base_url()?>members/panel/editNew/<?=$nw->id_notice?>"><button class="btn btn-primary btn-xs btnEdit" data-identificator="<?=$nw->id_notice?>" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></a></td>
							<td class="tdButton"><button class="btn btn-danger btn-xs btnDelete" data-identificador="<?=$nw->id_notice?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button></td>
						</tr>
					<? } ?>
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="rutaDel" value='<?=base_url()?>members/panel/deleteNew' />
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Baja de Noticias</h4>
      </div>
      <div class="modal-body">
        <span class="not">¿Realmente deseas dar de baja a esta noticia?</span>
      </div>
      <div class="modal-footer">
      	<span class="loader"></span>
        <button type="button" id="btnConfirmDel" class="btnConfirmDelete btn btn-danger">Si</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal -->