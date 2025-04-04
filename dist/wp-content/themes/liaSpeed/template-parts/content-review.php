<h2 class="form-title text-lg font-semibold border-l-4 border-purple-500 pl-2" style="font-size:16px">Đánh giá
</h2>
<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg">
  <div class="mt-2">
    <div class="rating-container">
      <div class="rating-summary">
        <div class="rating-score"><?= $fields["rating"] ?> </div>
      </div>
      <div class="rating-details" class="flex gap-2 ">
        <div>
          <div class="stars">★★★★★</div>
          <div class="stars">★★★★☆</div>
          <div class="stars">★★★☆☆</div>
          <div class="stars">★★☆☆☆</div>
          <div class="stars">★☆☆☆☆</div>
        </div>
        <div style="display: flex;
              flex-direction: column;
              align-items: center;
              gap: 7px;">
          <div class="progress-bar">
            <div class="fill" style="width: 80%;"></div>
          </div>
          <div class="progress-bar">
            <div class="fill" style="width: 15%;"></div>
          </div>
          <div class="progress-bar">
            <div class="fill" style="width: 10%;"></div>
          </div>
          <div class="progress-bar">
            <div class="fill" style="width: 5%;"></div>
          </div>
          <div class="progress-bar">
            <div class="fill" style="width: 2%;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="overflow-x-auto no-scrollbar flex gap-2 mb-2 ">
      <?php if ($fields["review_group"]["reviews"]) : foreach ($fields["review_group"]["reviews"] as $review) : ?>
      <div class="bg-gray-50  rounded-lg shadow-sm mb-4" style="       
              margin: 2px;
              width: 300px;
              box-shadow: rgb(247 247 247) 0px 0px 0px 1px, rgb(236 236 236) 0px 0px 0px 1px inset;
              padding: 12px;
              border-radius: 8px;
              background: #ececec69;">
        <div class="flex justify-between items-center" style="width:300px;">
          <div class="flex items-center gap-2">
            <img style="width:36px ; height:36px"
              src="<?= !empty($review["image"]) ? $review["image"] : get_theme_file_uri("assets/images/avatar.png") ?>"
              alt="Avatar" class="w-12 h-12 rounded-full mr-3">
            <div class=" flex align-start flex-col">
              <h3 class="text-lg font-medium"><?= $review["fullname"] ?></h3>
              <div class="flex items-center gap-1">
                <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/star-yellow.svg") ?>" alt="" />
                <p class="text-yellow-500 font-medium text-12"><?= $review["rating"] ?>/5</p>
              </div>
            </div>
          </div>
          <p class="text-gray-500 text-12" style="margin-right:24px"><?= $review["date"] ?></p>
        </div>
        <div class="mt-2" style="width: 280px;
                overflow: hidden;
                text-overflow: ellipsis;
                line-height: 19px;
                -webkit-line-clamp: 2;
                height: 40px;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                font-size: 13px;">
          <?= $review["content"] ?>
        </div>
        <div class="mt-2 flex gap-2">
          <?php if ($review["gallery"]) : foreach ($review["gallery"] as $image) : ?>
          <img style="width:50px; height:auto; border-radius:6px" src="<?= $image ?>" alt="Image 1"
            class="w-24 h-24 rounded-lg mr-2">
          <?php endforeach; endif; ?>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>