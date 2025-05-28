 <head>
   <style>
   .topping-row::-webkit-scrollbar {
     display: none;
   }
   </style>
 </head>
 <?php
        $field = get_query_var('field');
    ?>

 <script>
document.querySelectorAll('.modal-option').forEach(option => {
  option.addEventListener('click', function() {
    const name = this.getAttribute('data-name');
    const price = this.getAttribute('data-price');
    localStorage.setItem('selectedDesire', JSON.stringify({
      name,
      price
    }));
    selectOptionDesire(this);
    document.querySelectorAll('.option-desire').forEach(input => {
      input.checked = input.getAttribute('data-name') === name;
      input.checked = input.getAttribute('data-price') === price;
    });
  });
});
 </script>

 <script>
// Khi mở modal, cập nhật radio đã chọn trước đó
document.getElementById("desire").addEventListener("click", function() {
  const savedDesire = localStorage.getItem("selectedDesire");
  if (savedDesire) {
    document.querySelectorAll(".modal-option").forEach(input => {
      input.checked = input.getAttribute("data-name") === savedDesire;
      input.checked = input.getAttribute("data-price") === savedDesire;
    });
  }
});
 </script>

 <script>
document.querySelectorAll(".modal-option-material").forEach(input => {
  input.addEventListener("change", function() {
    const name = this.getAttribute("data-name");
    localStorage.setItem("selectedMaterial", name);
  });
});

// Khi mở modal, cập nhật radio đã chọn trước đó
document.getElementById("material").addEventListener("click", function() {
  const savedDesire = localStorage.getItem("selectedMaterial");
  if (savedDesire) {
    document.querySelectorAll(".modal-option-material").forEach(input => {
      input.checked = input.getAttribute("data-name") === savedDesire;
    });
  }
});
 </script>


 <script>
document.addEventListener("DOMContentLoaded", () => {
  // Hiển thị total price từ localStorage
  function updateTotalPrice() {
    const totalPrice = localStorage.getItem("totalPrice") || 0;
    const formattedPrice = new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
    document.getElementById("totalPriceDisplay").textContent = formattedPrice;
  }

  updateTotalPrice(); // Gọi hàm khi tải trang
});
 </script>

 <script>
document.addEventListener("DOMContentLoaded", function() {
  function saveSelectedOption(storageKey, selector) {
    document.querySelectorAll(selector).forEach(input => {
      input.addEventListener("change", function() {
        const name = this.getAttribute("data-name");
        const price = parseFloat(this.getAttribute("data-price")) || 0;
        // Lưu lựa chọn vào localStorage
        localStorage.setItem(storageKey, JSON.stringify({
          name,
          price
        }));
        const selectedOptionDesire = document.querySelector(
          `.option-desire[data-name="${this.getAttribute("data-name")}"]`);
        if (selectedOptionDesire) {
          selectOptionDesire(selectedOptionDesire);
        }
        const selectedOptionMaterial = document.querySelector(
          `.option-material[data-name="${this.getAttribute("data-name")}"]`);
        if (selectedOptionMaterial) {
          selectOptionMaterial(selectedOptionMaterial);
        }
        const selectedOptionBh = document.querySelector(
          `.option-bh[data-name="${this.getAttribute("data-name")}"]`);
        if (selectedOptionBh) {
          selectOptionBh(selectedOptionBh);
        }
        const selectedOptionTp4 = document.querySelector(
          `.option-tp4[data-name="${this.getAttribute("data-name")}"]`);
        if (selectedOptionTp4) {
          selectOptionTp4(selectedOptionTp4);
        }
        const selectedOptionTp5 = document.querySelector(
          `.option-tp5[data-name="${this.getAttribute("data-name")}"]`);
        if (selectedOptionTp5) {
          selectOptionTp5(selectedOptionTp5);
        }
        // Cập nhật tổng tiền ngay lập tức
        updateTotalPrice();
        updateUI();
        updateNoteTopping();
      });
    });
  }

  function restoreSelectedOption(storageKey, selector) {
    const savedData = localStorage.getItem(storageKey);
    if (savedData) {
      const {
        name
      } = JSON.parse(savedData);
      document.querySelectorAll(selector).forEach(input => {
        input.checked = input.getAttribute("data-name") === name;
      });
    }
  }

  function updateTotalPrice() {
    const desire = JSON.parse(localStorage.getItem("selectedDesire"))?.price || 0;
    const material = JSON.parse(localStorage.getItem("selectedMaterial"))?.price || 0;
    const bh = JSON.parse(localStorage.getItem("selectedBh"))?.price || 0;
    const servicePrice = JSON.parse(localStorage.getItem("servicePrice")) || 0;

    const totalPrice = desire + material + bh + servicePrice;
    localStorage.setItem("totalPrice", totalPrice);

    document.getElementById("totalPriceDisplay").textContent =
      new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
    document.getElementById("totalPriceBooking").textContent =
      new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
  }

  // Khi mở modal, khôi phục giá trị đã chọn trước đó
  document.getElementById("desire").addEventListener("click", function() {
    restoreSelectedOption("selectedDesire", ".modal-option");
  });

  document.getElementById("material").addEventListener("click", function() {
    restoreSelectedOption("selectedMaterial", ".modal-option-material");
  });

  document.getElementById("bh").addEventListener("click", function() {
    restoreSelectedOption("selectedBh", ".modal-option-bh");
  });

  // Áp dụng cho từng nhóm lựa chọn
  saveSelectedOption("selectedDesire", ".modal-option");
  saveSelectedOption("selectedMaterial", ".modal-option-material");
  saveSelectedOption("selectedBh", ".modal-option-bh");
  saveSelectedOption("selectedBh", ".modal-option-tp4");

  // Cập nhật tổng tiền ban đầu
  updateTotalPrice();

  // Xử lý khi nhấn "Cập nhật"
  document.getElementById("btnUpdatePrice").addEventListener("click", function() {
    updateTotalPrice();

    const totalPrice = localStorage.getItem("totalPrice") || 0;
    const formattedPrice = new Intl.NumberFormat("vi-VN").format(totalPrice) + " đ";
    document.getElementById("footer-total-price").textContent = formattedPrice;

    // Gửi postMessage để đóng modal
    window.parent.postMessage({
      action: "closeModal"
    }, "*");
  });
});
 </script>



 <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
 <div class="relative m-auto rounded-2 bg-white w-full  background-modal p-4 z-[120]" style="
				    height: 85%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    bottom: 0;
                    z-index: 100;
                    position: absolute;
                    background:#ffff;
                    border-radius: 16px 16px 0px 0px;">
   <div class=" overflow-hidden w-full h-full ">
     <div class="flex justify-between items-center w-full">
       <div class="flex items-center w-full" style="flex-direction:column;justify-content:center">
         <div class="text-center w-full text-16" style="font-weight:700">Giá cá nhân hoá</div>
         <div class="text-center w-full text-12" style="color:#aaa">Dịch vụ : Nhấn mí mắt</div>
       </div>
       <div class="close-modal  cursor-pointer">
         <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
       </div>
     </div>
     <div class=" w-full h-full mt-2 topping-row"
       style="text-align:start;overflow-y:auto;height:90%;padding-bottom:100px">
       <div>
         <div class="  flex items-center" style="justify-content: space-between;border: 1px solid;padding: 4px;">
           <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2" style="font-size:14px">Topping
             dịch vụ</h2>
           <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/angle-small-down.svg") ?>" alt="" />
         </div>
         <div class=" modal-content mt-2">
           <div>
             <div class="flex items-center justify-between">
               <div class="flex items-center gap-2">
                 <h3 class="font-medium">
                   <?= !empty($field['name_desire']) ? $field['name_desire'] : "Mong muốn" ?>
                 </h3>
                 <span class="text-10 " style="color:#aaa">Không bắt buộc,chọn 1</span>
               </div>
               <!-- <button id="desire" class="submit text-sm text-gray-500 cursor-pointer" style="font-size:10px;color:#0068FF">So sánh &gt;</button> -->
             </div>
             <div>
               <?php $desireTopping = $field['desire'];
                                    if (!is_array($desireTopping)) {
                                        $desireTopping = [];
                                    }?>
               <?php foreach ($desireTopping as $desire_topping) : ?>
               <?php 
                                            $term = get_term($desire_topping["topping"], 'service-topping'); 
                                            $image = get_field("featured_image", "service-topping_$term->term_id");
                                        ?>
               <label class="flex items-center justify-between py-2 border-b-1 border-gray-200 cursor-pointer">
                 <div class="flex items-center space-x-2 gap-2">
                   <input type="radio" name="desire-options" data-price="<?= $desire_topping["origin"] ?>"
                     data-name="<?= $term->name ?>" value="<?= $desire_topping["origin"] ?>"
                     class="modal-option appearance-none w-4 h-4 border border-gray-400 rounded-full checked:bg-[#81599F] checked:border-transparent relative">
                   <span class="text-gray-800"><?= $term->name ?></span>
                 </div>
                 <div style=" font-size:12px ;color:#aaa">
                   <?= number_format($desire_topping["origin"], 0, ",", ".") ?> <small>đ</small>
                 </div>
               </label>
               <?php endforeach; ?>
             </div>
           </div>
           <div class="mt-4">
             <div class="flex items-center justify-between">
               <div class="flex items-center gap-2">
                 <h3 class="font-medium">
                   <?= !empty($field['name_material']) ? $field['name_material'] : "Vật liệu" ?>
                 </h3>
                 <span class="text-10 " style="color:#aaa">Không bắt buộc,chọn 1</span>
               </div>
               <!-- <button id="material" class="submit text-sm text-gray-500 cursor-pointer" style="font-size:10px;color:#0068FF">So sánh &gt;</button> -->
             </div>
             <div>
               <?php $materialTopping = $field['material'];
                                    if (!is_array($materialTopping)) {
                                        $materialTopping = [];
                                    }?>
               <?php foreach ($materialTopping as $material_topping) : ?>
               <?php 
                                            $term = get_term($material_topping["topping"], 'service-topping'); 
                                            $image = get_field("featured_image", "service-topping_$term->term_id");
                                        ?>
               <label class="flex items-center justify-between py-2 border-b-1 border-gray-200 cursor-pointer">
                 <div class="flex items-center space-x-2 gap-2">
                   <input type="radio" name="material-options" data-price="<?= $material_topping["origin"] ?>"
                     data-name="<?= $term->name ?>" value="<?= $material_topping["origin"] ?>"
                     class="modal-option-material appearance-none w-4 h-4 border border-gray-400 rounded-full checked:bg-[#81599F] checked:border-transparent relative">
                   <span class="text-gray-800"><?= $term->name ?></span>
                 </div>
                 <div style=" font-size:12px ;color:#aaa">
                   <?= number_format($material_topping["origin"], 0, ",", ".") ?> <small>đ</small>
                 </div>
               </label>
               <?php endforeach; ?>
             </div>
           </div>
           <div class="mt-4">
             <div class="flex items-center justify-between">
               <div class="flex items-center gap-2">
                 <h3 class="font-medium">
                   <?= !empty($field['name_bh']) ? $field['name_bh'] : "Bảo hành" ?>
                 </h3>
                 <span class="text-10 " style="color:#aaa">Không bắt buộc,chọn 1</span>
               </div>
               <!-- <button id="material" class="submit text-sm text-gray-500 cursor-pointer" style="font-size:10px;color:#0068FF">So sánh &gt;</button> -->
             </div>
             <div>
               <?php $bhTopping = $field['bh'];
                                    if (!is_array($bhTopping)) {
                                        $bhTopping = [];
                                    }?>
               <?php foreach ($bhTopping as $bh_topping) : ?>
               <?php 
                                            $term = get_term($bh_topping["topping"], 'service-topping'); 
                                            $image = get_field("featured_image", "service-topping_$term->term_id");
                                        ?>
               <label class="flex items-center justify-between py-2 border-b-1 border-gray-200 cursor-pointer">
                 <div class="flex items-center space-x-2 gap-2">
                   <input type="radio" name="bh-options" data-price="<?= $bh_topping["origin"] ?>"
                     data-name="<?= $term->name ?>" value="<?= $bh_topping["origin"] ?>"
                     class="modal-option-bh appearance-none w-4 h-4 border border-gray-400 rounded-full checked:bg-[#81599F] checked:border-transparent relative">
                   <span class="text-gray-800"><?= $term->name ?></span>
                 </div>
                 <div style=" font-size:12px ;color:#aaa">
                   <?= number_format($bh_topping["origin"], 0, ",", ".") ?> <small>đ</small>
                 </div>
               </label>
               <?php endforeach; ?>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="h-[80px] flex items-center  fixed bottom-0 left-0 right-0 bg-white bottom-action " style=" z-index:10">
     <div class="container">
       <div style="display:flex;align-items:center;gap:12px;justify-content:end">
         <!-- <button id="btnCancelSelection" class="text-red-500 border border-red-500 px-4 py-2 rounded-md">
                            Huỷ
                        </button> -->
         <div class="flex justify-end items-center " id="btnUpdatePrice" style="    background: #009688;
                            padding: 8px 16px;
                            border-radius: 24px;
                            color: #FFF;
                            font-weight: 700;">
           Cập nhật : <span id="totalPriceDisplay" class=" font-bold" style="padding-left:2px;font-size:14px">
             <?php echo number_format($totalPrice, 0, ',', '.') ?> đ
           </span>
         </div>

       </div>
     </div>
   </div>
 </div>

 <!-- <script>
      document.getElementById("btnCancelSelection").addEventListener("click", function () {
    // Xóa hết dữ liệu trong localStorage liên quan đến modal
    localStorage.removeItem("selectedDesire");
    localStorage.removeItem("selectedMaterial");
    localStorage.removeItem("selectedBh");

    // Bỏ chọn tất cả radio buttons
    document.querySelectorAll(".modal-option, .modal-option-material, .modal-option-bh").forEach(input => {
        input.checked = false;
    });

    // Cập nhật lại tổng tiền về 0
    document.getElementById("totalPriceDisplay").textContent = "0 đ";
    document.getElementById("totalPriceBooking").textContent = "0 đ";

    // Nếu muốn đóng modal sau khi huỷ
});
    </script> -->