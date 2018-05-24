<?php
    if ($input->requestMethod() == 'POST') {
        $action = $input->post->text('action');

        switch ($action) {
            case 'edit-login':
                break;
        }
    } else {
        $page->body = $config->paths->siteModules."StempfWhiLoginManager/content/view-login.php";
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
