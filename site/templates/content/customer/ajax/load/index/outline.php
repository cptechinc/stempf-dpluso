<?php
	if ($input->urlSegment2) {
        $custID = $input->urlSegment2;
        $customer = get_customer_info(session_id(), $custID, false);
        $page->title = 'Select a '.$customer['name'].' Ship-to';
        if ($session->custID) {
            $page->title= "Currently shopping for " . $session->custID;
            if ($session->shipID) {
                $page->title.= " Ship-to: " . $session->shipID;
            }
        }
        $shiptos = getcustomershiptos($custID, $user->loginid, $user->hascontactrestrictions, false);
		$page->body = $config->paths->content."customer/ajax/load/index/customer-list.php";
    } else {
        $count = 1;
        if ($input->get->q) {
            $customer_records = search_custindex_keyword_paged($user->loginid, $config->showonpage, $input->pageNum, $user->hascontactrestrictions, $input->get->text('q'),  false);

            $page->title= "Searching for '".$input->get->text('q')."'";
            $sourcepage = $input->get->text('source');
			$page->body = $config->paths->content."customer/ajax/load/index/customer-list.php";
        } else {
            if ($session->custID) {
                $page->title= "Currently shopping for " . $session->custID;
                if ($session->shipID) {
                    $page->title.= " Ship-to: " . $session->shipID;
                }
            } else {
				$page->title= 'Search for a customer';
			}
			if ($input->get->function) {
				$page->title= 'Search for a customer';
			}
			$page->body = $config->paths->content."customer/ajax/load/index/search-index-form.php";
        }
    }

	$source = $input->get->text('source');
	$function = $input->get->text('function');
	include $page->body;

?>
