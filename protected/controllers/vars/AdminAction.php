<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Vars('search');
        if(isset($_GET['Vars']))
                $model->attributes=$_GET['Vars'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}