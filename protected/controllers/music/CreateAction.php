<?php
class CreateAction extends XRenderAction
{
    public function run()
    {
        $model=new Music;
        if(isset($_GET['artist_id']))
        {
            $model->artist_id=(int)$_GET['artist_id'];
        }
        elseif(isset($_GET['album_id']))
        {
            $album_id=(int)$_GET['album_id'];
            $album_info=Album::model()->findByPk($album_id);
            $model->artist_id=$album_info->artist_id;
            $model->album_id=$album_id;
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Music']))
        {
            $model->attributes=$_POST['Music'];
            $model->musicfile=CUploadedFile::getInstance($model,'musicfile');
            if($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create',array(
                'model'=>$model,
        ));
    }
}
