<?php get_header(); ?>

<?php 
$fields = get_fields();
$video = $fields["vct_video"];
?>

<?php if ($video) : ?>
<div class="video-container">
  <video id="myVideo" autoplay muted loop playsinline>
    <source src="<?= $video["url"] ?>" type="video/mp4" />
    Trình duyệt không hỗ trợ video.
  </video>
</div>
<?php else: ?>
<section class="section-booking-banner w-full h-[200px] relative px-4 flex items-center justify-center">
  <?php $image = get_the_post_thumbnail_url( ) ?>
  <img class="w-full h-full object-cover object-center absolute"
    src="<?= $image ? $image : get_theme_file_uri("assets/images/default-banner.jpg") ?>" />
  <div class="w-full h-full absolute bg-black bg-opacity-50"></div>
  <h1 class="relative z-20 text-white text-24 text-center font-bold uppercase"><?= get_the_title(); ?></h1>
</section>
<?php endif; ?>
<section class="section section-blog">
  <div class="container pb-4">
    <div class="flex gap-2 flex-wrap mb-6">
      <a class="text-primary font-semibold" href="/">Trang chủ</a>
      <span>›</span>
      <a class="" href="<?= the_permalink() ?>"><?= get_the_title(); ?></a>
    </div>
    <?php foreach ($fields["content"] as $content) : ?>
    <?php if ($content["acf_fc_layout"] == "title-content") : ?>
    <div class="mb-6">
      <h2 class="about-title text-primary mb-2"><?= $content["title"] ?></h2>
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
        <img class="w-10 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
          src="<?= get_theme_file_uri("assets/images/icons/play-white.svg") ?>" />
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
      <h2 class="about-title text-primary mb-4"><?= $content["title"] ?></h2>
      <div class="grid gap-6">
        <?php foreach($content["items"] as $item) : ?>
        <div class="grid about-us-item">
          <div class="grid gap-1 items-start about-icon-item">
            <img class="about-icon" src="<?= $item["icon"]["url"] ?>" />
            <h2 class="text-primary"><?= $item["title"] ?></h2>
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
      <h2 class="about-title text-primary mb-4"><?= $content["title"] ?></h2>
      <?php foreach($content["items"] as $item) : ?>
      <div class="flex items-center gap-2 pb-2 mb-4 border-b-1 border-[#eee]">
        <div class="about-us-content text-justify">
          <div class="about-capacity-system min-w-[70px]"><?= $item["short_text"] ?></div>
          <?= $item["description"] ?>
        </div>
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
              <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/chevron-bottom-gray.svg") ?>"
                alt="" />
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

<script>
document.addEventListener("DOMContentLoaded", function() {
  var video = document.getElementById("myVideo");
  if (video) {
    video.muted = true; // Safari yêu cầu
    video.play().catch(function(err) {
      console.log("Autoplay bị chặn:", err);
    });
  }
});
</script>

<?php get_footer(); ?>