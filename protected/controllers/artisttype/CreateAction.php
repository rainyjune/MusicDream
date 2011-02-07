<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new ArtistType;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['ArtistType']))
        {
            $model->attributes=$_POST['ArtistType'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}