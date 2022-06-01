<!-- Table widget -->
<div class="widget  span12 clearfix">

    <div class="widget-header">
        <span>
        	<i class="icon-file"></i>
			<?php /*Administrador de <?php echo $this->pluralize($this->class2name($this->modelClass)); ?>*/ ?>Lista de <?php echo $this->class2name($this->modelClass); ?>        	
        </span>
    </div><!-- End widget-header -->	
    
    
    <div class="widget-content">
    	
    	
    <a class="uibutton icon add normal" href="<?php echo "<?php echo \$this->createUrl('create')?>";?>" id="nuevo" >Nuevo</a>         
                      
                      <table class="table table-bordered table-striped data_table3 "  id="data_table3">
                        <thead align="center">
                          <tr>
                            <?php
								$count=0;
								foreach($this->tableSchema->columns as $column)
								{
									if($count>=4)break;
									
									echo "\t\t\t\t<th><?php echo ".$this->modelClass."::model()->getAttributeLabel('".$column->name."') ?></th>\n";
															
									++$count;
								}
														
							?>			  
							<th >Activo</th>
							<th >Opciones</th>
                          </tr>
                        </thead>
                        <tbody align="center">
			<?php echo "\t\t\t<?php foreach(\$model as \$row){\t?>" ?>
		
			  <tr>
				<?php
					$count=0;
					foreach($this->tableSchema->columns as $column)
					{
						if($count>=4)break;
						
						echo "\t\t\t\t<td><?php echo \$row->".$column->name." ?></td>\n";
												
						++$count;
					}
				?>		
				<td >
					<span 	class="checkslide cambiarActivo" 
							name=""
							url=" <?php echo "<?php echo \$this->createUrl('activo',array('id'=>\$row->".$this->tableSchema->primaryKey.")) ?>"?>">				
							<?php echo "<?php echo CHtml::checkBox('activo', \$row->activo, array())?>\n" ?>
						<label data-on="SI" data-off="NO"></label>
					</span>
				</td>
				<td >
				  <span class="tip" >
					  <a href="<?php echo "<?php echo \$this->createUrl('update',array('id'=>\$row->".$this->tableSchema->primaryKey."))?>"?>" title="Editar">
						  <img src="<?php echo "<?php echo Yii::app()->theme->baseUrl ?>"?>/images/icon/icon_edit.png" />
					  </a>
				  </span> 
					<span class="tip" >
						<a 	url="<?php echo "<?php echo \$this->createUrl('delete',array('id'=>\$row->".$this->tableSchema->primaryKey."))?>"?>" 
							class="eliminarRegistro"  
							name="<?php echo "<?php echo \"Name\" ?>" ?>" 
							title="Eliminar"  >
							<img src="<?php echo "<?php echo Yii::app()->theme->baseUrl ?>"?>/images/icon/icon_delete.png" />
						</a>
					</span>					  
				</td>
			  </tr>
	
			<?php echo"<?php } // end for ?>" ?>             
                        </tbody>
                      </table>
                  
          <div class="clearfix"></div>
  
                </div><!--  end widget-content -->
</div><!-- widget  span12 clearfix-->