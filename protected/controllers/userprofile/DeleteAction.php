<?php
class DeleteAction extends XRenderAction
{
    public function run()
    {
        if(isset ($_GET['id']))
            $id=(int)$_GET['id'];
        else
            throw new CHttpException (404, 'invalid request');
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}