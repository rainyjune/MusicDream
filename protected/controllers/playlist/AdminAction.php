<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Playlist('search');
        if(isset($_GET['Playlist']))
                $model->attributes=$_GET['Playlist'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}