<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Tag;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Tag']))
        {
            $model->attributes=$_POST['Tag'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}