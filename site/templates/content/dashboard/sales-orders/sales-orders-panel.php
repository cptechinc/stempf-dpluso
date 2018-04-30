<?php
	$orderpanel = new SalesOrderPanel(session_id(), $page->fullURL, '#ajax-modal', '#orders-panel', $config->ajax);
	$orderpanel->pagenbr = $input->pageNum;
	$orderpanel->activeID = !empty($input->get->ordn) ? $input->get->text('ordn') : false;
	$orderpanel->generate_filter($input);
	$orderpanel->get_ordercount();

	$paginator = new Paginator($orderpanel->pagenbr, $orderpanel->count, $orderpanel->pageurl->getUrl(), $orderpanel->paginationinsertafter, $orderpanel->ajaxdata);
?>
<div class="panel panel-primary not-round" id="orders-panel">
	<div class="panel-heading not-round" id="order-panel-heading">
		<?php if (!empty($orderpanel->filters)) : ?>
			<a href="#orders-div" data-parent="#orders-panel" data-toggle="collapse">
				<?= $orderpanel->generate_filterdescription(); ?> <span class="caret"></span> <span class="badge"><?= $orderpanel->count; ?></span> &nbsp; | &nbsp;
				<?= $orderpanel->generate_refreshlink(); ?>
				</a>
		<?php elseif ($orderpanel->count > 0) : ?>
				<a href="#orders-div" data-parent="#orders-panel" data-toggle="collapse">Your Orders <span class="caret"></span></a> &nbsp; <span class="badge"> <?= $orderpanel->count; ?></span> &nbsp; | &nbsp;
				<?= $orderpanel->generate_refreshlink(); ?>
		<?php else : ?>
			<?= $orderpanel->generate_loadlink(); ?>
		<?php endif; ?>
		&nbsp; &nbsp;
		<?= $orderpanel->generate_lastloadeddescription(); ?>
		<span class="pull-right"><?= $orderpanel->generate_pagenumberdescription(); ?> </span>
	</div>
	<div id="orders-div" class="<?= $orderpanel->collapse; ?>">
		<div class="panel-body">
			<div class="row">
				<div class="col-sm-6">
					<?= $paginator->generate_showonpage(); ?>
				</div>
				<div class="col-sm-6">
					<button class="btn btn-primary toggle-order-search pull-right" type="button" data-toggle="collapse" data-target="#orders-search-div" aria-expanded="false" aria-controls="orders-search-div">Toggle Search <i class="fa fa-search" aria-hidden="true"></i></button>
				</div>
			</div>
			<div id="orders-search-div" class="<?= (empty($orderpanel->filters)) ? 'collapse' : ''; ?>">
				<?php include $config->paths->content.'dashboard/sales-orders/search-form.php'; ?>
			</div>
		</div>
		<div class="table-responsive">
			<?php include $config->paths->content.'dashboard/sales-orders/table.php'; ?>
			<?= $paginator; ?>
		</div>
	</div>
</div>
