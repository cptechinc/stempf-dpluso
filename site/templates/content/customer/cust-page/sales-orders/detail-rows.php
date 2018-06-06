<tr class="detail item-header">
    <th></th>
    <th colspan="3" class="text-center">Item ID/Description</th>
    <th class="text-right">Ordered</th>
    <th class="text-right" width="100">Total</th>
    <th class="text-right">Back Order</th>
    <th class="text-right">Shipped</th>
    <th>Notes</th>
    <th>Reorder</th>
    <th>Documents</th>
</tr>
<?php $details = $orderpanel->get_orderdetails($order); ?>
<?php foreach ($details as $detail) : ?>
    <tr class="detail">
        <td></td>
        <td colspan="3">
            <?= $orderpanel->generate_detailvieweditlink($order, $detail); ?>
            <?= strlen($detail->vendoritemid) ? "($detail->vendoritemid)" : ''; ?> <br>
            <?= $detail->desc1. ' ' . $detail->desc2 ; ?>
        </td>
        <td class="text-right"><?= intval($detail->qty); ?></td>
        <td class="text-right">
            <span class="has-hover" data-toggle="tooltip" data-placement="top" title="<?= 'Price / UoM: $'.$page->stringerbell->format_money($detail->price); ?>">
				$ <?= $page->stringerbell->format_money($detail->totalprice); ?>
			</span>
        </td>
        <td class="text-right"><?= intval($detail->qtybackord); ?></td>
        <td class="text-right"><?= intval($detail->qtyshipped); ?></td>
        <td><?= $orderpanel->generate_loaddplusnoteslink($order, $detail->linenbr); ?></td>
        <td><?= $orderpanel->generate_detailreorderform($order, $detail); ?></td>
        <td><div><?= $orderpanel->generate_loaddocumentslink($order, $detail); ?></div></td>
    </tr>
    <?php if ($input->get->text('item-document')) : ?>
        <?php if ($input->get->text('item-document') == $detail->itemid) : ?>
            <?php $itemdocs = get_item_docs(session_id(), $order->orderno, $detail->itemid, false); ?>
            <?php foreach ($itemdocs->fetchAll() as $itemdoc) : ?>
                <tr class="docs">
                    <td colspan="2"></td>
                    <td>
                        <b><a href="<?= $config->pathtofiles.$itemdoc['pathname'];; ?>" title="Click to View Document" target="_blank" ><?php echo $itemdoc['title']; ?></a></b>
                    </td>
                    <td align="right"><?= $itemdoc['createdate']; ?></td>
                    <td align="right"><?= DplusDateTime::format_dplustime($itemdoc['createtime']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
