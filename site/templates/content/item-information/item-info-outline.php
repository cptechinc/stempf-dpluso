<?php
	$itemfile = $config->jsonfilepath.session_id()."-iiitem.json";
	if (file_exists($itemfile)) {
		$itemjson = json_decode(file_get_contents($itemfile), true); $columns = array();
	} else {
		$itemjson = false;
	}
?>
<div class="row">
   <?php if (100 == 2) : ?>
	<div class="col-sm-2">
		<?php include $config->paths->content."item-information/ii-buttons.php"; ?>
	</div>
	<?php endif; ?>
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-6">
				<?php include $config->paths->content."item-information/item-display.php"; ?>
			</div>
			<div class="col-sm-6">
				<table class="table table-bordered table-striped table-condensed table-excel">
					<tr>
						<td class="control-label">Item ID:</td>
						<td>
							<?php include $config->paths->content."item-information/forms/item-page-form.php"; ?>
						</td>
					</tr>
					<tr>
						<td></td><td><?php echo $itemjson['data']['Item Description 1']; ?></td>
					</tr>
					<tr>
						<td></td><td><?php echo $itemjson['data']['Item Description 2']; ?></td>
					</tr>
					<tr>
						<td class="control-label"><?php echo 'Item Group Code'; ?></td> <td><?php echo $itemjson['data']['Item Group Code']; ?></td>
					</tr>
					<tr>
						<td class="control-label"><?php echo 'Price Group Code'; ?></td> <td><?php echo $itemjson['data']['Price Group Code']; ?></td>
					</tr>
					<tr>
						<td class="control-label"><?php echo 'Taxable Code'; ?></td> <td><?php echo $itemjson['data']['Taxable Code']; ?></td>
					</tr>
					<tr>
						<td class="control-label"><?php echo 'UPC Code'; ?></td> <td><?php echo $itemjson['data']['UPC Code']; ?></td>
					</tr>
				</table>
			</div>

		</div>
		<div class="row">
			<div class="col-sm-4">
				<?php //$columns = array('asstcode', 'weight', 'finish', 'material', 'color'); ?>
				<?php //include $config->paths->content."item-information/tables/generate-table.php"; ?>
			</div>
			<div class="col-sm-4">
				<?php //$columns = array('revision', 'primvend', 'unitcost', 'merged'); ?>
				<?php //include $config->paths->content."item-information/tables/generate-table.php"; ?>
			</div>
			<div class="col-sm-4">
				<table class="table table-bordered table-striped table-condensed table-excel">
					<tr>
						<td class="control-label"><?php echo 'kitbom'; ?></td> <td><?php echo $itemjson['data']['Kit/BOM Indicator']; ?></td>
					</tr>
					<tr> <td>&nbsp;</td> <td>&nbsp;</td> </tr>
					<tr>
						<td class="control-label"><?php echo 'puruom'; ?></td> <td><?php echo $itemjson['data']['Purchase Unit of Measure']; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<?php if ($input->get->custID) : ?>
					<h4>Pricing for <?= get_customername($custID); ?></h4>
				<?php else : ?>
					<h4>Pricing</h4>
				<?php endif; ?>
				<?php include $config->paths->content."item-information/item-price-breaks.php"; ?>
			</div>
			<div class="col-sm-6">

			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h4>Stock</h4>
				<?php include $config->paths->content."item-information/item-stock.php"; ?>
			</div>
		</div>
	</div>
</div>
<br>
