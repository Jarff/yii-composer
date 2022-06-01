<script type="text/javascript">
	$(document).ready(function(){	  
	  $("#<?php echo $this->class2id($this->modelClass) ?>-form").validationEngine({
					prettySelect : true,
					useSuffix: "_chzn",
				});
	});  
</script>

<!-- title box -->
<div class="boxtitle">
	<i class="icon-hdd"></i>Los Campos marcados con <span class="required">*</span> son requeridos.
</div>

<div class="form">

	<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
		'id'=>'".$this->class2id($this->modelClass)."-form',
		'enableAjaxValidation'=>false,
	)); ?>\n"; ?>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<?php if($column->name!="log" && $column->name!="fechahora") { ?>
		<div class="section" >
			<label>
			<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
			<!--small>Descripcion corta</small-->
			</label>
<?php if(stripos($column->dbType,'tinyint')!==false){ //Si es un valor Boolean Si/No?> 
			<div>
				<span class="checkslide">
					<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
					<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
					<label data-on="SI" data-off="NO"></label>
				</span>
				<!--span class="f_help">Texto de Ayuda</span-->
			</div>			
			<?php }else{ ?>
			<div>
				<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
				<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
				<!--span class="f_help">Texto de Ayuda</span-->				
			</div>
			<?php } ?>
</div>

<?php } ?>
<?php
}
?>
	<div class="section last">
		<div>
			<ul class="uibutton-group">
				<li><?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'uibutton loading','style'=>'height:31px;')); ?>"; ?></li>
				<li><?php echo "<?php echo CHtml::link('Regresar',array('admin'),array('class'=>'uibutton special')); ?>"; ?></li>
			</ul>			
		</div>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->