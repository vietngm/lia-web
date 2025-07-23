<?php get_header("empty"); ?>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<main class="is-news">
  <section class=" section-product-header mb-2">
    <header id="page-header">
      <div class="history-back cursor-pointer" data-fallback="<?= get_permalink(get_field("home", "option")) ?>">
        <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/chevron-left-gray.svg") ?>" alt="" />
      </div>
      <div>
        <h1 style="padding-left:8px" class=" text-center text-16 font-bold"><?= get_the_title() ?></h1>
      </div>
    </header>
    <div class="container">
      <div class="grid grid-cols-2 gap-4 relative">
        <div class="product-detail-slider mount-slider lg:col-span-1 col-span-2 sm:mt-0 sm:mx-0  -mx-4">
          <?php foreach ($fields["product_gallery"] as $item) : ?>
          <div>
            <img class="w-full" style="margin-top:0px"
              src="<?= bfi_thumb($item['url'] , array("width"=>800, 'crop'=>false)) ?>" />
          </div>
          <?php endforeach; ?>
        </div>
        <div class="lg:col-span-1 col-span-2 flex flex-col">
          <div class="product-detail-title">
            <h1 class="text-16 font-semibold"><?= get_the_title(); ?></h1>
            <div class="product-review">
              <span class="scale">8.0</span>
              <span class="total">(<?php echo $ratingCount;?>)</span>
            </div>
          </div>

          <div class="flex gap-2 items-center mt-2 " style="justify-content: space-between;">
            <div class="text-16 flex items-center gap-2 justify-between w-full">

              <?php if($discount==0) {?>
              <div class="product-price">
                <span><?= number_format($price, 0, ",", ".") ?></span>
                <small><u>đ</u></small>
              </div>
              <?php } else{ ?>

              <div class="product-km">
                <div class="price-discount">
                  <span><?= number_format($discountPrice, 0, ",", ".") ?></span>
                  <small><u>đ</u></small>
                </div>-
                <div class="price-discount">
                  <span><?= number_format($price, 0, ",", ".") ?></span>
                  <small><u>đ</u></small>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="block lg:hidden w-full h-[3px] bg-gray-200 mb-2"></div>
  <section>
    <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow-lg " style="padding-top:0px;padding-bottom:0px">
      <ul class="product-expand">
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Đối tượng phù hợp</span>
            <div class="arrow-up"></div>
          </div>
          <div class="expand-content">
            <div class="expand-desc"><?php echo $dtph;?></div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Hướng dẫn sử dụng</span>
            <div class="arrow-up"></div>
          </div>
          <div class="expand-content">
            <div class="expand-desc"><?php echo $hdsd;?></div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Thành phần sản phẩm</span>
            <div class="arrow-up"></div>
          </div>
          <div class="expand-content">
            <div class="expand-desc"><?php echo $tpsp;?></div>
          </div>
        </li>
        <li class="expand-item">
          <div class="expand-title">
            <span class="expand-label">Mô tả chi tiết</span>
            <div class="arrow-up"></div>
          </div>
          <div class="expand-content">
            <div class="expand-desc"><?php echo $description;?></div>
          </div>
        </li>
      </ul>
      <div class="w-full bg-gray-200" style="margin-top:8px"></div>
    </div>
  </section>
  <section>
    <div class="container">
      <?php if ($the_query_related->have_posts()) : ?>
      <h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2"
        style="font-size:16px;color:#1A5477">Có thể bạn quan tâm</h2>
      <ul class="product-list">
        <?php while ( $the_query_related->have_posts() ) : $the_query_related->the_post(); ?>
        <li class="product-item">
          <?php include get_template_directory() . '/loop/product.php'; ?>
        </li>
        <?php endwhile; ?>
      </ul>
      <?php endif; wp_reset_postdata(); ?>
      <div class="w-full" style="margin-bottom:16px"></div>
    </div>
  </section>
</main>
<?php get_footer("empty"); ?>