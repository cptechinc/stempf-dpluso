<table class="table table-striped table-bordered table-condensed" id="quotes-table">
	<thead>
       <?php include $config->paths->content.'customer/cust-page/quotes/quotes-thead-rows.php'; ?>
    </thead>
	<tbody>
		<?php if (isset($input->get->qnbr)) : ?>
			<?php if ($quotepanel->count == 0 && $input->get->text('qnbr') == '') : ?>
				<tr> <td colspan="9" class="text-center">No Quotes found! Try using a date range to find the quotes(s) you are looking for.</td> </tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php $quotepanel->get_quotes(); ?>
		<?php foreach ($quotepanel->quotes as $quote) : ?>
			<tr class="<?= $quotepanel->generate_rowclass($quote); ?>" id="<?= $quote->quotnbr; ?>">
				<td class="text-center">
					<?= $quotepanel->generate_expandorcollapselink($quote); ?>
				</td>
				<td><?= $quote->quotnbr; ?></td>
				<td><?= $quote->shiptoid; ?></td>
				<td><?= $quote->sp1name; ?></td>
				<td><?= $quote->quotdate; ?></td>
				<td><?= $quote->revdate; ?></td>
				<td><?= $quote->expdate; ?></td>
				<td class="text-right">$ <?= $quote->subtotal; ?></td>
				<td><?= $quotepanel->generate_loaddplusnoteslink($quote, '0'); ?></td>
				<td><?= $quotepanel->generate_editlink($quote); ?></td>
			</tr>

			<?php if ($quote->quotnbr == $input->get->text('qnbr')) : ?>
				<?php if ($quote->error == 'Y') : ?>
	                <tr class="detail bg-danger" >
	                    <td></td>
	                    <td colspan="3"><b>Error: </b><?= $quote->errormsg; ?></td>
	                    <td></td>
	                    <td></td>
						<td></td>
						<td></td>
	                </tr>
	            <?php endif; ?>
				<?php include $config->paths->content."customer/cust-page/quotes/quote-detail-rows.php"; ?>
				<?php include $config->paths->content."customer/cust-page/quotes/quote-totals.php"; ?>
				<tr class="detail last-detail">
					<td></td>
					<td> <?= $quotepanel->generate_viewprintlink($quote); ?> </td>
					<td> <?= $quotepanel->generate_orderquotelink($quote); ?> </td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><a href="<?= $quotepanel->generate_closedetailsurl(); ?>" class="btn btn-sm btn-danger load-link" <?= $quotepanel->ajaxdata; ?>>Close</a></td>
					<td></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</tbody>
</table>
