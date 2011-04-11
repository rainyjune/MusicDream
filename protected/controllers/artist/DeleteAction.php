<?php
class DeleteAction extends XRenderAction
{
    public function run()
    {
        if(Yii::app()->request->isPostRequest)
        {
            # 我们只允许通过 POST 请求删除
            $this->loadModel()->delete();

            # 若 AJAX 请求(在管理页面的删除操作触发), 我们不转向浏览器
            if(!isset($_GET['ajax']))
                $this->redirect(array('index'));
        }
        else
            throw new CHttpException(400,'无效的请求。请不要重复此次请求。');
    }
}