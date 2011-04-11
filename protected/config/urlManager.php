<?php
return array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'user/<id:\d+>/<username:.*?>'=>'user/view',
				'artist/<id:\d+>/<artist:.*?>'=>'artist/view',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
			),
		);
?>