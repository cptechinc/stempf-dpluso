<?php
    $config->scripts->append(hashtemplatefile('scripts/libs/datatables.js'));
    $config->scripts->append(hashtemplatefile('scripts/pages/dashboard.js'));
	$config->scripts->append(hashtemplatefile('scripts/libs/raphael.js'));
	$config->scripts->append(hashtemplatefile('scripts/libs/morris.js'));
    $page->useractionpanelfactory = new UserActionPanelFactory($user->loginid, $page->fullURL);
    $page->body = $config->paths->content.'dashboard/dashboard-page-outline.php'; 
    
    include $config->paths->content."common/include-page.php";
