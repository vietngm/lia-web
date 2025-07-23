<?php
$bh_toppings = $fields['bh'];
if (isset($bh_toppings) && is_array($bh_toppings)) {
  $visible_toppings_bh = array_slice($bh_toppings, 0, $bh_toppings ? count($bh_toppings):0);
} else {
  $visible_toppings_bh = []; 
}
foreach ($visible_toppings_bh as $bh_topping) : ?>
<?php 
  $term = get_term($bh_topping["topping"], 'service-topping'); 
?>
<div class="option-bh flex-col flex  text-sm cursor-pointer" data-price="<?= $bh_topping["origin"] ?>"
  onclick="selectOptionBh(this)">
  <label class="radio w-full" style="justify-content: space-between;cursor: pointer;">
    <div class="flex items-center gap-2">
      <input type="radio" name="bh"><?= $term->name ?>
    </div>
    <span><?= number_format( $bh_topping["origin"], 0, ",", ".") ?>đ</span>
  </label>
</div>
<?php endforeach; ?>