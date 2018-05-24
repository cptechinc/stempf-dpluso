<?php
    if ($config->modal && $config->ajax) {
        include $config->paths->content.'common/modals/include-ajax-modal.php';
    } elseif ($config->ajax) {
        include $page->body;
    } elseif ($config->json) {
        include $page->body;
    } else {
        include $config->paths->content."common/include-blank-page.php";
    }
