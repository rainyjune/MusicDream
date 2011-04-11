<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Menu;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Menu']))
        {
            $model->attributes=$_POST['Menu'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}