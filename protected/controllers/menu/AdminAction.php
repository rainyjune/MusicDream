<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Menu('search');
        if(isset($_GET['Menu']))
            $model->attributes=$_GET['Menu'];
        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}