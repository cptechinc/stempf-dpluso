<?php
    if (!isset($actiontype)) {$actiontype = 'all';}
	if (!isset($partialid)) {$partialid = 'actions';}
    if (!isset($assigneduserID)) {$assigneduserID = $user->loginid;}
    $actionpanel = new UserActionPanel('contact', $actiontype, $partialid, '#ajax-modal', $config->ajax, $config->modal);
    $actionpanel->changeassignedtouserID($assigneduserID);
    $actionpanel->setupcontactpanel($custID, $shipID, $contactID);
    $actionpanel->setuptasks($input->get->text('action-status'));
    $actionpanel->querylinks = UserAction::getlinkarray();

    $actionpanel->querylinks['assignedto'] = $assigneduserID;
    $actionpanel->querylinks['completed'] = $actionpanel->databasetaskstatus();
    $actionpanel->querylinks['customerlink'] = $custID;
    $actionpanel->querylinks['shiptolink'] = $shipID;
    $actionpanel->querylinks['contactlink'] = $contactID;
    if ($actiontype != 'all') {
        $actionpanel->querylinks['actiontype'] = $actiontype;
    }
    $actionpanel->count = getuseractionscount($user->loginid, $actionpanel->querylinks, false);

    if (file_exists($config->paths->content."actions/$config->cptechcustomer-actions-panel.php")) {
        include $config->paths->content."actions/$config->cptechcustomer-actions-panel.php";
    } else {
        include $config->paths->content."actions/actions-panel.php";
    }
