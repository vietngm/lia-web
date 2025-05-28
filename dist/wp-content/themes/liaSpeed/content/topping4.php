 <?php
						$toppings_4 = $fields['topping_4'];
						if (isset($toppings_4) && is_array($toppings_4)) {
							$visible_toppings = array_slice($toppings_4, 0, $toppings_4 ? count($toppings_4) : 0);
						} else {
							$visible_toppings = []; 
						}
					?>
 <?php foreach ($visible_toppings as $desire_topping) : ?>
 <?php 
						$term = get_term($desire_topping["topping"], 'service-topping'); 
						?>
 <div id="mainPageTopping4" data-name="<?= $term->name ?>" data-price="<?= $desire_topping["origin"] ?>"
   style="flex-direction:row;display:grid;width:100%;"
   class="option-tp4 flex items-center relative cursor-pointer gap-2" onclick="selectOptionTp4(this)">
   <div style="overflow:hidden" class="flex items-center gap-2">
     <label class="radio w-full" style="justify-content: space-between;cursor: pointer;">
       <div class="flex items-center gap-2">
         <input type="radio" name="optionTp4">
         <?= $term->name ?>
       </div>
       <span><?= number_format($desire_topping["origin"], 0, ",", ".") ?> <small>đ</small></span>
     </label>
   </div>
 </div>
 <?php endforeach; ?>