<tr class="detail">
    <th colspan="2" class="text-center">Item ID</th>
    <th colspan="2">Description</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Ext Price</th>
    <th>Notes</th>
    <th></th>
    <th></th>
</tr>

<?php $details = $quotepanel->get_quotedetails($quote); ?>

<?php foreach ($details as $detail) : ?>
    <tr class="detail">
        <td colspan="2" class="text-center">
            <?= $quotepanel->generate_detailvieweditlink($quote, $detail); ?>
        </td>
        <td colspan="2">
            <?php if (strlen($detail->vendoritemid)) { echo ' '.$detail->vendoritemid."<br>";} ?>
            <?= $detail->desc1; ?>
        </td>
        <td class="text-right">$ <?= formatmoney($detail->quotprice); ?></td>
        <td class="text-right"><?= intval($detail->quotqty); ?></td>
        <td class="text-right">$ <?= formatmoney($detail->quotprice * $detail->quotqty); ?></td>
        <td></td>
        <td><?= $quotepanel->generate_loaddplusnoteslink($quote, $detail->linenbr); ?></td>
        <td></td>
    </tr>
<?php endforeach; ?>
