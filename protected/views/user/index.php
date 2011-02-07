<?php
$this->breadcrumbs=array(
	'用户',
);

$this->menu=array(
	array('label'=>'创建用户', 'url'=>array('create')),
	array('label'=>'管理用户', 'url'=>array('admin')),
	//Add by myself
	//array('label'=>'注册用户','url'=>array('register')),
);
?>

<h1>用户</h1>
<form>
<?php
/*
 * only for demo use 
$this->widget('CAutoComplete',
          array(
                         //name of the html field that will be generated
             'name'=>'username',
                         //replace controller/action with real ids
             'url'=>array('user/Autocompletelookup'),
             'max'=>10, //specifies the max number of items to display

                         //specifies the number of chars that must be entered
                         //before autocomplete initiates a lookup
             'minChars'=>2,
             'delay'=>300, //number of milliseconds before lookup occurs
             'matchCase'=>false, //match case when performing a lookup?

                         //any additional html attributes that go inside of
                         //the input field can be defined here
             'htmlOptions'=>array('size'=>'40'),

             'methodChain'=>".result(function(event,item){\$(\"#id\").val(item[1]);})",
             ));
			 */
    ?>
    <?php echo CHtml::hiddenField('id'); ?>
	</form>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
