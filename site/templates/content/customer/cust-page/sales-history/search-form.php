<form action="<?= $orderpanel->pageurl->getUrl(); ?>" method="get" data-ordertype="sales-orders" data-loadinto="#cust-sales-history-panel" data-focus="#cust-sales-history-panel" data-modal="#ajax-modal" class="orders-search-form allow-enterkey-submit">
	<input type="hidden" name="filter" value="filter">

	<div class="row">
		<div class="col-sm-2">
			<h4>Order #</h4>
			<input class="form-control form-group inline input-sm" type="text" name="orderno[]" value="<?= $orderpanel->get_filtervalue('orderno'); ?>" placeholder="From Order #">
			<input class="form-control form-group inline input-sm" type="text" name="orderno[]" value="<?= $orderpanel->get_filtervalue('orderno', 1); ?>" placeholder="Through Order #">
		</div>
        <div class="col-sm-2">
			<h4>Cust PO</h4>
			<input class="form-control inline input-sm" type="text" name="custpo[]" value="<?= $orderpanel->get_filtervalue('custpo'); ?>" placeholder="Cust PO">
		</div>
		<div class="col-sm-2">
			<h4>Order Total</h4>
			<div class="input-group form-group">
				<input class="form-control form-group inline input-sm" type="text" name="ordertotal[]" id="order-total-min" value="<?= $orderpanel->get_filtervalue('ordertotal'); ?>" placeholder="From Order Total">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default btn-sm not-round" onclick="$('#order-total-min').val('<?= get_minsaleshistoryordertotal(session_id(), $custID, $shipID); ?>')"> <span class="fa fa-angle-double-down" aria-hidden="true"></span> <span class="sr-only">Min</span> </button>
				</span>
			</div>
			<div class="input-group form-group">
				<input class="form-control form-group inline input-sm" type="text" name="ordertotal[]" id="order-total-max" value="<?= $orderpanel->get_filtervalue('ordertotal', 1); ?>" placeholder="Through Order Total">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default btn-sm not-round" onclick="$('#order-total-max').val('<?= get_maxsaleshistoryordertotal(session_id(), $custID, $shipID); ?>')"> <span class="fa fa-angle-double-up" aria-hidden="true"></span> <span class="sr-only">Max</span> </button>
				</span>
			</div>
		</div>
		<div class="col-sm-2">
			<h4>Order Date</h4>
			<?php $name = 'orderdate[]'; $value = $orderpanel->get_filtervalue('orderdate'); ?>
			<?php include $config->paths->content."common/date-picker.php"; ?>
			<label class="small text-muted">From Date </label>

			<?php $name = 'orderdate[]'; $value = $orderpanel->get_filtervalue('orderdate', 1); ?>
			<?php include $config->paths->content."common/date-picker.php"; ?>
			<label class="small text-muted">Through Date </label>
		</div>
		<div class="col-sm-2">
			<h4>Invoice Date</h4>
			<?php $name = 'invdate[]'; $value = $orderpanel->get_filtervalue('invdate'); ?>
			<?php include $config->paths->content."common/date-picker.php"; ?>
			<label class="small text-muted">From Date </label>

			<?php $name = 'invdate[]'; $value = $orderpanel->get_filtervalue('invdate', 1); ?>
			<?php include $config->paths->content."common/date-picker.php"; ?>
			<label class="small text-muted">Through Date </label>
		</div>
	</div>
	</br>
	<div class="form-group">
		<button class="btn btn-success btn-block" type="submit">Search <i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
	<?php if ($input->get->filter) : ?>
		 <div>
			<?= $orderpanel->generate_clearsearchlink(); ?>
		 </div>
	 <?php endif; ?>
</form>
