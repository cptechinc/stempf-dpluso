<?php
    $activetab = 'quotehead';
    if ($input->get->show) { $activetab = $input->get->text('show'); }
    $tabs = array(
        'quotehead' => array('href' => 'quotehead', "id" => 'quotehead-link', 'text' => 'Quote Header', 'tabcontent' => 'edit/quotes/quotehead-form.php'),
        'details' => array('href' => 'details', "id" => 'quotedetail-link', 'text' => 'Quote Details', 'tabcontent' => 'edit/quote-to-order/quote-details/details-page.php')
    );
?>
<?php if (!$editquotedisplay->canedit) : ?>
   <div class="row">
       <div class="col-xs-12"><?php include $config->paths->content.'edit/quotes/read-only-msg.php'; ?></div>
    </div>
<?php endif; ?>

<ul id="order-tab" class="nav nav-tabs nav_tabs">
    <?php foreach ($tabs as $tab) : ?>
        <?php if ($tab == $tabs[$activetab]) : ?>
            <li class="active"><a href="<?= '#'.$tab['href']; ?>" id="<?=$tab['id']; ?>" data-toggle="tab"><?=$tab['text']; ?></a></li>
        <?php else : ?>
            <li><a href="<?= '#'.$tab['href']; ?>" id="<?=$tab['id']; ?>" data-toggle="tab"><?=$tab['text']; ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>

</ul>
<div id="quote-tabs" class="tab-content">
    <?php foreach ($tabs as $tab) : ?>
        <?php if ($tab == $tabs[$activetab]) : ?>
            <div class="tab-pane fade in active" id="<?= $tab['href']; ?>">
                <br>
                <?php include $config->paths->content.$tab['tabcontent']; ?>
            </div>
        <?php else : ?>
            <div class="tab-pane fade" id="<?= $tab['href']; ?>">
                <br>
                <?php include $config->paths->content.$tab['tabcontent']; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<br>
<?php if (!$editquotedisplay->canedit) : ?>
   <a href="<?php echo $editquote['unlock-url']; ?>" class="btn btn-block btn-success save-unlock-order">Finished with quote</a>
   <br>
   <a href="<?php echo $editquote['unlock-url']; ?>" class="btn btn-block btn-warning">Discard Changes, unlock quote</a>
<?php endif; ?>

<?php if ($session->{'edit-detail'}) : ?>
    <script>
        $(function() {
            $('#quotedetail-link').click();
        })
    </script>
    <?php $session->remove('edit-detail'); ?>
<?php endif; ?>
