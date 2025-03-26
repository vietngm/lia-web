<?php get_header(); ?>

<main>
	<section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
		<?php $image = get_the_post_thumbnail_url( ) ?>
		<?php if ($image) : ?>
		<img class="w-full h-full object-cover object-center absolute" src="<?= $image ?>" />
		<?php endif; ?>
		<div class="w-full h-full absolute bg-black bg-opacity-50"></div>
		<h1 class="relative z-20 text-white text-24 text-center font-bold uppercase"><?= get_the_title(); ?></h1>
	</section>
	<section class="section section-blog">
		<div class="container pb-4">
			<div class="flex gap-2 flex-wrap mb-8">
				<a class="text-primary font-semibold" href="/">Trang chủ</a>
				<span>›</span>
				<a class="" href="<?= the_permalink() ?>"><?= get_the_title(); ?></a>
			</div>
			<div class="content-editor">
				<?= the_content(); ?>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
