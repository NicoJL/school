<div class="container divContacto">
		<div class="row">
			<div class="col-sm-6">
				<h3>Ponte en contácto con nosotros</h3>
				<form action="<?=base_url()?>contacto/sendMail" method="post">
					<div class="form-group">
						<label for="txtname">Nombre</label>
						<input class="form-control" name="txtname" type="text" placeholder="Nombre completo"  required />
					</div>
					<div class="form-group">
						<label for="txtemail">Correo eléctronico</label>
						<input class="form-control" name="txtemail" type="email" placeholder="correo elćtronico para contácto" required  />
					</div>
					<div class="form-group">
						<label for="txtAsunto">Asunto</label>
						<input type="text" class="form-control" name="txtAsunto" placeholder="título del mensaje" required />
					</div>
					<div class="form-group">
						<label for="txtMensaje">Mensaje</label>
						<textarea class="form-control" name="txtMensaje" id="txtMensaje" cols="30" rows="10" placehoder="Mensaje" required></textarea>
					</div>
					<div class="form-group pull-right">
						<button class="btn btn-primary">Enviar</button>
					</div>
				</form>
			</div>
			<div class="col-sm-6 hidden-xs">
				<img src="<?=base_url()?>img/icono-mail.png" alt="" height="500px" width="500px">
			</div>
		</div>
	</div>