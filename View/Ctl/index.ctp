<?php
$reports_by_id = array(); //= Set::combine($reports,'{n}.assigned_to_id','{n}');
foreach ($reports as $val) {
	$user_id = $val['assigned_to_id'];
	if ( !array_key_exists($user_id, $reports_by_id) ) {
		$reports_by_id[$user_id]['total'] = $val['total'];
		$reports_by_id[$user_id]['done'] = $val['done'];
	}
	
	if ($val['closed']) {
		continue;
	}
	$reports_by_id[$user_id]['total'] += $val['total'];
	$reports_by_id[$user_id]['done']  += $val['done'];
	
}
?>
<table class="list">
<thead>
  <tr>
    <th width="20%"><?php echo __('Name',true)?></th>
    <th width="70%"><?php echo __('Issues',true)?></th>
    <th width="70%"><?php echo __('Spent time',true)?></th>
  </tr>
</thead>
<tbody>
<?php foreach ($main_project['User'] as $val): ?>
  <tr class="<?=$this->Candy->cycle('even','odd')?>">
    <td align="center"><?= $this->Candy->format_username($val)?></td>
    <td align="center"><?= !empty($reports_by_id[$val['id']]['total']) ? $reports_by_id[$val['id']]['total'] : 0; ?></td>
	<td align="center"><?= !empty($reports_by_id[$val['id']]['done']) ? $reports_by_id[$val['id']]['done'] : 0; ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
