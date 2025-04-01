<?php $investmentSteps =  $franchise_fields['investment_steps'];?>
<div class="franchise-detail">
  <div class="title-box">
    <span>Quy trình nhượng quyền</span>
  </div>
  <div class="line"></div>
</div>
<?php if($investmentSteps){?>
<div class="timeline">
  <?php foreach ($investmentSteps as $step) {?>
  <div class="timeline-item right">
    <div class="timeline-left">
      <div class="timeline-date">Ngày <br><span><?php echo $step['day_step'];?></span></div>
      <div class="timeline-circle"></div>
    </div>
    <div class="timeline-content">
      <h3><?php echo $step['name_step'];?></h3>
      <p><?php echo $step['desc_step'];?></p>
    </div>
  </div>
  <?php
  }
  ?>
</div>
<?php } ?>
<div style="height: 80px;"></div>