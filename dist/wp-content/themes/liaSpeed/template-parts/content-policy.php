<div class="franchise-detail">
  <div class="title-box">
    <span>Chính sách nhượng quyền</span>
  </div>
  <div class="line"></div>
</div>
<?php
$policyId = get_page_by_path('chinh-sach-nhuong-quyen');
$child = new WP_Query( array('post_parent' => $policyId->ID, 'post_type' => 'page') );
if ($child->have_posts()) : while ($child->have_posts()) : $child->the_post();
  $post = get_post(get_the_ID()); 
  $slug = $post->post_name;
  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
  if($slug=='chinh-sach-bao-hanh'){
?>
<div class="warranty-policy">
  <div class="policy-item">
    <div class="policy-check">
      <img src="<?php echo get_theme_file_uri('assets/images/icons/shield-check.svg'); ?>" alt="Warranty">
    </div>
    <div class="policy-title"><?php the_title();?></div>
    <a href="#warranty-modal" class="policy-more">Chi tiết →</a>
  </div>
  <div>
    <img src="<?php echo $featured_img_url; ?>" alt="Warranty">
  </div>
  <!-- Modal for Warranty Policy Details -->
  <div id="warranty-modal" class="modal">
    <?php include get_template_directory() . "/template-parts/modal-warranty.php"; ?>
  </div>
</div>
<?php }if($slug=='chinh-sach-hoan-tien'){ ?>
<div class="refund-policy">
  <div class="policy-item">
    <div class="policy-check">
      <img src="<?php echo get_theme_file_uri('assets/images/icons/shield-check.svg'); ?>" alt="Warranty">
    </div>
    <div class="policy-title"><?php the_title();?></div>
    <a href="#refund-modal" class="policy-more">Chi tiết →</a>
  </div>
  <div>
    <?php ?>
    <img src="<?php echo $featured_img_url; ?>" alt="Refund">
  </div>
  <!-- Modal for Refund Policy Details -->
  <div id="refund-modal" class="modal">
    <?php include get_template_directory() . "/template-parts/modal-refund.php"; ?>
  </div>
</div>

<?php
}
endwhile;
endif;
wp_reset_query();
?>