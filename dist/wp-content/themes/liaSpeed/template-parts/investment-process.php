   <?php
   $cacgiaidoandautu = $args['cacgiaidoandautu'];
   ?>
   <?php foreach ($cacgiaidoandautu as $index => $item): ?>
   <ul class="process-content expand-item" id="process-<?php echo $index; ?>">
     <li class="process-item accordion-item">
       <div class="process-item-step"><?= $item['dt_tttd'] ? $item['dt_tttd'] : 'N/A'; ?></div>
       <div class="process-item-content">
         <div class="process-item-title accordion-header">
           <?= $item['dt_tdgd'] ? $item['dt_tdgd'] : 'N/A'; ?><div class="arrow-up">
           </div>
         </div>
         <div class="expand-content">
           <div class="expand-desc process-item-info"><?= $item['dt_mtgd'] ? $item['dt_mtgd'] : 'N/A'; ?></div>
         </div>
       </div>
     </li>
   </ul>
   <?php endforeach; ?>