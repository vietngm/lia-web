 <div class="container">
   <div style="display:flex;align-items:center;gap:12px;justify-content:end">
     <button class="submit btn flex justify-end items-center" style=" background: #009688;
                                        padding: 8px 16px;
                                        border-radius: 24px;
                                        color: #FFF;
                                        font-weight: 700;">
       Xác nhận đặt hẹn : <span id="totalPriceBooking" class=" font-bold" style="padding-left:2px;font-size:14px">
         <?php echo number_format($totalPrice, 0, ',', '.') ?> đ
       </span>
     </button>
   </div>
 </div>