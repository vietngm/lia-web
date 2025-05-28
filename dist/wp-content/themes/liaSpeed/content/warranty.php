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
   <label class="checkbox">
     <input type="checkbox">
     <?= $term->name ?>
   </label>
 </div>
 <?php endforeach; ?>