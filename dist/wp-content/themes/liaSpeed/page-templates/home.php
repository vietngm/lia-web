<?php 
/**
 * Template name: Trang chủ
 */
?>

<?php get_header();?>

<?php
	$fields = get_fields();
?>
<style>
    .section-home-contact {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
	
	
    }
		.contact-options {
		display: flex;
		justify-content: space-between;
		width: 100%;
		border: 1px solid #ccc;
		position: relative;
		top: -131px;
		background: #FFF;
		border-radius: 12px;
		padding: 20px;
		}

		.contact-item {
			width: 30%;
			display: flex;
			gap:16px;
			text-align: left;
		}

    .icon {
        margin-bottom: 10px;
    }


    h2 {
        font-size: 1.2em;
        margin: 0px 0px 6px;
    }

    p {
        font-size: 0.9em;
        color: #555;
    }
	.dashed {
		width:1px;
		background: #ccc;
	}
	.slick-slide img{
		margin:0 auto;
	}
	@keyframes slideOverlay {
  0% {
    left: -100%; /* Bắt đầu từ ngoài bên trái */
  }
  100% {
    left: 100%; /* Trượt hết sang bên phải */
  }
}

.view-more {
  position: relative;
  color: #8f8f8f;
  font-size: 12px;
  cursor: pointer;
  overflow: hidden;
  display: inline-block;
  padding: 4px 10px;
  border: 1px solid #ccc;
}

.view-more::after {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(173, 216, 230, 0), rgba(173, 216, 230, 0.48), rgba(173, 216, 230, 0));  
  animation: slideOverlay 3s linear infinite;
}
.section-title{
	color:#1A5477;
}
.home-description-why{
	width: 270px;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 16px;
    -webkit-line-clamp: 2;
    height: 32px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    margin-top: 6px;
	font-weight: 300;
}
.content-why-choose h3 {
    font-weight: 700;
}

.content-why-choose {
    margin-top: 4px;
}

.dot-why {
    border: 1px solid;
    width: 3px;
    height: 3px;
    border-radius: 100%;
    background: #000;
}

.content-why-choose h4 {
    font-weight: 400;
    font-size: 12px;
}
</style>

<main >
	<section class="section-home-banner" style="position:relative">
		<div class="home-banner mount-slider " >
			<?php foreach ($fields["banner"]["images"] as $image) : ?>
				<?php if ($image["url"]) : ?>
				<a href="<?= $image["url"] ?>">
					<img class="w-full" style="height:auto"  src="<?= bfi_thumb($image["image"] , array("width"=>1440,'crop'=>false)) ?>" />
				</a>
				<?php else : ?>
				<div>
					<img class="w-full" style="height:auto" src="<?= bfi_thumb($image["image"] , array("width"=>1440, 'crop'=>false)) ?>" />
				</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
		
	</section>
	<section class="section section-home-about">
		<div class="container">
			<h1 class="section-title"><?= $fields["banner"]["title"] ?></h1>
			<div class="content-editor">
				<?= $fields["banner"]["description"] ?>
			</div>
			<?php if ($fields["banner"]["viewmore"] != null) : ?>
			<a class="btn-outline mt-2 view-more"  target="<?= $fields["banner"]["viewmore"]["target"] ?>" href="<?= $fields["banner"]["viewmore"]["url"] ?>">
				<?= $fields["banner"]["viewmore"]["title"] ?>
				->
			</a>
			<?php endif; ?>
		</div>
	</section>
		<section class="section">
		<div class="container">
			<h2 class="section-title"><?= $fields["service"]["title"] ?></h2>
			<?php get_template_part( 'template-parts/service', 'list', array("max_items" => -1) ); ?>
		</div>
	</section>

	<?php if (!empty($fields["franchise"]["highlight_nhuong_quyen"])): ?>
	<section class="section section-home-why-choose">
		<div class="container">
			<h2 class="section-title mb-4">
				<h1 class="section-title"><?= $fields["franchise"]["title"] ?></h1>
			</h2>
			<div class="overflow-x-auto no-scrollbar flex gap-2 mb-2">
				<?php foreach ( $fields["franchise"]["highlight_nhuong_quyen"] as $franchiseId ): ?>
				<?php $franchiseFields = get_fields($franchiseId); ?>
					<a class="flex-shrink-0  flex flex-col" >
						<img class="overflow-hidden w-full block "style="width:280px;height:170px;border-radius:8px" src="<?= get_the_post_thumbnail_url($franchiseId) ?>" />
						<div class=" flex-1" style="padding-top:8px">
							<h4 class="text-14 " style="font-weight:500"><?= get_the_title($franchiseId) ?></h4>
							<p class="text-12 line-clamp-2 home-description-why"><?= $franchiseFields["description"] ?></p>
							<div class="flex items-center gap-2 content-why-choose">
								<h3><?= $franchiseFields['price'] ?> triệu</h3>
								<div class="dot-why"> </div>
								<h4><?= $franchiseFields['m2'] ?></h4>
								<div class="dot-why"> </div>
								<h4><?= $franchiseFields['phong'] ?> phòng</h4>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<section class="section">
		<div class="container">
			<h2 class="section-title mb-4">
				<h1 class="section-title"><?= $fields["feature"]["title"] ?></h1>
			</h2>
			<div class=" flex gap-2 mb-2 flex-wrap">
				<?php foreach ( $fields["feature"]["items"] as $item ): ?>
				<a href="<?= $fields["feature"]["viewmore"]["url"] ?>" style="width:175px" class="overflow-hidden w-[175px] flex-2 flex-shrink-0 rounded-2 flex flex-col">
					<img class="w-full block aspect-square" src="<?= $item["image"] ?>" />
					<div class="pt-2 pb-3 flex-1">
						<p class="text-12 line-clamp-2"><?= $item["description"] ?></p>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<h2 class="section-title mb-4">
				<h1 class="section-title"><?= $fields["other"]["title"] ?></h1>
			</h2>
			<div class=" flex gap-2 mb-2 flex-wrap">
				<?php foreach ( $fields["other"]["items"] as $item ): ?>
				<a  style="width:175px" class="overflow-hidden w-[175px] flex-2 flex-shrink-0 rounded-2 flex flex-col">
					<img class="w-full block aspect-square" src="<?= $item["image"] ?>" />
					<div class="pt-2 pb-3 flex-1">
						<p class="text-12 line-clamp-2"><?= $item["description"] ?></p>
					</div>
				</a>
				<?php endforeach; ?>
				<a class="btn-outline" style="border-radius: 8px;background: #4c7da4;color: #FFF; border: 1px solid;" target="<?= $fields["other"]["viewmore"] ?>" href="<?= $fields["other"]["viewmore"] ?>">
					Tuyển dụng
				</a>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>