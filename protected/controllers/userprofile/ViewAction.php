<?php
class ViewAction extends XRenderAction
{
    public function run()
    {
        if(isset ($_GET['id']))
            $id=(int)$_GET['id'];
        else
            throw new CHttpException (404, 'invalid request');
        $this->render('view',array(
                'model'=>$this->loadModel($id),
        ));
    }
}