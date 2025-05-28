 <?php
						$toppings_5 = $fields['topping_5'];
						if (isset($toppings_5) && is_array($toppings_5)) {
							$visible_toppings = array_slice($toppings_5, 0, $toppings_5 ? count($toppings_5) : 0);
						} else {
							$visible_toppings = []; 
						}
					?>
 <?php foreach ($visible_toppings as $desire_topping) : ?>
 <?php 
						$term = get_term($desire_topping["topping"], 'service-topping'); 
						?>
 <div id="mainPageTopping5" data-name="<?= $term->name ?>" data-price="<?= $desire_topping["origin"] ?>"
   style="flex-direction:row;display:grid;width:100%;"
   class="option-tp5 flex items-center relative cursor-pointer gap-2" onclick="selectOptionTp5(this)">
   <div style="overflow:hidden" class="flex items-center gap-2">
     <label class="radio w-full" style="justify-content: space-between;cursor: pointer;">
       <div class="flex items-center gap-2">
         <input type="radio" name="desire">
         <?= $term->name ?>
       </div>
       <span><?= number_format($desire_topping["origin"], 0, ",", ".") ?> <small>đ</small></span>
     </label>
   </div>
 </div>
 <?php endforeach; ?>