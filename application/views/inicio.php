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
	<div class="container container-notices">
		<div class="row">
				<div class="col-md-8">
					<div class="col-xs-12">
						<h1>NOTICIAS</h1>
					</div>
					<div class="col-xs-12">
						<h2>EVENTOS</h2>
					</div>
				</div>
				<div class="col-md-4" style="text-align:center;">
					<h3>AVISOS</h3>
				</div>
		</div>
	</div>