 <?php
						$desire_toppings = $fields['desire'];
						if (isset($desire_toppings) && is_array($desire_toppings)) {
							$visible_toppings = array_slice($desire_toppings, 0, $desire_toppings ? count($desire_toppings) : 0);
						} else {
							$visible_toppings = []; 
						}
					?>
 <?php foreach ($visible_toppings as $desire_topping) : ?>
 <?php 
						$term = get_term($desire_topping["topping"], 'service-topping'); 
						?>
 <div id="mainPageDesire" data-name="<?= $term->name ?>" data-price="<?= $desire_topping["origin"] ?>"
   style="flex-direction:row" class="option-desire flex items-center relative cursor-pointer gap-2"
   onclick="selectOptionDesire(this)">
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