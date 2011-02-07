<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Playlist;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Playlist']))
        {
            $model->attributes=$_POST['Playlist'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}