<?php
/**
 * 艺术家地区
 */
class ArtistAreaController extends Controller
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

    public function  actions()
    {
        return array(
            'admin'=>array('class'=>'application.controllers.artistarea.AdminAction'),
            'create'=>array('class'=>'application.controllers.artistarea.CreateAction'),
            'delete'=>array('class'=>'application.controllers.artistarea.DeleteAction'),
            'index'=>array('class'=>'application.controllers.artistarea.IndexAction'),
            'update'=>array('class'=>'application.controllers.artistarea.UpdateAction'),
            'view'=>array('class'=>'application.controllers.artistarea.ViewAction'),
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
                array('allow', // allow admin user to perform 'admin' and 'delete' actions
                        'actions'=>array('admin','delete','create','update'),
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
                $this->_model=ArtistArea::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'请求的页面不存在。');
        }
        return $this->_model;
    }

    /**
    * Performs the AJAX validation.
    * @param CModel the model to be validated
    */
    public function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='artist-area-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}