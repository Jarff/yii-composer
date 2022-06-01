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
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','activo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'admin' page.
	 */
	public function actionCreate()
	{
		$model=new <?php echo $this->modelClass; ?>;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
				//Redirecciona a admin
				$this->redirect(array('admin'));
				
				//ó Redireccionas al mismo update
				//$this->redirect(array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));				
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['<?php echo $this->modelClass; ?>']))
		{
			$model->attributes=$_POST['<?php echo $this->modelClass; ?>'];
			if($model->save()){
				//Redirecciona a admin
				$this->redirect(array('admin'));
				
				//ó Redireccionas al mismo update
				//$this->redirect(array('update','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//if(!isset($_GET['ajax']))return false;
		
		$data=array("check"=>"0");
		if($this->loadModel($id)->delete())$data=array("check"=>"1");

		echo json_encode($data);
		exit();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//Redirecciona a admin
		$this->redirect(array('admin'));
	}

	/**
	 * Despliega el listado de registros.
	 */
	public function actionAdmin()
	{
		$model=<?php echo $this->modelClass; ?>::model()->findAll();
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=<?php echo $this->modelClass; ?>::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='<?php echo $this->class2id($this->modelClass); ?>-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Cambia el campo activo del modelo.
	 * Dependiendo del estado actual es el estado a cual será cambiado
	 * @param integer $id the ID del model a ser cambiado
	 */
	public function actionActivo($id)
	{
		$model=$this->loadModel($id);
		//Importante tener declarado el campo activo
		//en el modelo de base de datos
		$activo=$model->activo;
		
		if($model->activo){
			$model->activo=0;
		}else{
			$model->activo=1;
		}
		
		$arrResp=array();
					
		if($model->save()){
			$arrResp=array(	'check'=>1,
							'activo'=>$model->activo);			
		}else{
			$arrResp=array(	'check'=>0,
							'activo'=>$activo);						
		}
		
		echo json_encode($arrResp);
		Yii::App()->end();
	}	
}
