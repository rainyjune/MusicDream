<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('ArtistType');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}