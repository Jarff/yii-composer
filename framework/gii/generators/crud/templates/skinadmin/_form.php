<p class="message icon-speech anthracite-gradient small-margin-bottom">
	<a class="close" title="Hide message" href="#">X</a>
	<span class="big-stripes animated"></span>
	Los Campos marcados con <span class="required">*</span> son requeridos.
</p>

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
		'id'=>'".$this->class2id($this->modelClass)."-form',
		'enableAjaxValidation'=>false,
		'htmlOptions' => array(\"class\" => \"block margin-bottom wizard same-height wizard-enabled\"),
	)); ?>\n"; ?>

	<?php echo "<?php // echo \$form->errorSummary(\$model); ?>\n"; ?>
	
		<h4 class="block-title">Datos Generales</h4>		
		<div class="wizard-steps" style="height:5px">&nbsp;</div>		
		<fieldset class="wizard-fieldset fields-list  current active">
	
			<legend class="legend">Legend</legend>	
			
		<?php
		foreach($this->tableSchema->columns as $column)
		{
			if($column->autoIncrement)
				continue;
		?>
			<?php if($column->name!="log" && $column->name!="fechahora") { echo "\n"; ?>
			<div class="field-block button-height">	
				<?php echo "<?php echo ".$this->generateActiveLabelSkinAdmin($this->modelClass,$column)."; ?>\n"; ?>
				<!--small>Descripcion corta</small-->
			<?php if(stripos($column->dbType,'tinyint')!==false || stripos($column->dbType,'smallint')!==false ){ //Si es un valor Boolean Si/No?> 					
				<?php echo "<?php echo ".$this->generateActiveFieldSkinAdmin($this->modelClass,$column)."; ?>\n"; ?>
				
				<!--span class="info-spot">
					<span class="icon-info-round"></span>
					<span class="info-bubble"> Informaci&oacute;n para el usuario.</span-->		
				<?php echo "<?php echo \$form->error(\$model,'{$column->name}',array(\"class\"=>\"message icon-speech red-gradient jk-arrow-top\")); ?>"; ?>				
			<?php }elseif(stripos($column->dbType,'text')!==false || stripos($column->dbType,'smallint')!==false ){ //Si es un valor Boolean Si/No?> 					
				<?php echo "<?php echo ".$this->generateActiveFieldSkinAdmin($this->modelClass,$column)."; ?>\n"; ?>
												
				<!--span class="info-spot">
					<span class="icon-info-round"></span>
					<span class="info-bubble"> Informaci&oacute;n para el usuario.</span>						
				</span-->								
				<?php echo "<?php echo \$form->error(\$model,'{$column->name}',array(\"class\"=>\"message icon-speech red-gradient jk-arrow-top\")); ?>"; ?>				
			<?php }else{  ?>
		<span class="input">
				<?php echo "<?php echo ".$this->generateActiveFieldSkinAdmin($this->modelClass,$column)."; ?>\n"; ?>
				<?php echo "<?php echo \$form->error(\$model,'{$column->name}',array(\"class\"=>\"message icon-speech red-gradient jk-arrow-top\")); ?>"; ?>								
					<!--span class="info-spot">
						<span class="icon-info-round"></span>
						<span class="info-bubble"> Informaci&oacute;n para el usuario.</span>						
					</span-->	
				</span><?php } ?>												
			</div>
		<?php } ?>
		<?php } ?>		

		<div class="field-block button-height">
			<button class="button glossy mid-margin-right" type="submit">
				<span class="button-icon"><span class="icon-tick"></span></span>
				<?php echo "<?php echo \$model->isNewRecord ? \"Crear\" : \"Guardar\" ?>" ?>
			</button>			
			<a 	href="<?php echo "<?php echo \$this->createUrl('admin')?>"?>" 
				class="button glossy mid-margin-right ">						
				<span class="button-icon red-gradient">
					<span class="icon-cross-round"></span>
				</span>
				Cancelar</a>			
		</div>		
				
	</fieldset>
	
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>				