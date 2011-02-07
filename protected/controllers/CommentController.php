<?php

class CommentController extends Controller
{
	private $_model;
        public function actions()
        {
            return array(
                'delete'=>array('class'=>'application.controllers.comment.DeleteAction'),
                'index'=>array('class'=>'application.controllers.comment.IndexAction'),
            );
        }
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Comment::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}