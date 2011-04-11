<?php
class AddToPlayListAction extends XRenderAction
{
    public function run()
    {
        if(Yii::app()->request->isPostRequest)
        {
            if(is_array($_POST['id']))
                $ids=implode('_',$_POST['id']);
            else
                $ids=$_POST['id'];

            $model=new PlaylistMusic;
            //若请求来自添加表单(fancybox)
            if(isset($_POST['PlaylistMusic']))
            {
                $model->attributes=$_POST['PlaylistMusic'];
                $model->ids=$ids;
                if($model->addMusic())
                    $this->redirect(array('view','id'=>$model->playlist_id));
                else
                    echo 'save bad!';exit;
            }
            $this->renderPartial('addToPlayList',array(
                    'model'=>$model,
                    'id'=>$ids,
            ));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}