<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        $model=$this->loadModel();

        $this->performAjaxValidation($model);

        if(isset($_POST['Artist']))
        {
            $model->attributes=$_POST['Artist'];
            $model->image=CUploadedFile::getInstance($model,'image');
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
}