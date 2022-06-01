<hgroup id="main-title" class="thin">
	<h1>Tipos de <?php echo $this->class2name($this->modelClass); ?></h1>
	<!--h2>Mes<strong>Dia</strong></h2-->
</hgroup>

<div class="with-padding">

	<!--p class="wrapped left-icon icon-info-round">
		Algun aviso en espec&iacute;fico para el usuario
	</p-->

	<!--h4>Subtitulo</h4-->

	<!--p>Descripci&oacuten para el uso de la tabla</p-->
	<p class="button-height">	
		<a class="button" href="<?php echo "<?php echo \$this->createUrl('create')?>";?>">
			<span class="button-icon" ><span class="icon-star"></span></span> Nuevo
		</a>
	</p>
	

	<table class="table responsive-table sorting-advanced" id="table_catalogo_prestamos">
		<thead>
			<tr><?php
				$count=0;
				foreach($this->tableSchema->columns as $column)
				{
					if($count>=4)break;
										
					echo "\n\t\t\t\t<th scope=\"col\" class=\"align-center hide-on-tablet hide-on-mobile hide-on-mobile-portrait\" ><?php echo ".$this->modelClass."::model()->getAttributeLabel('".$column->name."') ?></th>";
											
					++$count;
				}
				echo "\n";						
			?>
				<th scope="col" width="10%" class="align-center ">Activo</th>
				<th scope="col" width="10%" class="align-center ">Opciones</th>
			</tr>
		</thead>

		<tbody>

			<?php echo "<?php foreach(\$model as \$row){?>\n" ?>
			<tr><?php
				$count=0;
				foreach($this->tableSchema->columns as $column)
				{
					if($count>=4)break;
					
					echo "\n\t\t\t\t<td><?php echo \$row->".$column->name." ?></td>";
											
					++$count;
				}
				echo "\n";
			?>									
				<td  class="low-padding align-center">
					<?php echo "<?php echo CHtml::checkBox('activo', \$row->activo, 
										array(
												\"nombre\"=>\"Nombre \",
												\"class\"=>\"switch medium green-active mid-margin-right cambiarActivo\",
												\"url\"=>\$this->createUrl('activo',array('id'=>\$row->".$this->tableSchema->primaryKey.")),
												\"data-text-on\"=>\"SI\",
												\"data-text-off\"=>\"NO\"
											))?>\n" ?>
				</td>
				<td  class="low-padding align-center">
					<span class="button-group compact">
						<a 	href="<?php echo "<?php echo \$this->createUrl('update',array('id'=>\$row->".$this->tableSchema->primaryKey."))?>"?>" 
							class="button compact icon-pencil  with-tooltip "
							title="Editar" 
							></a>						
						<a 	url="<?php echo "<?php echo \$this->createUrl('delete',array('id'=>\$row->".$this->tableSchema->primaryKey."))?>"?>"
							href="javascript:void(0)"
							class="button compact icon-trash eliminarRegistro with-tooltip confirm"
							name="<?php echo "<?php echo \"Name\" ?>" ?>"
							title="Borrar"
							></a>		
					</span>
				</td>				
			</tr>
			<?php echo"<?php } // end for ?>\n" ?>
		</tbody>

	</table>
</div>
<!--end with-padding-->
