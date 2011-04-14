<?php
class AlbumController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to 'column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

    public function  actions() {
        return array(
            'view'=>array('class'=>'application.controllers.album.ViewAction'),
			'newRelease'=>array('class'=>'application.controllers.album.NewReleaseAction'),
            'newComment'=>array('class'=>'application.controllers.album.NewCommentAction'),
            'index'=>array('class'=>'application.controllers.album.IndexAction'),
            'admin'=>array('class'=>'application.controllers.album.AdminAction'),
            'create'=>array('class'=>'application.controllers.album.CreateAction'),
            'update'=>array('class'=>'application.controllers.album.UpdateAction'),
            'delete'=>array('class'=>'application.controllers.album.DeleteAction'),
            'dynamicalbums'=>array('class'=>'application.controllers.album.DynamicalbumsAction'),
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
				'actions'=>array('index','view','newComment','newRelease'),
				'users'=>array('*'),
			),
			/*array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete','create','update' actions
				'actions'=>array('admin','delete','create','update','dynamicalbums',),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        public function newComment($post)
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
				$this->_model=Album::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	public function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
