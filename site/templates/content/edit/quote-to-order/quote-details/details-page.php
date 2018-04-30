<div id="sales-order-details">
	<form action="<?= $config->pages->quotes.'redir/'; ?>" method="post" id="select-items-form" onsubmit="validate_selection()">
		<input type="hidden" name="action" value="send-quote-to-order">
		<input type="hidden" name="qnbr" value="<?= $qnbr; ?>">
		<div class="form-group"><?php include $config->paths->content.'edit/quote-to-order/quote-details/quote-details.php'; ?></div>
		<div class="row">
			<div class="col-xs-6 col-sm-7"></div>
		    <div class="col-xs-6 col-sm-5">
		    	<table class="table-condensed table table-striped">
		        	<tr>
		        		<td>Subtotal</td>
		        		<td class="text-right">$ <?php echo formatmoney($quote->subtotal); ?></td>
		        	</tr>
		        	<tr>
		        		<td>Tax</td>
		        		<td class="text-right">$ <?php echo formatmoney($quote->salestax); ?></td>
		        	</tr>
		        	<tr>
		        		<td>Freight</td>
		        		<td class="text-right">$ <?php echo formatmoney($quote->freight); ?></td>
		        	</tr>
		        	<tr>
		        		<td>Misc.</td>
		        		<td class="text-right">$ <?php echo formatmoney($quote->misccost); ?></td>
		        	</tr>
		        	<tr>
		        		<td>Total</td>
		        		<td class="text-right">$ <?php echo formatmoney($quote->ordertotal); ?></td>
		        	</tr>
		        </table>
		    </div>
		</div>
		<button type="submit" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Push Items To Order</button>
	</form>
</div>
