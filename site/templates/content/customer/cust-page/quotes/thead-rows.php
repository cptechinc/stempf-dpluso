<tr>
   <th>Detail</th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("quotnbr") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Quote # <?= $quotepanel->tablesorter->generate_sortsymbol('quotnbr'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("shiptoid") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Ship-to <?= $quotepanel->tablesorter->generate_sortsymbol('shiptoid'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("sp1name") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Sales Rep <?= $quotepanel->tablesorter->generate_sortsymbol('sp1name'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("quotdate") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Quote Date <?= $quotepanel->tablesorter->generate_sortsymbol('quotdate'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("revdate") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Review Date <?= $quotepanel->tablesorter->generate_sortsymbol('revdate'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("expdate") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Expire Date <?= $quotepanel->tablesorter->generate_sortsymbol('expdate'); ?>
       </a>
   </th>
   <th>
       <a href="<?= $quotepanel->generate_tablesortbyurl("subtotal") ; ?>" class="load-link" <?= $quotepanel->ajaxdata; ?>>
           Quote Total <?= $quotepanel->tablesorter->generate_sortsymbol('subtotal'); ?>
       </a>
   </th>
   <th colspan="2">
       <?= $quotepanel->generate_iconlegend(); ?>
       <?php if (isset($input->get->orderby)) : ?>
           <?= $quotepanel->generate_clearsortlink(); ?>
       <?php endif; ?>
   </th>
</tr>
