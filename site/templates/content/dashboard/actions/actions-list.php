<?php
    $actionpanel = $page->useractionpanelfactory->create_actionpanel('user', session_id(), $config->ajax, $config->modal, $input->get->text('action-status'));
    $actionpanel->count_actions();
    
    $salespersonjson = json_decode(file_get_contents($config->companyfiles."json/salespersontbl.json"), true);
	$salespersoncodes = array_keys($salespersonjson['data']);
	$paginator = new Paginator($actionpanel->pagenbr, $actionpanel->count, $actionpanel->generate_refreshurl(true), $actionpanel->generate_insertafter(), false);
    
    echo $page->bootstrap->openandclose('h2', 'class=text-center', $actionpanel->generate_title());
    echo $page->bootstrap->openandclose('h4', 'class=text-right', $actionpanel->generate_pagenumberdescription());
    echo $page->bootstrap->openandclose('div', 'class=table-responsive', $actionpanel->generate_actionstable());
    echo $paginator; 
    
    echo get_useractions($user->loginid, $actionpanel->querylinks, 10, 1, true);
?>
