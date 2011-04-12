<tr>
	<td><input type="checkbox" name="id[]" value="<?php echo $data->music->id;?>" /></td>
	<td><?php echo CHtml::link(CHtml::encode($data->music->name),array('music/view','id'=>$data->music->id));?></td>
	<td><?php echo CHtml::link(CHtml::encode($data->music->artist->name),array('artist/view','id'=>$data->music->artist->id));?></td>
	<td>试听 + </td>
</tr>
