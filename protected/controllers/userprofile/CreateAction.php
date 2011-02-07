<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new UserProfile;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['UserProfile']))
        {
            $model->attributes=$_POST['UserProfile'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }
        $this->render('create',array(
                'model'=>$model,
        ));
    }
}