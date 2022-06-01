<div id="page-wrapper">
	<div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-body">
						<div class="pull-right">
							<p class="text-right text-uppercase text-muted text-xs margin-none">&nbsp;</p>
							<div id="bglogo"></div>
						</div>
						<h5 class="text-uppercase margin-none"><i class="fa fa-file-text-o"></i> <?php echo "<?php echo (\$model->isNewRecord)?'Nuevo Registro':'Editar Registro';"; ?>
						<!--<p class="text-muted text-xs margin-none">Formulario captura de datos.</p>-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.social-block -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				
				<?php /*
				<div class="panel-heading">
				
					<div class="pull-right">
						<div class="btn-group">
							<button type="button" class="btn btn-default panel-collapse">
								<i class="fa fa-caret-up"></i>
							</button>
						</div>
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-cog"></i>
							</button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><a href="#">Opcion 1</a></li>
								<li><a href="#">Opcion 2</a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="fa fa-refresh"></i> Actualizar</a></li>
							</ul>
						</div>
					</div>
										
					<h4 class="margin-none">
						<i class="fa fa-table fa-fw"></i> Lista de Registros 
					</h4>
					<p class="margin-none text-xs text-muted">Descripcion del contenido</p> 
					
				</div>
				<!-- /.panel-heading -->
				*/ ?>
				
				<div class="panel-body">
				
				<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
					'id'=>'".$this->class2id($this->modelClass)."-form',
					'enableAjaxValidation'=>false,
					'htmlOptions'=>array(
							'role'=>'form',
							//'onsubmit'=>'return false',
					),
					)); ?>\n"; ?>

					<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

					<div class="col-lg-12">
					
<?php
foreach($this->tableSchema->columns as $column){
	if($column->autoIncrement)
		continue;
	
		if($column->name!="log" && $column->name!="fechahora"){
?>
						<div class="form-group">
							<label>
							<?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?>
							</label>
							
					<?php if(stripos($column->dbType,'tinyint')!==false){ //Si es un valor Boolean Si/No?> 
							<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
							<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
					<?php }else{ ?>
							<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
							<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
					<?php } //end if ?>
					
						</div>

<?php 
	} //end if
} //end for
?>
					</div>
					<div class="col-lg-12">
						<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-default btn-primary','style'=>'')); ?>"; ?>
						<?php echo "<?php echo CHtml::link('Cancelar', array('admin'), array('class'=>'btn btn-default')); ?>"; ?>
					</div>

					<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
			
				</div><!-- panel body -->
			</div><!-- panel -->
		</div><!-- col-lg-12 -->
	</div><!-- row -->
</div><!-- page -->

<script type="text/javascript">
	$(document).ready(function(){	  
	  $("#<?php echo $this->class2id($this->modelClass) ?>-form").validationEngine({
					prettySelect : true,
					useSuffix: "_chzn",
				});
	});  
</script>