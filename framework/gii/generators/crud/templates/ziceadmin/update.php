<!-- Widget -->
<div class="widget  span12 clearfix">

	<div class="widget-header">
		<span>
			<i class="icon-file"></i>
			Editar <?php echo $this->modelClass." Folio 00<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?>
		</span>
	</div><!-- End widget-header -->	
	
	<div class="widget-content">
		
		<?php echo"<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>" ?>
		
	</div>
	
</div>