<?php
class UserProfileController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='/layouts/column2';

    public function actions()
    {
        return array(
            'admin'=>array('class'=>'application.controllers.userprofile.AdminAction'),
            'create'=>array('class'=>'application.controllers.userprofile.CreateAction'),
            'delete'=>array('class'=>'application.controllers.userprofile.DeleteAction'),
            'index'=>array('class'=>'application.controllers.userprofile.IndexAction'),
            'update'=>array('class'=>'application.controllers.userprofile.UpdateAction'),
            'view'=>array('class'=>'application.controllers.userprofile.ViewAction'),
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
                        'actions'=>array('index','view'),
                        'users'=>array('*'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('create'),
                        'users'=>array('@'),
                ),
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array('update'),
                        'users'=>array('@'),
                        'expression'=>'isset($user->id) && $user->id==$_GET["id"]'
                ),
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete'),
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
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=UserProfile::model()->findByPk((int)$id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-profile-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
