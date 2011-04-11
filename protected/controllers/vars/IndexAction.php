<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Vars');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}