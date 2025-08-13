   <?php
   $cachinhthucdautu = $args['cachinhthucdautu'];
   ?>
   <div class="tab-buttons">
     <?php foreach ($cachinhthucdautu as $index => $item): ?>
     <button class="tab-btn<?php echo $index === 0 ? ' active' : ''; ?>" data-tab="tab-<?php echo $index; ?>">
       <?php echo $item['ten_hinh_thuc']; ?>
     </button>
     <?php endforeach; ?>
   </div>

   <?php foreach ($cachinhthucdautu as $index => $item): ?>
   <ul class="tab-content<?php echo $index === 0 ? ' active' : ''; ?>" id="tab-<?php echo $index; ?>">
     <li class="tab-item">
       <div class="tab-item-value"><?php echo $item['dt_pth_tg']; ?></div>
       <div class="tab-item-title"><?php echo $item['dt_pth']; ?></div>
     </li>
     <li class="tab-item">
       <div class="tab-item-value"><?php echo $item['dt_pnq_tg']; ?></div>
       <div class="tab-item-title"><?php echo $item['dt_pnq']; ?></div>
     </li>
     <li class="tab-item">
       <div class="tab-item-value"><?php echo $item['dt_pql_tg']; ?></div>
       <div class="tab-item-title"><?php echo $item['dt_pql']; ?></div>
     </li>
     <li class="tab-item">
       <div class="tab-item-value"><?php echo $item['dt_truyen_thong_tg']; ?></div>
       <div class="tab-item-title"><?php echo $item['dt_truyen_thong']; ?></div>
     </li>
   </ul>
   <?php endforeach; ?>