<?php
class DeleteAction extends XRenderAction
{
    public function run()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            try{
                $this->loadModel()->delete();
                Yii::app()->user->setFlash('success','删除成功!');
            }
            catch (CDbException $e)
            {
                Yii::app()->user->setFlash('error','不能删除此类型！');
                $this->redirect(array('admin'));exit;
            }

            // 若 AJAX 请求 (由管理网格视图里的删除触发), 我们不应该重定向浏览器
            if(!isset($_GET['ajax']))
                $this->redirect(array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}