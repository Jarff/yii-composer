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
						<h5 class="text-uppercase margin-none"><i class="fa fa-list"></i> <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h5>
						<!--<p class="text-muted text-xs margin-none">Admnistración de <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></p>-->
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
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="myTable"></table>
					</div>
					<!-- /.table-responsive -->
					
					<?php /*
					<div class="well">
						<h4>Information Adicional</h4>
						<p>Descripcion del contenido adicional</a>
					</div>
					*/ ?>
					
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	/* var lista = [{
		"ID": 1,
		"NAME": "Opción 1"
	}, {
		"ID": 2,
		"NAME": "Opción 2"
	}, {
		"ID": 3,
		"NAME": "Opción 3"
	}]; */
	
	/* Table */	
	DevExpress.localization.locale(navigator.language || navigator.browserLanguage);
	
	var db = new DevExpress.data.CustomStore({
		key: '<?php echo $this->tableSchema->primaryKey?>',
        load: function(loadOptions){
            var deferred = $.Deferred(),
                args = {};
    
			if(loadOptions.filter){
               args.filter = JSON.stringify(loadOptions.filter);
            } //end if
	
			if(loadOptions.sort){
				args.sort = JSON.stringify(loadOptions.sort);
			} //end if

			args.count = 0;
            args.skip = loadOptions.skip || 0;
            args.take = loadOptions.take || 50;
			args.load = 1;
    
            $.ajax({
                url: '<?php echo "<?php echo \$this->createUrl('process')?>"; ?>',
				type:  'post',
                dataType: "json",
                data: args,
                success: function(result){
					deferred.resolve(result.items, { totalCount: result.totalCount });					
                },
                error: function() {
                    deferred.reject("Data Loading Error");
                },
                timeout: 500000
            });
    
            return deferred.promise();
        },
		update: function(key, values){
            var deferred = $.Deferred();
			values = JSON.stringify(values);
			
            $.ajax({
                url: '<?php echo "<?php echo \$this->createUrl('process')?>"; ?>',
                dataType: "json",
				type:  'post',
                data: { key: key, values: values, oper:'update' },
                success: function(result) {
                    deferred.resolve(result.items, { totalCount: result.totalCount });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                   deferred.reject("Data Loading Error");
                },
                timeout: 500000
            });
    
            return deferred.promise();
        },
		insert: function(values){
		   var deferred = $.Deferred();
		   values = JSON.stringify(values);
		   
           $.ajax({
               url: '<?php echo "<?php echo \$this->createUrl('process')?>"; ?>',
               type: 'POST',
               dataType: 'json',
               data: { values: values, oper:'add' },
               success: function (data) {
                   deferred.resolve(data);
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   deferred.reject("Data Loading Error");
               }
           });
           
		   return deferred.promise();
       },
       remove: function(key){
		   var deferred = $.Deferred();
		   
           $.ajax({
               url: '<?php echo "<?php echo \$this->createUrl('process')?>"; ?>',
               type: 'POST',
               dataType: 'json',
               data: { key: key, oper:'del' },
               success: function (data) {
                   deferred.resolve(data);
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   deferred.reject("Data Loading Error");
               }
           });
           
		   return deferred.promise();
       },
    });	
	
	var customSelection = false;
	var winheight = $("#page-wrapper").height() - 100;
	
	$("#myTable").dxDataGrid({
		dataSource: { 
			store: db
		},
		columnHidingEnabled: false,
		allowColumnResizing: true,
		columnResizingMode: "nextColumn",
		columnMinWidth: 50,
		columnAutoWidth: true,		
		showColumnLines: true,
		showRowLines: true,
		rowAlternationEnabled: true,
		showBorders: true,		
		height: winheight, //altura de tabla
		width: "100%", //ancho de tabla
		selection: {
			mode: "simple", //single, multiple
			showCheckBoxesMode: "always",
			allowSelectAll: false
		},
		stateStoring: {
			enabled: false,
			type: "localStorage",
			storageKey: "storage"
		},
		"export": {
			enabled: false,
			fileName: "Secciones",
			allowExportSelectedData: false
		},		
		paging: {
			enabled: true,
			pageSize: 50
		},
		pager: {
			showPageSizeSelector: true,
			allowedPageSizes: [50, 100, 500, 1000],
			showInfo: true
		},
		searchPanel: {
			visible: true
		},
		editing: {
			mode: "batch",
			allowAdding: true,
			allowUpdating: true,
			allowDeleting: true,
			method: "POST",
		},
		columns: [
		<?php echo "\t\t\t<?php foreach(\$model as \$row){\t?>" ?>
		<?php
			$count=0;
			foreach($this->tableSchema->columns as $column){
				if($count== 1){
					echo '\t\t\t\t{ "caption":"<?php echo '.$this->modelClass.'::model()->getAttributeLabel(\''.$column->name'\')?>","dataField":"<?php echo \$row->'.$column->name.'?>", "width":"50", allowEditing:false, "visible":false },\n';
				}else{
					echo "\t\t\t\t<td><?php echo \$row->".$column->name." ?></td>\n";
					echo '\t\t\t\t{ "caption":"<?php echo '.$this->modelClass.'::model()->getAttributeLabel(\''.$column->name'\')?>","dataField":"<?php echo \$row->'.$column->name.'?>", "width":"250", allowEditing:true, "visible":true },\n';
				} //end if
				if($count>=4)break;
				$count++;
			} //end for
		?>
		<?php echo "\t\t\t<?php } //end for ?>" ?>	
			
			/* {
                dataField: "lista",
                caption: "Lista",
                setCellValue: function(rowData, value){
                    rowData.lista = value;
                },
                lookup: {
                    dataSource: lista,
                    valueExpr: "ID",
                    displayExpr: "NAME"
                }
            }, */
		
			{ 
				caption: "Activo", dataField: "activo", dataType: "boolean", "width":"50", "visible":true,
				setCellValue: function (rowData, value){  
					var newValue = (value == true ? 1 : 0) ;  
					this.defaultSetCellValue(rowData, newValue);  
				}
			},
			
		],
		remoteOperations: {
			filtering: true,
			grouping: true,
			groupPaging: true,
			paging: true,
			sorting: true,
			summary: true  
		},
		
		//clase para drag and drop
		onRowPrepared: function (e) {
            if (e.rowType != 'data')
                return;
            e.rowElement
            .addClass('myRow')
            .data('keyValue', e.key);
        },
		
		onCellPrepared: function(e){		
			//columna de opciones
			if(e.rowType === "data" && e.column.command === "edit") {
				var isEditing = e.row.isEditing,
					$links = e.cellElement.find(".dx-link");
	
				$links.text("");
	
				if(isEditing){
					$links.filter(".dx-link-save").addClass("dx-icon-save");
					$links.filter(".dx-link-save").attr("title","Guardar");
					
					$links.filter(".dx-link-cancel").addClass("dx-icon-revert");
					$links.filter(".dx-link-cancel").attr("title","Deshacer");
				} else {
					$links.filter(".dx-link-edit").addClass("dx-icon-edit");
					$links.filter(".dx-link-edit").attr("title","Editar");
					
					$links.filter(".dx-link-undelete").addClass("dx-icon-repeat");
					$links.filter(".dx-link-undelete").attr("title","Recuperar");
					
					$links.filter(".dx-link-delete").addClass("dx-icon-trash");
					$links.filter(".dx-link-delete").attr("title","Borrar");
				} //end if
			} //end if
			
			//Validacion de campos
			/* if(level == 1){ //activa campo unicamente al insertar
				if (e.rowType != "data" || !e.isEditing)
					//e.element.find('input').prop('disabled', true);
					return;
				if (e.column.dataField === 'id_usuario' && !e.row.inserted)
					e.element.find('input').prop('disabled', true);
					//return;
			} //end if */
		},
		onContentReady: function (e) {
			/*
			$(".customButton").remove();
			var $editButton = $('<div id="editButton" class="customButton" data-container="body" data-placement="left" data-content="Debe seleccionar un registro para editar">').dxButton({ icon: 'edit', hint: 'Editar', onClick: function(){ editRow(); } });
			if(e.element.find('#customButton').length == 0){ e.element.find('.dx-toolbar-after').prepend($editButton); }
			*/
			var keys = $('#myTable').dxDataGrid('instance').getSelectedRowKeys();
			$('#myTable').dxDataGrid('instance').deselectRows(keys);
			
			$("#editButton").popover();
			
			//hacer drag
			initDragging(e.element);
		},	
		onSelectionChanged: function(e) {
           	if (customSelection) return;
            
            customSelection = true;
            e.component.selectRows(e.currentSelectedRowKeys[0], false);
            customSelection = false;
        },
		onCellHoverChanged: function (hoverCell) {
			if (hoverCell.eventType == 'mouseover')
				hoverCell.cellElement.addClass("hovered");
			else
				hoverCell.cellElement.removeClass("hovered");
		},
		onRowUpdated: function (e) {
			//$('#myTable').dxDataGrid('instance').refresh();
		},
		onRowInserted: function (e) {
			//$('#myTable').dxDataGrid('instance').refresh();
		},
		onRowRemoved: function (e) {
			//$('#myTable').dxDataGrid('instance').refresh();
		},
	});

});

function initDragging($gridElement) {
    $gridElement.find('.myRow').draggable({
        helper: 'clone',
        start: function (event, ui) {
            var $originalRow = $(this),
                $clonedRow = ui.helper;
            var $originalRowCells = $originalRow.children(),
                $clonedRowCells = $clonedRow.children();
            for (var i = 0; i < $originalRowCells.length; i++)
                $($clonedRowCells.get(i)).width($($originalRowCells.get(i)).width());
            $clonedRow
              .width($originalRow.width())
              .addClass('drag-helper');
        }
    });
    $gridElement.find('.myRow').droppable({
        drop: function (event, ui) {
            var draggingRowKey = ui.draggable.data('keyValue');
            var targetRowKey = $(this).data('keyValue');
            var draggingIndex = null,
                targetIndex = null;
            var draggingDirection = (targetIndex < draggingIndex) ? 1 : -1;
            
			$.ajax({
               url: '<?php echo "<?php echo \$this->createUrl('process')?>"; ?>',
               type: 'POST',
               dataType: 'json',
               data: { 'oper':'sort', 'origen': draggingRowKey, 'destino':targetRowKey, 'id_destino':targetIndex, 'direccion':draggingDirection },
               success: function(data){
                   $gridElement.dxDataGrid('instance').refresh();
               },
               error: function (jqXHR, textStatus, errorThrown) {
                   alertMessage('error', jqXHR.responseText);
               }
           });
		   
        }
    });
}

/* function editRow(){
	var rowKey = $('#myTable').dxDataGrid('instance').getSelectedRowKeys();
	if(rowKey!=''){
		document.location.href='<?php echo "<?php echo \$this->createUrl('update/id');"; ?>/'+rowKey;
	}else{
		$("#editButton").popover();
	} //end if
} */

</script>