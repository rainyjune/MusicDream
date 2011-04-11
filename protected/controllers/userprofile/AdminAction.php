<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new UserProfile('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['UserProfile']))
                $model->attributes=$_GET['UserProfile'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}