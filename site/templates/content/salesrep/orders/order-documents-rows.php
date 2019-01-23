<tr class="detail document-header">
    <td colspan="2">Documents</td> <td colspan="2">Document Type</td> <td align="right">Date</td> <td align="right">Time</td>
    <td></td> <td></td> <td></td> <td></td> <td></td>
</tr>
<?php $orderdocs = get_order_docs(session_id(), $order->orderno, false); ?>
<?php foreach ($orderdocs->fetchAll() as $orderdoc) : ?>
	<?php $filename = $orderdoc['pathname']; ?>
	<tr class="detail">
		<td colspan="2"></td>
		<td colspan="2">
			<b><a href="<?= $config->documentstorage.$filename; ?>" title="Click to View Document" target="_blank" ><?= $orderdoc['title']; ?></a></b>
		</td>
		<td align="right"><?= $orderdoc['createdate']; ?></td>
		<td align="right"><?= DplusDateTime::formatdplustime($orderdoc['createtime'], null, DplusDateTime::$shorttimestring); ?></td> <td></td><td></td> <td></td> <td></td> <td></td>
	</tr>
<?php endforeach; ?>
