<!-- carrusel de imagenes -->
	<div id="mySlider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			
		</ol>
		<div class="carousel-inner" role="listbox">
			<?php $cont = 0; foreach($slides->result() as $s){ ?>
				<?php if($cont==0){ ?>
				<div class="item active">
				<?php } else { ?>
				<div class="item">
				<?php } ?>
					<img src="<?=base_url()?>uploads/<?=$s->notice_picture?>" alt="noticia" />
					<!--<div class="carousel-caption">
			        	<img src="<?=base_url()?>uploads/<?=$s->notice_picture?>" alt="noticia" />
			     	</div>-->

				</div>	
			<?php $cont++; } ?>		
		</div>
		 <!-- Controls -->
	    <a class="left carousel-control" href="#mySlider" role="button" data-slide="prev">
	    	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    	<span class="sr-only">Previous</span>
	    </a>
	    <a class="right carousel-control" href="#mySlider" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
	    </a>
		
	</div>
	<!-- Carrusel de imagenes -->
	<div class="container container-notices" >
		<div class="row">
			<div class="col-md-9">
				<div class="col-md-12 divNews">
					<h1>NOTICIAS</h1>
					<?php if($notices->num_rows() > 0){ ?>
					<?php foreach($notices->result() as $nw){ ?>
					<div class="col-sm-4 divElement divNotices">
						<div class="col-sm-12">
							<a href="<?=base_url()?>avisos/<?=$nw->id_notice?>">

								<figure>
									<img src="<?=base_url()?>uploads/<?=$nw->notice_picture?>" alt="noticia">
								</figure>
								<p>
									<?=$nw->notice_title?>
								</p>
							</a>
						</div>
					</div>
					<?php }} else{  ?>
					<p>No hay elementos que mostrar</p>
					<?php } ?>
				</div>
				<div class="col-md-12 divNews">
					<h2>EVENTOS</h2>
					<?php if($events->num_rows() > 0){ ?>
					<?php foreach($events->result() as $ev){ ?>
					<div class="col-sm-4 divElement divEvents">
						<div class="col-sm-12">
							<a href="<?=base_url()?>avisos/<?=$ev->id_notice?>">
								<figure>
									<img src="<?=base_url()?>uploads/<?=$ev->notice_picture?>" alt="noticia">
								</figure>
								<p>
									<?=$ev->notice_title?>
								</p>
							</a>
						</div>
					</div>
					<?php }} else{  ?>
					<p>No hay elementos que mostrar</p>
					<?php } ?>
				</div>
			</div>	
			<div class="col-md-3">
				<div class="col-xs-12 divAviso">
					<h3>AVISOS</h3>
					<?php if($avisos->num_rows() > 0){ ?>
						<?php foreach($avisos->result() as $av){ ?>
						<div class="col-xs-12 divElement divNotices">
							<div class="col-sm-12">
								<a href="<?=base_url()?>avisos/<?=$av->id_notice?>">
									<figure>
										<img src="<?=base_url()?>uploads/<?=$av->notice_picture?>" alt="noticia">
									</figure>
									<p>
										<?=$av->notice_title?>
									</p>
								</a>
							</div>
						</div>
						<?php }} else{  ?>
						<p>No hay elementos que mostrar</p>
						<?php } ?>
				</div>
			</div>
		</div>
	</div> <hr>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-5 col-xs-offset-4 divSlogan">
					<figure>
						<img src="<?=base_url()?>img/logo.png" alt="">
					</figure>
					<p>
						Preparando a las mentes del mañana
					</p>
				</div>
			</div>
		</div>
	</div>