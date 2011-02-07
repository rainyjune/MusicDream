<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Tag('search');
        if(isset($_GET['Tag']))
            $model->attributes=$_GET['Tag'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}