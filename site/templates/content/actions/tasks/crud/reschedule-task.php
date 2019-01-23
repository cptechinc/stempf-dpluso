<?php
    $taskID = $input->get->text('id');
    $originaltask = loaduseraction($taskID, true, false);
    $custID = $originaltask->customerlink;
    $shipID = $originaltask->shiptolink;
    $contactID = $originaltask->contactlink;
    $ordn = $originaltask->salesorderlink;
    $qnbr = $originaltask->quotelink;
    $noteID = $originaltask->notelink;
    $taskID = $originaltask->tasklink;
    $actionID = $originaltask->id;
    $task = UserAction::blanktask($custID, $shipID, $contactID, $ordn, $qnbr, $noteID, $taskID, $actionID);

    if ($config->ajax) {
        $message = "Rescheduling a task for {replace} ";
        $modaltitle = createmessage($message, $custID, $shipID, $contactID, $taskID, $noteID, $ordn, $qnbr);
        $modalbody = $config->paths->content."actions/tasks/forms/reschedule-task-form.php";
        include $config->paths->content."common/modals/include-ajax-modal.php";
    } else {
        include $config->paths->content."actions/tasks/forms/reschedule-task-form.php";
    }
