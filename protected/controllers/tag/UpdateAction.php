<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        $model=$this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Tag']))
        {
            $model->attributes=$_POST['Tag'];
            if($model->save())
                $this->redirect(array('/tag/admin'));
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
}
