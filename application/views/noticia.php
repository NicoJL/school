<div class="container containerNotices">
	<div class="row">
		<div class="col-xs-12">
			<?php foreach($noticia->result() as $row){ ?>
			<h1><?=$row->notice_title?></h1>
			<figure>
				<img src="<?=base_url()?>uploads/<?=$row->notice_picture?>" alt="noticia">
			</figure>
			<p>
				<?=$row->notice_content?>
			</p>
			<p>
				<cite>Publicado por <?=$row->teacher_name?> </cite>
			</p>
			<?php } ?>
		</div>
	</div>
</div>