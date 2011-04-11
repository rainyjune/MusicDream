<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new ArtistType('search');
        if(isset($_GET['ArtistType']))
            $model->attributes=$_GET['ArtistType'];
        $this->render('admin',array('model'=>$model,));
    }
}