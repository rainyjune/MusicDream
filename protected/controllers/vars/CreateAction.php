<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Vars;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Vars']))
        {
            $model->attributes=$_POST['Vars'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}