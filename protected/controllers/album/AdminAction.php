<?php
class AdminAction extends XRenderAction
{
    public function run()
    {
        $model=new Album('search');
        if(isset($_GET['Album']))
            $model->attributes=$_GET['Album'];

        $this->render('admin',array(
                'model'=>$model,
        ));
    }
}
?>
