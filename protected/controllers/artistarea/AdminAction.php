<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new ArtistArea('search');
        if(isset($_GET['ArtistArea']))
            $model->attributes=$_GET['ArtistArea'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}