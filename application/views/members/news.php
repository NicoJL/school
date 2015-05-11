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
								CONTENIDO
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
							<td><p><?=substr($nw->notice_content, 0,50)?></p></td>
							<td class="tdImagen"><img src="<?=base_url()?>uploads/<?=$nw->notice_picture?>" alt="" /></td>
							<td><?=$nw->teacher_name?></td>
							<td class="tdButton"><button class="btn btn-primary btn-xs btnEdit" data-idteacher="<?=$nw->id_notice?>" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button></td>
							<td class="tdButton"><button class="btn btn-danger btn-xs btnDelete" data-identificador="<?=$nw->id_notice?>"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button></td>
						</tr>
					<? } ?>
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>