<?php
Yii::import('zii.widgets.CPortlet');
class ArtistNav extends CPortlet
{
	public function init()
	{
		$this->title='导航';
		parent::init();
	}
	
	protected function renderContent()
	{
		$this->render('artistNav');
	}
}
?>