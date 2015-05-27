<div class="container divCategoria">
	<div class="row">
		<div class="col-xs-12">
			<p class="title" style="text-align:center;">Resultados para la búsqueda <?=$cadena?></p>
			<?php if($notices->num_rows() > 0){ ?>
			<?php foreach($notices->result() as $row){ ?>
			<div class="col-xs-12 divParent">
				<a href="<?=base_url()?>avisos/<?=$row->id_notice?>">
					<div class="col-sm-3 divImage">
						<figure><img src="<?=base_url()?>uploads/<?=$row->notice_picture?>" alt="noticia" /></figure>
					</div>
					<div class="col-sm-2 divTitle">
						<p>
							<?=$row->notice_title?>
						</p>
					</div>
					
				</a>
			</div>
			<?php } } else { ?>
			<p style="text-align:center;">No hay datos que mostrar</p>
			<?php }?>
		</div>
	</div>
</div>