<?php
$this->breadcrumbs=array(
	'管理面板',
);?>

<?php
$menuContent="<iframe src='index.php?r=menu/admin&from=dashboard' width='100%' height='600px'></iframe>";
$userContent="<iframe src='index.php?r=user/admin&from=dashboard'  width='100%' height='600px'></iframe>";
$artistAreaContent="<iframe src='index.php?r=artistArea/admin&from=dashboard'  width='100%' height='600px'></iframe>";
$artistTypeContent="<iframe src='index.php?r=artistType/admin&from=dashboard'  width='100%' height='600px'></iframe>";
$tagContent="<iframe src='index.php?r=tag/admin&from=dashboard'  width='100%' height='600px'></iframe>";
$varContent="<iframe src='index.php?r=vars/admin&from=dashboard'  width='100%' height='600px'></iframe>";
//$htmlOptions=array('width'=>'100%','height'=>'600px');
$Tabs = array(
    'tab1'=>array('title'=>'栏目管理','content'=>$menuContent),
    'tab2'=>array('title'=>'用户管理','content'=>$userContent),
    'tab3'=>array('title'=>'艺术家地区管理','content'=>$artistAreaContent),
    'tab4'=>array('title'=>'艺术家类型管理','content'=>$artistTypeContent),
    'tab5'=>array('title'=>'标签管理','content'=>$tagContent),
    'tab6'=>array('title'=>'系统变量管理','content'=>$varContent),
    );
$this->widget('CTabView', array('tabs'=>$Tabs));
?>