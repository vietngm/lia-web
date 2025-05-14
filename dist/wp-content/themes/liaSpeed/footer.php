<?php
  $post_branchs = get_posts(array(
		"post_type" => "branch",
		"posts_per_page" => -1,
	));

?>

<?php foreach ($post_branchs as $branch) : ?>
<?php echo json_encode(get_field('chuyen_vien',$branch->ID));?>
<?php endforeach; ?>

<?php get_template_part( 'template-parts/footer', "menu"); ?>
<?php get_template_part( 'template-parts/footer', "nav"); ?>
<?php get_template_part('template-parts/modal','consultation-success'); ?>
<?php wp_footer(); ?>
</body>

</html>