<?php
/**
 * 处理艺术家相关信息的 Controller
 */
class ArtistController extends Controller
{
    # 使用的布局文件
    public $layout='column2_artist';

    # @var CActiveRecord 当前被载入的数据模型实例
    private $_model;

    public function  actions()
    {
        return array(
            'admin'=>array('class'=>'application.controllers.artist.AdminAction'),
            'create'=>array('class'=>'application.controllers.artist.CreateAction'),
            'delete'=>array('class'=>'application.controllers.artist.DeleteAction'),
            'index'=>array('class'=>'application.controllers.artist.IndexAction'),
            'newComment'=>array('class'=>'application.controllers.artist.NewCommentAction'),
            'suggestTags'=>array('class'=>'application.controllers.artist.SuggestTagsAction'),
            'update'=>array('class'=>'application.controllers.artist.UpdateAction'),
            'view'=>array('class'=>'application.controllers.artist.ViewAction'),
        );
    }

    /**
    * @return array 动作过滤器
    */
    public function filters()
    {
        return array(
                'accessControl', # 为 CRUD 操作执行访问控制
        );
    }
	
    /**
     * 指定访问控制规则。
     * 此方法被 'accessControl' 过滤器使用。
     * @return array 访问控制规则
     */
    public function accessRules()
    {
        return array(
                array('allow',  # 允许所有用户执行 'index' 和 'view' 动作
                        'actions'=>array('index','view','newComment'),
                        'users'=>array('*'),
                ),
                array('allow', # 允许 admin 用户执行 'admin' 和 'delete','create','update','suggestTags' 动作
                        'actions'=>array('admin','delete','create','update','suggestTags'),
                        'users'=>array('admin'),
                ),
                array('deny',  # 拒绝所有用户
                        'users'=>array('*'),
                ),
        );
    }
	
    /**
     * 添加评论
     * @param $post
     */
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
     * 返回基于主键值的数据模型，主键值由 GET 变量提供。
     * 若数据模型没有找到，一个 HTTP 异常被唤起。
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
            {
                if(Yii::app()->user->name=="admin")
                    $condition='';
                else
                    $condition='proved='.Artist::STATUS_PROVED;
                $this->_model=Artist::model()->findbyPk($_GET['id'],$condition);
            }
            if($this->_model===null)
                throw new CHttpException(404,'您所请求的页面不存在。');
        }
        return $this->_model;
    }

    /**
     * 执行 AJAX 验证。
     * @param CModel 被验证的模型。
     */
    public function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='artist-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}