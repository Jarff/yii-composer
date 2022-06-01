<?php
/**
 * This is the template for generating a controller class file for CRUD feature.
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseControllerClass."\n"; ?>
{
	/**
	 * @var string the default layout for the views. 
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','admin','process','create','update','delete','activo'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Redirect to Lists all models.
	 */
	public function actionIndex(){
		//Redirecciona a admin
		$this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionAdmin(){
		$model=<?php echo $this->modelClass; ?>::model()->findAll();
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Process Action Model.
	 */
	public function actionProcess()
	{
		$returnArr['check'] = 0;
		$returnArr['msg'] = 'Error al guardar la informacion';
		$sql = null;
		
		if(!empty($_POST['oper'])){
			
			//actualizar un registro
			if($_POST['oper'] == 'update'){ 
				$postValues = json_decode($_POST['values']);
				
				$model = <?php echo $this->modelClass; ?>::model()->findByPk($_POST['key']);
				foreach($postValues as $field => $val){
					$sql = Yii::app()->db->createCommand("UPDATE <?php echo $this->modelClass; ?> SET ".$field." = '".$val."' WHERE <?php echo $this->tableSchema->primaryKey; ?> = ".$_POST['key']." ")->query();
				} //end for
													
			} //end if
			
			//insertar un registro
			if($_POST['oper'] == 'add'){				
				$postValues = json_decode($_POST['values']);
				$fieldsArr = array();
				$valuesArr = array();
				
				foreach($postValues as $field => $val){
					$fieldsArr[] = $field;
					$valuesArr[] = "'".$val."'";
					
				} //end for
				
				$fields = implode(",", $fieldsArr);
				$values = implode(",", $valuesArr);
				
				$sqlParent = new Metadatos;
				$sqlParent->id_categoria = $idcat;
				$sqlParent->activo = 1;
				$sqlParent->save();
								
				$sql = Yii::app()->db->createCommand("INSERT INTO <?php echo $this->modelClass; ?> (".$fields." )VALUES( ".$values." )")->query();
			} //end if
			
			//borrar un registro
			if($_POST['oper'] == 'del'){ 
				$sql = <?php echo $this->modelClass; ?>::model()->findByPk($_POST['key'])->delete();
			} //end if
			
			if($sql){
				$returnArr['check'] = 1;
				$returnArr['msg'] = 'Se guardo la informacion correctamente';
			} //end if	
			
		} //end if
		
		echo json_encode($returnArr);
		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'admin' page.
	 */
	public function actionCreate(){
		$model=new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>'])){
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
				//Redirecciona a admin
				$this->redirect(array('admin'));
				
				//ó Redireccionas al mismo update
				//$this->redirect(array('_form','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));				
			} //end if
		} //end if

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id){
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>'])){
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
				//Redirecciona a admin
				$this->redirect(array('admin'));
				
				//ó Redireccionas al mismo update
				//$this->redirect(array('_form','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
			} //end if
		} //end if

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		//if(!isset($_GET['ajax']))return false;
		
		$data=array("check"=>"0");
		if($this->loadModel($id)->delete())$data=array("check"=>"1");

		echo json_encode($data);
		exit();
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Update active field on current model.
	 * if current active field is true then this change to false and vice versa
	 * @param integer $id the ID to change
	 */
	public function actionActivo($id){
		$model=$this->loadModel($id);
		// Important to have the active field declared
		// in the database model
		$activo=$model->activo;
		
		if($model->activo){
			$model->activo=0;
		}else{
			$model->activo=1;
		} //end if
		
		$arrResp=array();
					
		if($model->save()){
			$arrResp=array(	'check'=>1,
							'activo'=>$model->activo);			
		}else{
			$arrResp=array(	'check'=>0,
							'activo'=>$activo);						
		} //end if
		
		echo json_encode($arrResp);
		Yii::App()->end();
	}
	
}
