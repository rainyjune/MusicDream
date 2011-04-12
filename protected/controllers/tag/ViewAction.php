<?php
class ViewAction extends XRenderAction
{
    public function run($id)
    {
		$id=(int)$id;
		$dataProvider=new CActiveDataProvider('ItemsTags',array(
			'criteria'=>array(
				'condition'=>'item_type='.ItemsTags::MUSIC_TYPE.' and tag_id='.$id,
				'with'=>array('music','music.artist'),
			),
			'pagination'=>array(
				'pageSize'=>20
			)
		));
        $this->render('view',array(
                'model'=>$this->loadModel(),
				'dataProvider'=>$dataProvider,
        ));
    }
}
