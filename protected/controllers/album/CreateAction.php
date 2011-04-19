<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Album;
        if(isset($_GET['artist_id']))
        {
            $artist_id=$_GET['artist_id'];
            $artist_info=Artist::model()->findByPk($artist_id);
            $model->artist_id=$artist_id;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Album']))
        {
            $model->attributes=$_POST['Album'];
            $model->image=CUploadedFile::getInstance($model,'image');

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
                'model'=>$model,
                //'artist_id'=>$artist_id
        ));
    }
}
