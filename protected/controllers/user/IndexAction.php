<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('User');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}