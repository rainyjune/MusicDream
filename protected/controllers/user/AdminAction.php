<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new User('search');
        if(isset($_GET['User']))
                $model->attributes=$_GET['User'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}