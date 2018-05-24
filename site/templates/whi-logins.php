<?php
    include $config->paths->vendor.'cptechinc/dpluso-processwire-classes/src/helpers/FileUploader.class.php';

    if ($input->requestMethod() == 'POST') {
        $action = $input->post->text('action');

        switch ($action) {
            case 'import-logins-csv':
                $page->body = $config->paths->siteModules."StempfWhiLoginManager/content/import-logins-csv.php";
                break;
        }
    } else {
        $page->body = $config->paths->siteModules."StempfWhiLoginManager/content/view-logins.php";
    }

    if ($config->modal && $config->ajax) {
        include $config->paths->content.'common/modals/include-ajax-modal.php';
    } elseif ($config->ajax) {
        include $page->body;
    } elseif ($config->json) {
        include $page->body;
    } else {
        include $config->paths->content."common/include-page.php";
    }
