<?php get_template_part( 'template-parts/footer', "menu"); ?>
<?php get_template_part( 'template-parts/footer', "nav"); ?>
<?php get_template_part('template-parts/modal','consultation-success'); ?>
<div id="bottom-sheet-booking" class="modal-booking fixed hidden top-0 left-0 right-0 bottom-0 z-[120] modal-popup">
  <?php get_template_part( 'template-parts/bottom-sheet', 'service-booking' ); ?>
</div>
<?php wp_footer(); ?>
</body>

</html>