<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        $model=$this->loadModel();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Album']))
        {
            $model->attributes=$_POST['Album'];
            $model->image=CUploadedFile::getInstance($model,'image');
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
}