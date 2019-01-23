<?php 
	$default = $config->paths->content."item-information/default-formatters/ii-sales-order.json";
		$defaultjson = json_decode(file_get_contents($default), true); 
		$table = array('rows' => array());
		for ($i = 1; $i < $defaultjson['rows'] + 1; $i++) {
			$table['rows'][$i] = array('columns' => array());
			$count = 1;
			foreach($defaultjson['columns'] as $column) {
				if ($column['line'] == $i) {
					$table['rows'][$i]['columns'][$count] = array('name' => $column['name'], 'col-length' => $column['col-length'], 'before-decimal' => $column['before-decimal'], 'after-decimal' => $column['after-decimal'], 'date-format' => $column['date-format']);
					$count++;
				}
			}
		}
	
?>
<?php foreach ($table['rows'] as $rows) : ?>
	<tr>
		<?php foreach ($rows['columns'] as $column) : ?>
			<td><?php echo $column['name']; ?></td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>