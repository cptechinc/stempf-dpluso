<?php
	$orderpanel = new CustomerSalesOrderPanel(session_id(), $page->fullURL, '#ajax-modal', '#orders-panel', $config->ajax);
	$orderpanel->set_customer($custID, $shipID);
	$orderpanel->pagenbr = $input->pageNum;
	$orderpanel->activeID = !empty($input->get->ordn) ? $input->get->text('ordn') : false;
	$orderpanel->generate_filter($input);
	$orderpanel->get_ordercount();
	
	$paginator = new Paginator($orderpanel->pagenbr, $orderpanel->count, $orderpanel->pageurl->getUrl(), $orderpanel->paginationinsertafter, $orderpanel->ajaxdata);
?>
<div class="panel panel-primary not-round" id="orders-panel">
    <div class="panel-heading not-round" id="orders-panel-heading">
    	<?php if ($input->get->filter) : ?>
        	<a href="#orders-div" data-parent="#orders-panel" data-toggle="collapse">
				<?= $orderpanel->generate_filterdescription(); ?> <span class="caret"></span> <span class="badge"><?= $orderpanel->count; ?></span> &nbsp; | &nbsp;
            </a> 
			<?= $orderpanel->generate_refreshlink(); ?>
    	<?php elseif ($orderpanel->count > 0) : ?>
            <a href="#orders-div" data-parent="#orders-panel" data-toggle="collapse">Customer Orders <span class="caret"></span></a> <span class="badge"> <?= $orderpanel->count; ?></span> &nbsp; | &nbsp;
            <?= $orderpanel->generate_refreshlink(); ?>
		<?php elseif (isset($input->get->ordn)) : ?>
			<a href="#orders-div" data-parent="#orders-panel" data-toggle="collapse">Customer Orders <span class="caret"></span></a> <span class="badge"> <?= $orderpanel->count; ?></span> &nbsp; | &nbsp;
			<?= $orderpanel->generate_refreshlink(); ?>
        <?php else : ?>
        	<?= $orderpanel->generate_loadlink(); ?>
        <?php endif; ?>
		&nbsp; &nbsp;
		<?= $orderpanel->generate_lastloadeddescription(); ?>
        <span class="pull-right"><?= $orderpanel->generate_pagenumberdescription(); ?></span>
    </div>
    <div id="orders-div" class="<?= $orderpanel->collapse; ?>">
        <div class="panel-body">
        	<div class="row">
                <div class="col-sm-6">
					<?= $paginator->generate_showonpage(); ?>
                </div>
                <div class="col-sm-6">
					<button class="btn btn-primary toggle-order-search pull-right" type="button" data-toggle="collapse" data-target="#cust-orders-search-div" aria-expanded="false" aria-controls="cust-orders-search-div">Toggle Search <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
			<div id="cust-orders-search-div" class="<?= (empty($orderpanel->filters)) ? 'collapse' : ''; ?>">
				<?php include $config->paths->content.'customer/cust-page/sales-orders/search-form.php'; ?>
			</div>
        </div>
        <div class="table-responsive">
            <?php include $config->paths->content.'customer/cust-page/sales-orders/table.php'; ?>
			<?= $paginator; ?>
        </div>
    </div>
</div>
