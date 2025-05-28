 <?php
						$material_toppings = $fields['material'];
						if (isset($material_toppings) && is_array($material_toppings)) {
							$visible_toppings_material = array_slice($material_toppings, 0, $material_toppings ? count($material_toppings) : 0);
						} else {
							$visible_toppings_material = []; 
						}
					?>
 <?php foreach ($visible_toppings_material as $material_topping) : ?>
 <?php 
							$term = get_term($material_topping["topping"], 'service-topping'); 
						?>
 <div data-name="<?= $term->name ?>" data-price="<?= $material_topping["origin"] ?>"
   class="option-material flex-col flex text-sm cursor-pointer" onclick="selectOptionMaterial(this)">
   <div style="overflow:hidden" class="flex items-center gap-2">
     <label class="radio w-full" style="justify-content: space-between;cursor: pointer;">
       <div class="flex items-center gap-2">
         <input type="radio" name="material">
         <?= $term->name; ?>
       </div>
       <span><?= number_format($material_topping["origin"], 0, ",", ".") ?> <small>đ</small></span>
     </label>
   </div>
 </div>
 <?php endforeach; ?>