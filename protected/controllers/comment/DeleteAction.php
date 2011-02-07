<?php
class DeleteAction extends XRenderAction
{
    public function run()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel()->delete();
            $r=urldecode(Yii::app()->request->getQuery('src'));
            $id=urldecode(Yii::app()->request->getQuery('srcid'));
            $this->redirect(array($r,'id'=>$id));
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            //if(!isset($_GET['ajax']))
                    //$this->redirect(array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
}