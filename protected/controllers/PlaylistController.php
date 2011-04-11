<?php

class PlaylistController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2_user';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

        public function actions()
        {
            return array(
                'addToPlayList'=>array('class'=>'application.controllers.playlist.AddToPlayListAction'),
                'admin'=>array('class'=>'application.controllers.playlist.AdminAction'),
                'create'=>array('class'=>'application.controllers.playlist.CreateAction'),
                'delete'=>array('class'=>'application.controllers.playlist.DeleteAction'),
                'index'=>array('class'=>'application.controllers.playlist.IndexAction'),
                'update'=>array('class'=>'application.controllers.playlist.UpdateAction'),
                'view'=>array('class'=>'application.controllers.playlist.ViewAction'),
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
			array('allow',
				'actions'=>array('addToPlayList','create','index'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('view','update','delete'),
				'users'=>array('@'),
				'expression'=>array(__CLASS__,'checkOwner'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','index','view','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public static function checkOwner($user,$rule)
	{
		$rule=false;
		$playList=new Playlist;
		$userId=$user->id;
		if(!isset($_GET['id']))
			return $rule;
		$playListId=$_GET['id'];
		if($playList->exists("id=$playListId AND uid=$userId"))
			$rule=true;
		return $rule;
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
				$this->_model=Playlist::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='playlist-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
