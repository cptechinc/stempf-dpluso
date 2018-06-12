<legend>Ship-To <?= $quote->shiptoid; ?></legend>
<table class="table table-striped table-bordered table-condensed">
	<tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shiptoid']['label']; ?><?= $formconfig->generate_asterisk('shiptoid'); ?><input type="hidden" id="shipto-id" value="<?= $quote->shiptoid; ?>"></td>
        <td>
        	<select class="form-control input-sm ordrhed <?= $formconfig->generate_showrequiredclass('shiptoid'); ?> shipto-select" name="shiptoid" data-custid="<?= $quote->custid; ?>">
				<?php $shiptos = get_customershiptos($quote->custid); ?>
                <?php foreach ($shiptos as $shipto) : ?>
					<?php $selected =  ($shipto->shiptoid == $quote->shiptoid) ? 'selected' : ''; ?>
                    <option value="<?= $shipto->shiptoid;?>" <?= $selected; ?>><?= $shipto->shiptoid.' - '.$shipto->name; ?></option>
                <?php endforeach; ?>
                <option value="">Drop Ship To </option>
            </select>
        </td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipname']['label']; ?><?= $formconfig->generate_asterisk('shipname'); ?></td>
    	<td><input type="text" class="form-control input-sm ordrhed <?= $formconfig->generate_showrequiredclass('shipname'); ?> shipto-name" name="shiptoname" value="<?= $quote->shipname; ?>"></td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipaddress']['label']; ?><?= $formconfig->generate_asterisk('shipaddress'); ?></td>
    	<td><input type="text" class="form-control input-sm ordrhed <?= $formconfig->generate_showrequiredclass('shipaddress'); ?> shipto-address" name="shipto-address" value="<?= $quote->shipaddress; ?>"></td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipaddress2']['label']; ?><?= $formconfig->generate_asterisk('shipaddress2'); ?></td>
    	<td><input type="text" class="form-control input-sm ordrhed <?= $formconfig->generate_showrequiredclass('shipaddress2'); ?> shipto-address2" name="shipto-address2" value="<?= $quote->shipaddress2; ?>"></td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipcity']['label']; ?><?= $formconfig->generate_asterisk('shipcity'); ?></td>
    	<td><input type="text" class="form-control input-sm <?= $formconfig->generate_showrequiredclass('shipcity'); ?> shipto-city " name="shipto-city" value="<?= $quote->shipcity; ?>"></td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipstate']['label']; ?><?= $formconfig->generate_asterisk('shipstate'); ?></td>
    	<td>
        	<select class="form-control input-sm <?= $formconfig->generate_showrequiredclass('shipstate'); ?> shipto-state" name="shipto-state">
            <option value="">---</option>
				<?php $states = getstates(); ?>
                <?php foreach ($states as $state) : ?>
					<?php $selected = ($state['state'] == $quote->shipstate) ? 'selected' : ''; ?>
                    <option value="<?= $state['state']; ?>" <?= $selected; ?>><?= $state['state'] . ' - ' . $state['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
    	<td class="control-label"><?= $formconfig->fields['fields']['shipzip']['label']; ?><?= $formconfig->generate_asterisk('shipzip'); ?></td>
    	<td><input type="text" class="form-control input-sm <?= $formconfig->generate_showrequiredclass('shipzip'); ?> shipto-zip" name="shipto-zip" value="<?= $quote->shipzip; ?>"></td>
    </tr>
	<tr>
		<td class="control-label">Country</td>
		<td>
			<?php $countries = getcountries(); if (empty($quote->shipcountry)) {$quote->set('shipcountry', 'USA');}?>
			<select name="shipto-country" class="form-control input-sm">
				<?php foreach ($countries as $country) : ?>
					<?php $selected = ($country['ccode'] == $quote->shipcountry) ? 'selected' : ''; ?>
					<option value="<?= $country['ccode']; ?>" <?= $selected; ?>><?= $country['name']; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
</table>
