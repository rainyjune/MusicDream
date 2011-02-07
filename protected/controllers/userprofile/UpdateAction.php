<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        if(isset ($_GET['id']))
            $id=(int)$_GET['id'];
        else
            throw new CHttpException (404, 'invalid request');
        $model=$this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['UserProfile']))
        {
            $model->attributes=$_POST['UserProfile'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('update',array(
                'model'=>$model,
        ));
    }
}