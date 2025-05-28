 <?php
						$bh_toppings = $fields['bh'];

						if (isset($bh_toppings) && is_array($bh_toppings)) {
							$visible_toppings_bh = array_slice($bh_toppings, 0, 3);
						} else {
							$visible_toppings_bh = []; 
						}
					?>
 <?php foreach ($visible_toppings_bh as $bh_topping) : ?>
 <?php 
							$term = get_term($bh_topping["topping"], 'service-topping'); 
						?>
 <div data-name="<?= $term->name ?>" data-price="<?= $bh_topping["origin"] ?>"
   class="option-bh flex-col flex  text-sm cursor-pointer " onclick="selectOptionBh(this)">
   <label class="checkbox" style="justify-content: space-between;cursor: pointer;">
     <div class="flex items-center gap-2">
       <input type="checkbox">
       <?= $term->name ?>
     </div>
     <span><?= number_format($bh_topping["origin"], 0, ",", ".") ?> <small>đ</small></span>
   </label>
 </div>
 <?php endforeach; ?>