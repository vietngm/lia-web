<?php get_header(); ?>

<?php $fields = get_fields(); ?>

<section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
	<?php $image = get_the_post_thumbnail_url( ) ?>
	<img class="w-full h-full object-cover object-center absolute" src="<?= $image ? $image : get_theme_file_uri("assets/images/default-banner.jpg") ?>" />
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
		<?php foreach ($fields["content"] as $content) : ?>
			<?php if ($content["acf_fc_layout"] == "title-content") : ?>
				<div class="mb-6">
					<h2 class="section-title-underline mb-8"><?= $content["title"] ?></h2>
					<div class="content-editor large">
						<?= $content["content"] ?>
					</div>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "content") : ?>
				<div class="content-editor large">
					<?= $content["content"] ?>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "video") : ?>
				<div>
					<a class="block relative overflow-hidden rounded-2 mb-4" data-fancybox href="<?= $content["video"] ?>">
						<img class="w-full" src="<?= $content["image"] ?>" />
						<div class="bg-black bg-opacity-65 absolute left-0 top-0 right-0 bottom-0"></div>
						<img class="w-10 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2" src="<?= get_theme_file_uri("assets/images/icons/play-white.svg") ?>" />
					</a>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "image_slider") : ?>
				<div class="flex gap-4 items-center mb-4">
					<div class="blog-content-slider overflow-hidden rounded-2 flex-1 max-w-[300px]">
						<?php foreach ($content["images"]  as $image) : ?>
						<div class="h-[180px]">
							<img class="w-full h-full object-cover object-center" src="<?=$image?>" />
						</div>
						<?php endforeach; ?>
					</div>
					<div class="flex-1">
						<h3 class="text-primary font-semibold mb-2"><?= $content["title"] ?></h3>
						<div class="text-12">
							<?= $content["description"] ?>
						</div>
					</div>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "space") : ?>
				<div style="height: <?= $content["size"] ?>px"></div>
			<?php elseif ($content["acf_fc_layout"] == "company-value") : ?>
				<div class="mb-6">
					<h2 class="section-title-underline mb-8"><?= $content["title"] ?></h2>
					<div class="grid grid-cols-2 gap-6">
						<?php foreach($content["items"] as $item) : ?>
						<div>
							<div class="flex gap-1 items-start mb-2">
								<img class="w-7.5 mt-1" src="<?= get_theme_file_uri("assets/images/sample/why-icon.svg") ?>" />
								<h2 class="text-16 font-semibold text-primary"><?= $item["title"] ?></h2>
							</div>
							<div class="content-editor">
								<p class="text-justify">
									<?= $item["content"] ?>
								</p>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "capacity_system") : ?>
				<div class="mb-6">
					<h2 class="section-title-underline mb-8"><?= $content["title"] ?></h2>
					<?php foreach($content["items"] as $item) : ?>
					<div class="flex items-center text-16 gap-2 pb-2 mb-4 border-b-1 border-[#eee]">
						<div class="bg-primary rounded-2 px-2 py-1 text-white min-w-[70px] font-medium text-center"><?= $item["short_text"] ?></div>
						<div><?= $item["description"] ?></div>
					</div>
					<?php endforeach; ?>
				</div>
			<?php elseif ($content["acf_fc_layout"] == "policy") : ?>
				<div class="mb-6">
					<div class="collapse-container">
						<?php foreach($content["items"] as $index => $item) : ?>
						<div class="collapse-item">
							<div class="collapse-header cursor-pointer">
								<div class="flex gap-2 items-center p-2 bg-[#eee] rounded-2 mb-2">
									<img class="w-4.5 h-4.5" src="<?= get_theme_file_uri("assets/images/icons/policy-black.svg") ?>" alt="" />
									<div class="flex-1 font-medium"><?= $item["title"] ?></div>
									<img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/chevron-bottom-gray.svg") ?>" alt="" />
								</div>
							</div>
							<div class="collapse-body <?= $index ? "hidden" : "" ?>">
								<div class="content-editor py-2 mb-2 max-h-[500px] overflow-y-auto">
									<?= $item["content"] ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</section>

<?php get_footer(); ?>
