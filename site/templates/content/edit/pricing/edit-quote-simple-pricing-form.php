<?php if ($config->ajax) : ?>
	<p> <a href="<?php echo $config->filename; ?>" target="_blank"><i class="glyphicon glyphicon-print" aria-hidden="true"></i> View Printable Version</a> </p>
<?php endif; ?>
<form action="<?php echo $formaction; ?>" method="post" id="<?= $linedetail['itemid'].'-form'; ?>">
    <input type="hidden" name="action" value="update-line">
    <input type="hidden" name="qnbr" value="<?= $qnbr; ?>">
    <input type="hidden" class="listprice" value="<?= formatmoney($linedetail['listprice']); ?> ">
    <input type="hidden" class="linenumber" name="linenbr" value="<?= $linedetail['linenbr']; ?> ">
    <input type="hidden" class="originalprice" value="<?= formatmoney($linedetail['quotprice']); ?> ">
    <input type="hidden" class="discountprice" value="<?= formatmoney($linedetail['quotprice']); ?> ">
    <input type="hidden" class="cost" value="<?= formatmoney($linedetail['quotcost']); ?> ">
    <input type="hidden" class="calculate-from" value="percent">
    <?php if ($soconfig['config']['use_discount'] != 'Y'): ?>
        <input type="hidden" class="discpct" name="discount" value="<?= formatmoney($linedetail['discpct']); ?>">
    <?php endif; ?>
  
  	
  	<?php if (1000 == 1) : ?>
  		<?php if ($linedetail['can-edit']) :?>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    <?php endif; ?>
  	<?php endif; ?>
  	
</form>

