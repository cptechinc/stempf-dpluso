<?php
	if (checkformatterifexists($user->loginid, 'ci-sales-order', false)) {
		$columnindex = 'columns';
		$formatter = json_decode(getformatter($user->loginid, 'ci-sales-order', false), true);
		$action = 'edit-formatter';
	} else {
		$columnindex = 'columns';
		$formatter = json_decode(file_get_contents($config->paths->content."cust-information/screen-formatters/default/ci-sales-orders.json"), true);
		$action = 'add-formatter';
	}

	$fieldsjson = json_decode(file_get_contents($config->companyfiles."json/cisofmattbl.json"), true);
	$detailcolumns = array_keys($fieldsjson['data']['detail']);
	$headercolumns = array_keys($fieldsjson['data']['header']);
	$itemstatuscolumns = array_keys($fieldsjson['data']['itemstatus']);
	$pocolumns = array_keys($fieldsjson['data']['purchaseorder']);
	$totalcolumns = array_keys($fieldsjson['data']['total']);
	$shipcolumns = array_keys($fieldsjson['data']['shipments']);

	$examplejson = json_decode(file_get_contents($config->paths->content."cust-information/screen-formatters/examples/ci-sales-orders.json"), true);

	$datetypes = array('m/d/y' => 'MM/DD/YY', 'm/d/Y' => 'MM/DD/YYYY', 'm/d' => 'MM/DD', 'm/Y' => 'MM/YYYY')
?>

<div class="formatter-response">
	<div class="message"></div>
</div>

<form action="<?php echo $config->pages->ajax."json/ci/ci-sales-order-formatter/"; ?>" method="POST" class="screen-formatter-form" id="ci-so-form">
	<input type="hidden" name="action" value="<?php echo $action; ?>">
	<input type="hidden" name="detail-rows" class="detail-rows">
	<input type="hidden" name="header-rows" class="header-rows">
	<input type="hidden" name="itemstatus-rows" class="itemstatus-rows">
	<input type="hidden" name="purchaseorder-rows" class="purchaseorder-rows">
	<input type="hidden" name="total-rows" class="total-rows">
	<input type="hidden" name="shipments-rows" class="shipments-rows">
	<input type="hidden" name="cols" class="cols">

	<div class="panel panel-default">
		<div class="panel-heading"><h3 class="panel-title"><?php echo $page->title; ?></h3> </div>
		<div class="formatter-container">
			<div>
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#header" aria-controls="header" role="tab" data-toggle="tab">Header</a></li>
					<li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Details</a></li>
					<li role="presentation"><a href="#itemstatus" aria-controls="itemstatus" role="tab" data-toggle="tab">Item Status</a></li>
					<li role="presentation"><a href="#po" aria-controls="po" role="tab" data-toggle="tab">Purchase Order</a></li>
					<li role="presentation"><a href="#total" aria-controls="total" role="tab" data-toggle="tab">Totals</a></li>
					<li role="presentation"><a href="#ship" aria-controls="sjip" role="tab" data-toggle="tab">Ship</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="header">
						<?php $table = 'header'; $columns = $headercolumns; include $config->paths->content."cust-information/screen-formatters/table.php"; ?>

					</div>
					<div role="tabpanel" class="tab-pane" id="details">
						<?php $table = 'detail'; $columns = $detailcolumns;  include $config->paths->content."cust-information/screen-formatters/table.php"; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="itemstatus">
						<?php $table = 'itemstatus'; $columns = $itemstatuscolumns;  include $config->paths->content."cust-information/screen-formatters/table.php"; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="po">
						<?php $table = 'purchaseorder'; $columns = $pocolumns;  include $config->paths->content."cust-information/screen-formatters/table.php"; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="total">
						<?php $table = 'total'; $columns = $totalcolumns;  include $config->paths->content."cust-information/screen-formatters/table.php"; ?>
					</div>
					<div role="tabpanel" class="tab-pane" id="ship">
						<?php $table = 'shipments'; $columns = $shipcolumns;  include $config->paths->content."cust-information/screen-formatters/table.php"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button type="button" class="btn btn-info" onClick="previewtable('#ci-so-form')"><i class="fa fa-table" aria-hidden="true"></i> Preview Table</button>
	<button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Save Configuration</button>
</form>
<script>
	var tabletype = 'sales-orders';
</script>
