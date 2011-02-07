<?php
class ViewAction extends XRenderAction
{
    public function run()
    {
        $this->render('view',array(
                'model'=>$this->loadModel(),
        ));
    }
}
