<div class="container container-actions">
	<div class="row">
		<div class="col-sm-12">
			<p class="title" style="text-align:center;font-weight:bold;">EDITAR AVISO</p>
			<input type="hidden" id="rutaFile" value='<?=base_url()?>members/panel/upload'>
			<input type="hidden" id="txtJs" data-ruta="<?=base_url()?>js/groups.js" value="<?=base_url()?>js/groups.js" />
			<form action="<?=base_url()?>members/panel/editNew" method="post">
			<?php foreach($notice->result() as $n) { ?>
				<div class="form-group">
					<label for="slctCategory">Categoria</label>
					<select name="slctCategory" id="slctCategory" class="form-control" required>
						<?php foreach($categories->result() as $cat){?>
							<?php if($n->id_notice_category == $cat->id_notice_category){ ?>
							<option value="<?=$cat->id_notice_category?>" selected><?=$cat->notice_category_name?></option>
							<?php } else { ?>
							<option value="<?=$cat->id_notice_category?>"><?=$cat->notice_category_name?></option>
						<?php }} ?>
					</select>
				</div>
				<div class="form-group">
					<label for="txtTitle">Título</label>
					<input type="text" name="txtTitle" id="txtTitle" class="form-control" value="<?=$n->notice_title?>" required />
				</div>
				<div class="form-group">
					<label for="txtContent">Contenido</label>
					<textarea name="txtContent" id="txtContent" cols="50" rows="10" maxlength="970" class="form-control" required>
						<?=$n->notice_content?>
					</textarea>
				</div>
				<input type="hidden" name="txtFile" id="txtFile" value="<?=$n->notice_picture?>" />
				<input type="hidden" name="txtId" id="txtId" value="<?=$n->id_notice?>" />
				<div class="control-group">
					<input type="file" id="inputFile" class="form-control" />
				</div>
				<p class="pLoader" id="pLoader"></p>
		      	<div class="progress">
				  <div class="progress-bar" id="divProgress" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
				 
		  		  </div>
				</div>
				<div class="check-box">
					<?php if($n->notice_prominent){ ?>
					<label for="">
						<input type="radio" name="rdoPro" value="1" checked /> Noticia destacada
					</label>
					<label for="">
						<input type="radio" name="rdoPro" value="0" /> Noticia normal
					</label>
					<?php } else{ ?>
					<label for="">
						<input type="radio" name="rdoPro" value="1" /> Noticia destacada
					</label>
					<label for="">
						<input type="radio" name="rdoPro" value="0" checked="" /> Noticia normal
					</label>
					<?php } ?>

				</div>
				<div class="form-group">
					<div class="col-xs-2 col-xs-offset-7 col-sm-offset-9">
						<input type="submit" class="btn btn-warning" value="Modificar">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<?=validation_errors()?>
						<?=$msj?>
					</div>
				</div>
			<?php } ?>	
			</form>
		</div>
	</div>
</div>