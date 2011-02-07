<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='dashboard';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
                    'admin'=>array('class'=>'application.controllers.user.AdminAction'),
                    'autocompletelookup'=>array('class'=>'application.controllers.user.AutocompletelookupAction'),
                    'create'=>array('class'=>'application.controllers.user.CreateAction'),
                    'delete'=>array('class'=>'application.controllers.user.DeleteAction'),
                    'forgotpassword'=>array('class'=>'application.controllers.user.ForgotpasswordAction'),
                    'index'=>array('class'=>'application.controllers.user.IndexAction'),
                    'register'=>array('class'=>'application.controllers.user.RegisterAction'),
                    'update'=>array('class'=>'application.controllers.user.UpdateAction'),
                    'view'=>array('class'=>'application.controllers.user.ViewAction'),
		);
	}
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			/*
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','captcha','Autocompletelookup'),
				'users'=>array('*'),
			),
			*/
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('register','view','captcha','Autocompletelookup','forgotpassword'),
				'users'=>array('*'),
			),
			/*
			array('allow',
				'actions'=>array('register'),
				'users'=>array('?'),
			),*/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update'),
				'users'=>array('@'),
				'expression'=>'isset($user->id) && $user->id==$_GET["id"]'
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','delete','create','update','register'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
