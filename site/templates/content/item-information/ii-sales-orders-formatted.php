<?php 
	$salesfile = $config->jsonfilepath.session_id()."-iisalesordr.json"; 
 //$salesfile = $config->jsonfilepath."iiso-iisalesordr.json"; 
	if (checkformatterifexists($user->loginid, 'ii-sales-order', false)) {
		$defaultjson = json_decode(getformatter($user->loginid, 'ii-sales-order', false), true);
	} else {
		$default = $config->paths->content."item-information/screen-formatters/default/ii-sales-order.json";
		$defaultjson = json_decode(file_get_contents($default), true); 
		
		
		if (checkformatterifexists($user->loginid, 'ii-sales-order', false)) {
			$defaultjson = json_decode(getformatter($user->loginid, 'ii-sales-order', false), true);
		} else {
			$default = $config->paths->content."item-information/screen-formatters/default/ii-sales-order.json";
			$defaultjson = json_decode(file_get_contents($default), true); 
		}

		$columns = array_keys($defaultjson['columns']);
		$table = array('rows' => array());
		for ($i = 1; $i < $defaultjson['rows'] + 1; $i++) {
			$table['rows'][$i] = array('columns' => array());
			$count = 1;
			foreach($columns as $column) {
				if ($defaultjson['columns'][$column]['line'] == $i) {
					$table['rows'][$i]['columns'][$count] = array('id' => $column, 'label' => $defaultjson['columns'][$column]['label'], 'col-length' => $defaultjson['columns'][$column]['col-length'], 'before-decimal' => $defaultjson['columns'][$column]['before-decimal'], 'after-decimal' => $defaultjson['columns'][$column]['after-decimal'], 'date-format' => $defaultjson['columns'][$column]['date-format']);
					$count++;
				}
			}
		}
?>

<?php if (file_exists($salesfile)) : ?>
    <?php $ordersjson = json_decode(file_get_contents($salesfile), true);  ?>
    <?php if (!$ordersjson) { $ordersjson = array('error' => true, 'errormsg' => 'The sales order JSON contains errors');} ?>

    <?php if ($ordersjson['error']) : ?>
        <div class="alert alert-warning" role="alert"><?php echo $ordersjson['errormsg']; ?></div>
    <?php else : ?>
        
        <?php foreach ($ordersjson['data'] as $whse) : ?>

            <?php if ($whse != $ordersjson['data']['zz']) : ?>
                <div>
                    <h3><?php echo $whse['Whse Name']; ?></h3>
                    <table class="table table-striped table-bordered table-condensed table-excel" id="<?php echo urlencode($whse['Whse Name']); ?>">
                        <thead>
                           <?php for ($x = 1; $x < sizeof($table['rows']); $x++) : ?>
                          		<tr>
                           		<?php for ($i = 1; $i < sizeof($table['rows'][$x]['columns']); $i++) : ?>
                           			<th><?php echo $table['rows'][$x]['columns'][$i]['id']; ?> </th>
                           		<?php endfor; ?>
                           		</tr>
                           <?php endfor; ?>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>

                </div>
            <?php endif; ?>

        <?php endforeach; ?>
        <div>
            <h3><?php echo $ordersjson['data']['zz']['Whse Name']; ?></h3>
            <table class="table table-striped table-bordered table-condensed table-excel">
                <thead>
                    <tr>
                        <?php foreach($ordersjson['columns'] as $column) : ?>
                            <th class="<?php echo $config->textjustify[$column['headingjustify']]; ?>"><?php echo $column['heading']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($ordersjson['data']['zz']['orders'] as $order) : ?>
                        <tr>
                            <?php foreach($columns as $column) : ?>
                                <td class="<?= $config->textjustify[$ordersjson['columns'][$column]['datajustify']]; ?>"><?php echo $order[$column]; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

<?php else : ?>
    <div class="alert alert-warning" role="alert">Information Not Available</div>
<?php endif; ?>
