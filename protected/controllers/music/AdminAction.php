<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Music('search');
        if(isset($_GET['Music']))
                $model->attributes=$_GET['Music'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}