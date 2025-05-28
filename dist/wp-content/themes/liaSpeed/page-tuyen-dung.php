<?php get_header(); ?>

<head>
  <link href="style.css" rel="stylesheet" />
</head>

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
      <div id="register-recruitment">
        <?= wp_nonce_field( 'recruitment_form' ); ?>
        <div class="content-editor">
          <?= the_content(); ?>
          <div class="form-group">
            <label class="form-label" for="name">Họ tên</label>
            <input type="text" id="name" name="fullname" class="form-input" placeholder="Nhập họ tên của bạn" required>
            <div class="has-error error-fullname"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="phone">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" class="form-input" placeholder="Nhập số điện thoại của bạn"
              required>
            <div class="has-error error-phone"></div>
          </div>
          <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="Nhập email của bạn">
            <div class="has-error error-email"></div>
          </div>

          <div class="form-group">
            <label class="form-label" for="experience">Kinh nghiệm</label>
            <select id="experience" name="experience" class="form-input input-select">
              <option value="0" selected>Dưới 1 năm</option>
              <option value="1">Trên 1 năm</option>
            </select>
          </div>

          <!-- <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select> -->

          <!-- 
          <div class="form-group">
            <label for="message">Nội dung</label>
            <textarea id="message" name="message" class="form-input" rows="4"
              placeholder="Nhập yêu cầu tư vấn của bạn"></textarea>
          </div> -->

          <button type="button" class="form-submit js-home-consultation">Gửi thông tin</button>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>