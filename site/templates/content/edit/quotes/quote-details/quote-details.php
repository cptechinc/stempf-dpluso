<div id="no-more-tables">
    <table class="table-condensed cf order-details table-bordered numeric">
        <thead class="cf">
            <tr>
                <th>Item / Description</th> <th class="numeric text-right" width="90">Price</th> <th class="numeric text-right">Quantity</th> <th class="numeric text-right" width="90">Total</th>
                <th>Whse</th>
                <th>
                	<div class="row">
                    	<div class="col-xs-3">Details</div><div class="col-xs-3">Documents</div> <div class="col-xs-2">Notes</div> <div class="col-xs-4">Edit</div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
       		<?php $quote_details = $editquotedisplay->get_quotedetails($quote); ?>
            <?php foreach ($quote_details as $detail) : ?>
                <tr>
                    <td data-title="Item">
                        <?php if ($detail->errormsg != '') : ?>
                            <div class="btn-sm btn-danger">
                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Error!</strong> <?= $detail->errormsg; ?>
                            </div>
                        <?php else : ?>
                            <?= $detail->itemid; ?>
                            <?php if (strlen($detail->vendoritemid)) { echo ' '.$detail->vendoritemid;} ?>
                            <br> <?= $detail->desc1; ?>
    					<?php endif; ?>
                    </td>
                    <td data-title="Price" class="text-right">$ <?= formatMoney($detail->quotprice); ?></td>
                    <td data-title="Ordered" class="text-right"><?= $detail->quotqty + 0; ?></td>
                    <td data-title="Total" class="text-right">$ <?= formatMoney($detail->quotprice * $detail->quotqty); ?></td>
                    <td data-title="Warehouse"><?= $detail->whse; ?></td>
                    <td class="action">
                        <div class="row">
                            <div class="col-xs-3">
                                <span class="visible-xs-block action-label">Details</span>
                                <?= $editquotedisplay->generate_viewdetaillink($quote, $detail); ?>
                            </div>
                            <div class="col-xs-3">
                                <span class="visible-xs-block action-label">Documents</span> <?= $editquotedisplay->generate_loaddocumentslink($quote, $detail); ?></div>
                            <div class="col-xs-2">
                                <span class="visible-xs-block action-label">Notes</span> <?= $editquotedisplay->generate_loaddplusnoteslink($quote, $detail->linenbr); ?></div>
                            <div class="col-xs-4"> 
                                <span class="visible-xs-block action-label">Update</span>
                                <?= $editquotedisplay->generate_detailvieweditlink($quote, $detail); ?>
                                &nbsp;
                                <?= $editquotedisplay->generate_deletedetailform($quote, $detail); ?>
                            </div>
                        </div>
                    </td>
                </tr>
			<?php endforeach; ?>
        </tbody>
    </table>
</div>
