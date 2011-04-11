<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Menu');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}