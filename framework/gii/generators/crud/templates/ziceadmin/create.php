<!-- Widget -->
<div class="widget  span12 clearfix">

	<div class="widget-header">
		<span>
			<i class="icon-file"></i>
			Nuevo <?php echo $this->modelClass; ?>			
		</span>
	</div><!-- End widget-header -->	
	
	<div class="widget-content">

		<?php echo"<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>" ?>
		
	</div>
	
</div>