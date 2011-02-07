<?php

class MusicController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
        public  $_model;

        public function actions()
        {
            return array(
                'admin'=>array('class'=>'application.controllers.music.AdminAction'),
                'create'=>array('class'=>'application.controllers.music.CreateAction'),
                'delete'=>array('class'=>'application.controllers.music.DeleteAction'),
                'index'=>array('class'=>'application.controllers.music.IndexAction'),
                'lrc'=>array('class'=>'application.controllers.music.LrcAction'),
                'newComment'=>array('class'=>'application.controllers.music.NewCommentAction'),
                'play'=>array('class'=>'application.controllers.music.PlayAction'),
                'update'=>array('class'=>'application.controllers.music.UpdateAction'),
                'view'=>array('class'=>'application.controllers.music.ViewAction'),
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','play','lrc','newComment'),
				'users'=>array('*'),
			),
			/*
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        public  function newComment($post)
	{
	    $comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
	    if(isset($_POST['Comment']))
	    {
	        $comment->attributes=$_POST['Comment'];
	        if($post->addComment($comment))
	        {
	            //    Yii::app()->user->setFlash('commentSubmitted','Thank you...');
	            $this->refresh();
	        }
	    }
	    return $comment;
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
				$this->_model=Music::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'您请求的页面不存在。');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='music-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
