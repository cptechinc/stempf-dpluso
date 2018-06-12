<?php
	$page->useractionpanelfactory = new UserActionPanelFactory($user->loginid, $page->fullURL);

	switch ($page->name) { //$page->name is what we are editing
		case 'order':
			if ($input->get->ordn) {
				$ordn = $input->get->text('ordn');
				$custID = get_custidfromorder(session_id(), $ordn);
				$editorderdisplay = new EditSalesOrderDisplay(session_id(), $page->fullURL, '#ajax-modal', $ordn);
				$order = $editorderdisplay->get_order();

				if (!$order) {
					$page->title = "Order #" . $ordn . ' failed to load';
					$page->body = '';
				} else {
					$editorderdisplay->canedit = ($input->get->readonly) ? false : $order->can_edit();
					$prefix = ($editorderdisplay->canedit) ? 'Editing' : 'Viewing';
					$page->title = "$prefix Order #" . $ordn . ' for ' . get_customername($custID);
					$config->scripts->append(hashtemplatefile('scripts/edit/card-validate.js'));
					$config->scripts->append(hashtemplatefile('scripts/edit/edit-orders.js'));
					$config->scripts->append(hashtemplatefile('scripts/edit/edit-pricing.js'));
					$config->scripts->append(hashtemplatefile('scripts/edit/quick-entry.js'));
					$page->body = $config->paths->content."edit/orders/outline.php";
					$itemlookup->set_customer($order->custid, $order->shiptoid);
					$itemlookup = $itemlookup->set_ordn($ordn);
				}
				$formconfig = new FormFieldsConfig('sales-order');
			} else {
				throw new Wire404Exception();
			}
			break;
		case 'quote':
			if ($input->get->qnbr) {
				$qnbr = $input->get->text('qnbr');
				$editquotedisplay = new EditQuoteDisplay(session_id(), $page->fullURL, '#ajax-modal', $qnbr);
				$quote = $editquotedisplay->get_quote();
				$editquotedisplay->canedit = $quote->can_edit();
				$prefix = ($editquotedisplay->canedit) ? 'Editing' : 'Viewing';
				$page->title = "$prefix Quote #" . $qnbr . ' for ' . get_customername($quote->custid);
				$page->body = $config->paths->content."edit/quotes/outline.php";
				$config->scripts->append(hashtemplatefile('scripts/edit/edit-quotes.js'));
				$config->scripts->append(hashtemplatefile('scripts/edit/edit-pricing.js'));
				$config->scripts->append(hashtemplatefile('scripts/edit/quick-entry.js'));
				$itemlookup->set_customer($quote->custid, $quote->shiptoid);
				$itemlookup = $itemlookup->set_qnbr($qnbr);
				$formconfig = new FormFieldsConfig('quote');
			} else {
				throw new Wire404Exception();
			}
			break;
		case 'quote-to-order':
			if ($input->get->qnbr) {
				$qnbr = $input->get->text('qnbr');
				$editquotedisplay = new EditQuoteDisplay(session_id(), $page->fullURL, '#ajax-modal', $qnbr);
				$quote = $editquotedisplay->get_quote();
				$editquotedisplay->canedit = $quote->can_edit();
				$page->title = "Creating a Sales Order from Quote #" . $qnbr;
				$page->body = $config->paths->content."edit/quote-to-order/outline.php";
				$config->scripts->append(hashtemplatefile('scripts/edit/edit-quotes.js'));
				$config->scripts->append(hashtemplatefile('scripts/edit/edit-quote-to-order.js'));
				$config->scripts->append(hashtemplatefile('scripts/edit/edit-pricing.js'));
				$config->scripts->append(hashtemplatefile('scripts/edit/quick-entry.js'));
				$itemlookup->set_customer($quote->custid, $quote->shiptoid);
				$itemlookup = $itemlookup->set_qnbr($qnbr);
				$formconfig = new FormFieldsConfig('quote');
			} else {
				throw new Wire404Exception();
			}
			break;
		default:
			throw new Wire404Exception();
			break;
	}
	include ($config->paths->content.'edit/include-edit-page.php');
