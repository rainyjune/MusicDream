<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="container">
	<div class="span-19">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-5 last">
		<div id="sidebar">
		<?php
			/*
                    Yii::app()->clientScript->registerScript('artist-navigator',"
                        $('#sidebar').css('position','relative');
                        $(window).scroll(function () {
                            $('#sidebar').css('top', $(document).scrollTop());
                        });
                    ");
			*/

			Yii::app()->clientScript->registerScript('artist-navigator',"
				$('#sidebar').floatdiv({right:'300px',top:'80px'});
            ");
			
                    $this->beginWidget('zii.widgets.CPortlet', array('title'=>'导航'));
                    $this->widget(
                            'CTreeView',
                            array(
                            'htmlOptions'=>array('class'=>'treeview-famfamfam'),
                            'data' => Artist::getArtistNavData())
                    );
                    $this->endWidget();
		?>
		<?php
		//display the portlet only for admin user
		if(Yii::app()->user->name=="admin")
		{	
                    $this->beginWidget('zii.widgets.CPortlet', array(
                            'title'=>'操作',
                    ));
                    $this->widget('zii.widgets.CMenu', array(
                            'items'=>$this->menu,
                            'htmlOptions'=>array('class'=>'operations'),
                    ));
                    $this->endWidget();
		}
		?>
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>