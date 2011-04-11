<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new ArtistArea;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['ArtistArea']))
        {
            $model->attributes=$_POST['ArtistArea'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}