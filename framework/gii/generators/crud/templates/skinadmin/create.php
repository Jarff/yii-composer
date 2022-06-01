<hgroup id="main-title" class="thin">
	<h1>Nuevo <?php echo $this->modelClass; ?></h1>
	<!--h2>Mes<strong>Dia</strong></h2-->
</hgroup>

<div class="with-padding">

	<!--p class="wrapped left-icon icon-info-round">
		Algun aviso en espec&iacute;fico para el usuario
	</p-->

	<!--h4>Subtitulo</h4-->

	<!--p>Descripci&oacuten para el uso de la tabla</p-->
	
	<?php echo"<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>\n" ?>
	
</div><!--end with-padding-->	