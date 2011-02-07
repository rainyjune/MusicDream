<?php
class UpdateAction extends XRenderAction
{
    public function run()
    {
        $model=$this->loadModel();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['ArtistType']))
        {
            $model->attributes=$_POST['ArtistType'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
                'model'=>$model,
        ));
    }
}