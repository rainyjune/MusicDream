<?php
class DeleteAction extends XRenderAction
{
    public function run()
    {
        if(Yii::app()->request->isPostRequest)// we only allow deletion via POST request
        {
            try{
                $this->loadModel()->delete();
                Yii::app()->user->setFlash('success', "成功删除");
            }
            catch (CDbException $e){
                Yii::app()->user->setFlash('error', "不能删除");
		$this->redirect(array('admin'));
                exit;
            }
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax'])){
                $this->redirect(array('admin'));
            }
        }
        else
            throw new CHttpException(400,'无效的请求。请不要重复此请求。');
    }
}