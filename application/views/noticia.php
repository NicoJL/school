<div class="container containerNotices">
	<div class="row">
		<div class="col-xs-12">
			<?php foreach($noticia->result() as $row){ ?>
			<h1><?=$row->notice_title?></h1>
			<figure>
				<img src="" alt="">
			</figure>
			<p>
				<?=$row->notice_content?>
			</p>
			<p>
				Publicado por
			</p>
			<?php } ?>
		</div>
	</div>
</div>