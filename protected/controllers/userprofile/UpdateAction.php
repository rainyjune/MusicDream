<?php
class UpdateAction extends XRenderAction
{
    public function run($id)
    {
		$id=(int)$id;
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
