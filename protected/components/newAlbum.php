<?php
Yii::import('zii.widgets.CPortlet');
class newAlbum extends CPortlet
{
	public function init()
	{

	}
	public function run()
	{
		echo 'Hello newAlbum';
		$this->render('newReleaseAlbum');
	}
}  
