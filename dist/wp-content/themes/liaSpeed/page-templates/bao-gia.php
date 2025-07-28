<?php 
/**
 * Template name: Báo giá
 */
?>

<?php get_header($is_result ? "empty" : '');?>

<?php 
$post_diaries = get_posts(array(
    "post_type" => "diary",
    "posts_per_page" => -1, 
));

$diaries = []; 

foreach ($post_diaries as $post_diary) {
	$doctor_name = get_field("doctor_name", $post_diary->ID);
	$image = get_the_post_thumbnail_url($post_service->ID);
	$client = get_field("client", $post_diary->ID);
	$services = get_posts(array(
        "post_type" => "service",  
        "posts_per_page" => -1,    
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'diaries',   
                'value' => '"' . $post_diary->ID . '"', 
                'compare' => 'LIKE',  
            ),
        ),
    ));
	foreach ($services as $service) {
		$service->rating = get_field("rating", $service->ID);
		$service->rating_number = get_field("rating_number", $service->ID);
		$service->note = get_field("note", $service->ID);
		$service->client_number = get_field("client_number", $service->ID);
		$service->image = get_the_post_thumbnail_url($service->ID);
	}
	
	$doctor = get_field("doctor", $post_diary->ID);
	$description = get_field("description", $post_diary->ID);
	$imageRow = get_field("image", $post_diary->ID);
	$processing = get_field("processing", $post_diary->ID);

    array_push($diaries,[
        "id" => $post_diary->ID,
		"title" => $post_diary->post_title,
		"link" => get_permalink($post->ID),
		"imageUrl" => $image,
		"fullname" => $client["fullname"],
		"avatar" => $client["avatar"],
		"status" => $client["status"],
		"doctor" => $doctor,
		"services" => $services[0],
		"doctor_image" => get_the_post_thumbnail_url($doctor),
		"doctor_name" => get_the_title($doctor),
		"doctor_rating" => get_field("rating", $doctor),
		"imageBefore" => $imageRow["before"],
		"imageAfter" => $imageRow["after"],
		"processing" => $processing,
		"description" => get_the_title($description),

    ]);
}

?>

<?php
$post_services = get_posts(array(
	"post_type" => "service",
	"posts_per_page" => -1,
));
$services = [];
foreach ($post_services as $post_service) {
	$doctorIds = get_field("doctors", $post_service->ID);
	$price = get_field("price", $post_service->ID) ?? 0;
	$post_prices = get_field("prices", $post_service->ID) ?? [];
	$prices = [];
	$image = get_the_post_thumbnail_url($post_service->ID);
	$link = get_permalink($post_service->ID);
	$rating = get_field("rating", $post_service->ID);
	$rating_number = get_field("rating_number", $post_service->ID);
	$note = get_field("note", $post_service->ID);
	$client_number = get_field("client_number", $post_service->ID);

	array_push($services, [
		"id" => $post_service->ID,
		"title" => $post_service->post_title,
		"price" => (int)$price,
		"prices" => $prices,
		"imageUrl" => $image,
		"link" => $link,
		"rating" => $rating,
		"rating_number" => $rating_number,
		"note" => $note,
		"client_number" => $client_number,
	]);
}

	$fields = get_fields();
	foreach ($fields["data"] as $data_index => $data) {
		foreach ($data["data"] as $age_index => $age) {
			$fields["data"][$data_index]["data"][$age_index]["ages"] = explode("\n", str_replace("\r\n", "\n", $age["ages"]));
			// foreach ($age["data"] as $desire_index => $desire) {
			// 	$fields["data"][$data_index]["data"][$age_index]["data"][$desire_index]["desire"] = explode("\n", str_replace("\r\n", "\n", $desire["desire"]));
			// }
		}
	}
?>

<?php
	function get_age_range_label ($age) {
		$values = explode("-", str_replace(" ", "", $age));
		if ($values[0] == "*") {
			return "Dưới " . (intval($values[1]) + 1);
		} else if ($values[1] == "*") {
			return "Trên " . (intval($values[0]) - 1);
		}
		return $values[0] . " - " . $values[1];
	}

?>

<script>
const ADVISE_PRICING_DATA = JSON.parse(<?= json_encode(json_encode($fields, JSON_HEX_QUOT)) ?>);
const ADVISE_PRICING_FORM_DATA = JSON.parse(<?= json_encode(json_encode($_POST, JSON_HEX_QUOT)) ?>);
const SERVICE_PRICING = JSON.parse(`<?= json_encode($services) ?>`)
const DIARIES_PRICING = JSON.parse(`<?= json_encode($diaries, JSON_HEX_QUOT) ?>`)
</script>

<main>
  <div class="section-advise py-4" style="padding-top:5rem">
    <div class="container">
      <h2 class="form-title mb-2">Chọn danh mục</h2>
      <div class="highlight-filter pt-2 pb-3 bg-white" data-required="true">
        <?php foreach ($fields["data"] as $index => $data) : ?>
        <div class="item <?= !$index ? "item-active" : "" ?>" data-id="<?= $data["service-category"]->term_id ?>">
          <img style="width: 1.875rem;"
            src="<?= get_field("featured_image", "service-category_{$data["service-category"]->term_id}") ?>" />
          <div style="font-size: 0.625rem;font-weight: 600" class="text"><?= $data["service-category"]->name ?></div>
        </div>
        <?php endforeach; ?>
      </div>
      <input type="hidden" name="serviceCategoryId" value="<?= $fields["data"][0]["service-category"]->term_id ?>">
      <div class="content" data-id="1">
        <?php $data = $fields["data"][0]; ?>
        <div class="advise-age">
          <h2 class="form-title mb-4">Chọn độ tuổi</h2>
          <div class="flex flex-wrap gap-2 mb-4 input-advise-age">
            <?php foreach ($data["data"] as $data_age_index => $data_age) : foreach ($data_age["ages"] as $age_index => $age) : ?>
            <label class="check-button">
              <input type="radio" name="age" <?= !$data_age_index && !$age_index ? "checked" : "" ?>
                value="<?= str_replace(" ", "", $age) ?>" />
              <span class="label">
                <?= get_age_range_label($age) ?>
              </span>
            </label>
            <?php endforeach; endforeach; ?>
          </div>
        </div>
        <?php $data_statuses = $data["data"][0]; ?>
        <div class="advise-status">
          <h2 class="form-title mb-4">Tình trạng hiện tại</h2>
          <div class="flex gap-4 overflow-x-auto no-scrollbar mb-4 input-advise-status">
            <?php $added_status_ids = []; ?>
            <?php foreach($data_statuses["data"] as $data_status): foreach ($data_status["status"] as $status) : ?>
            <?php if (!in_array($status["id"], $added_status_ids)) : array_push($added_status_ids, $status["id"]); ?>
            <label class="flex-shrink-0 cursor-pointer border-1  relative"
              style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;margin-bottom: 24px;margin-left: 10px;border-radius: 10px;">
              <div class="input-checkbox absolute right-0 top-0">
                <input type="radio" name="status" value="<?= $status["id"] ?>" class="input-status" />
                <div class="icon"></div>
              </div>
              <img class="w-[150px] flex-shrink-0" src="<?= $status["url"] ?>" alt="" />
            </label>
            <?php endif; ?>
            <?php endforeach; endforeach; ?>
          </div>

        </div>

        <?php $data_desires = $data["data"][0]; ?>
        <div class="advise-desire hidden">
          <h2 class="form-title mb-2" style="margin-top:-16px">Mong muốn</h2>
          <p class="mb-4">Vui lòng chọn tình trạng hiện tại của bạn , để biết thêm chi tiết từng mong muốn đề xuất phù
            hợp.</p>
          <div class="flex gap-4 overflow-x-auto no-scrollbar mb-4 input-advise-desire">
            <?php $added_desire_ids = []; ?>
            <?php if (isset($data_desires["data"]) && is_array($data_desires["data"])): ?>
            <?php foreach ($data_desires["data"] as $data_desire): ?>
            <?php if (isset($data_desire["desire"]) && is_array($data_desire["desire"])): ?>
            <?php foreach ($data_desire["desire"] as $desire): ?>
            <?php if (!in_array($desire["id"], $added_desire_ids)): array_push($added_desire_ids, $desire["id"]); ?>
            <label class="flex-shrink-0 cursor-pointer border-1  relative"
              style="   box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;margin-bottom: 24px;margin-left: 10px;border-radius: 10px;">
              <div class="input-checkbox absolute right-0 top-0">
                <input type="radio" name="desire" value="<?= htmlspecialchars($desire["id"]) ?>" />
                <div class="icon"></div>
              </div>
              <img class="w-[150px] flex-shrink-0" src="<?= htmlspecialchars($desire["url"]) ?>" alt="" />
            </label>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php else: ?>
            <p>Không có mong muốn nào để hiển thị.</p>
            <?php endif; ?>
          </div>
          <!-- <div class="flex flex-col gap-1.5 mb-4 input-advise-desire">
							<label class="check-button rounded small">
								<input type="radio" name="desire" value="Hai mí đều nhau" />
								<span class="label">Hai mí đều nhau</span>
							</label>
							<label class="check-button rounded small">
								<input type="radio" name="desire" value="Hai mí đều nhau" />
								<span class="label">Hai mí đều nhau</span>
							</label>
						</div> -->
        </div>
        <div class="advise-services hidden">
          <h2 class="form-title mb-2">Dịch vụ phù hợp</h2>
          <div class="flex gap-4 overflow-x-auto no-scrollbar mb-4 service">
          </div>
        </div>
        <div class="advise-diaries hidden">
          <h2 class="form-title mb-2">khách hàng giống bạn</h2>
          <div class="flex gap-2 overflow-x-auto no-scrollbar mb-4 diary">

          </div>
        </div>
      </div>
    </div>
    <div class="advise-footer hidden">
      <div class="h-[64px]"></div>
      <div
        class="h-[80px] flex items-center border-t-1 border-[#ccc] fixed bottom-0 left-0 right-0 bg-white bottom-action "
        style="border-top:1px solid #eee; z-index:10">
        <div class="container">
          <div style="display:flex;align-items:center;gap:12px;justify-content:space-between">
            <div class="col-span-1">
              <a href="tel:<?= get_field("header_phone", "option") ?>" target="_blank"
                style="gap:2px;justify-content: center;display:flex;align-items:center;flex-direction: column;">
                <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/call-incoming.svg") ?>" />
                <div style="font-size:12px">Hotline</div>
              </a>
            </div>
            <div class="col-span-1">
              <a href="https://liavietnam.vn/danh-sach-chuyen-vien/" class="consultant-zalo-bottom">
                <!-- <a href="<?//= get_permalink(get_field("page_doctor", "option")) ?>" class="consultant-zalo-bottom"> -->
                <div class="border-zalo-bottom">
                  <!-- <img class="w-5 h-5" src="<?= get_theme_file_uri("assets/images/icons/zalo-2.png") ?>" /> -->
                  <div style="font-weight:700">Tìm chuyên viên</div>
                </div>
                <div style="font-size:10px">Tư vấn 1-1</div>
              </a>
            </div>
            <div class="col-span-1">
              <a href="<?= get_permalink(get_field("page_booking", "option")) ?>" target="_blank"
                class="consultant-zalo-bottom">
                <div style="font-weight:700">Đặt lịch ngay</div>
                <div style="font-size:10px">Phí khám 0đ</div>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<head>
  <style>
  .border-zalo-bottom {
    display: flex;
    align-items: center;
    gap: 4px;
  }

  .consultant-zalo-bottom {
    border-radius: 30px;
    padding: 8px 24px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #ECECEC;
    flex-direction: column;
  }

  .bottom-action {
    transform: translateY(0);
    transition: transform 0.4s ease-in-out;
  }
  </style>
</head>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const bottomAction = document.querySelector(".bottom-action");
  let lastScrollTop = 0;
  let isScrolling;

  window.addEventListener("scroll", () => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    clearTimeout(isScrolling);
    if (scrollTop > lastScrollTop) {
      bottomAction.style.transform = "translateY(100%)";
    } else {
      bottomAction.style.transform = "translateY(0)";
    }
    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  });
});
</script>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<style>
.swiper-container {
  width: 100%;
  overflow: hidden;
}
</style>
<script>
const scrollContainer = document.getElementById('scrollContainer');

// Lắng nghe sự kiện cuộn chuột
scrollContainer.addEventListener('wheel', function(event) {
  event.preventDefault(); // Ngừng hành vi mặc định của cuộn chuột
  scrollByItems(event.deltaY);
});

// Hàm cuộn qua các mục từng cái một
function scrollByItems(delta) {
  const itemWidth = scrollContainer.querySelector('.swiper-slide').offsetWidth; // Đo chiều rộng của một item
  const targetPosition = scrollContainer.scrollLeft + (delta > 0 ? itemWidth : -itemWidth); // Vị trí cuộn tới
  smoothScrollTo(targetPosition);
}

// Hàm cuộn mượt mà
function smoothScrollTo(target) {
  const start = scrollContainer.scrollLeft;
  const distance = target - start;
  const duration = 300; // Thời gian cuộn (ms)
  let startTime;

  function scrollAnimation(time) {
    if (!startTime) startTime = time;
    const progress = time - startTime;
    const scrollAmount = easeInOutCubic(progress, start, distance, duration);
    scrollContainer.scrollLeft = scrollAmount;

    if (progress < duration) {
      requestAnimationFrame(scrollAnimation);
    }
  }

  requestAnimationFrame(scrollAnimation);
}

// Hàm easing để cuộn mượt mà hơn
function easeInOutCubic(t, b, c, d) {
  t /= d / 2;
  if (t < 1) return c / 2 * t * t * t + b;
  t -= 2;
  return c / 2 * (t * t * t + 2) + b;
}
</script>
<?php get_footer("empty"); ?>