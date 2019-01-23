<table class="table table-bordered table-striped">
    <tr>
        <td>Written on:</td> <td><?php echo date('m/d/Y g:i A', strtotime($note->datecreated)); ?></td>
    </tr>
    <tr>
        <td>Written by:</td> <td><?php echo $note->writtenby; ?></td>
    </tr>
    <tr>
        <td>Customer:</td>
        <td><?php echo get_customer_name($note->customerlink); ?> <a href="<?php echo $note->generatecustomerurl(); ?>"><i class="glyphicon glyphicon-share"></i> Go to Customer Page</a></td>
    </tr>
    <?php if ($note->hasshiptolink) : ?>
        <tr>
            <td>Ship-to:</td>
            <td><?php echo get_shipto_name($note->customerlink, $note->shiptolink, false); ?> <a href="<?php echo $note->generateshiptourl(); ?>"><i class="glyphicon glyphicon-share"></i> Go to Ship-to Page</a></td>
        </tr>
    <?php endif; ?>
    <?php if ($note->hascontactlink) : ?>
        <tr>
            <td>Contact:</td>
            <td><?php echo $note->contactlink; ?> <a href="<?php echo $note->generatecontacturl(); ?>"><i class="glyphicon glyphicon-share"></i> Go to Contact Page</a></td>
        </tr>
    <?php endif; ?>
    <?php if ($note->hasorderlink) : ?>
        <tr>
            <td>Sales Order #:</td>
            <td><?php echo $note->salesorderlink; ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($note->hasquotelink) : ?>
        <tr>
            <td>Quote #:</td>
            <td><?php echo $note->quotelink; ?></td>
        </tr>
    <?php endif; ?>
    <?php if ($note->hastasklink) : ?>
        <tr>
            <td>Task #:</td>
            <td><?php echo $note->salestasklink; ?></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="2"><b>Notes</b><br><?php echo $note->textbody; ?></td>
    </tr>
</table>
