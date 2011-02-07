<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Artist('create');
        $this->performAjaxValidation($model);
        if(isset($_POST['Artist']))
        {
            $model->attributes=$_POST['Artist'];
            $model->image=CUploadedFile::getInstance($model,'image');
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}