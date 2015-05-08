hola

<?php foreach($news->result() as $nw){ ?>

	<div>
		<p style="text-align:justify;"><?=$nw->notice_content?></p>
	</div>

<? } ?>