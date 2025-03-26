<?php
    $fields = get_fields();
    $doctor_avatar = bfi_thumb(get_the_post_thumbnail_url(), array("width" => 400, 'crop' => false));
    $doctor_id = get_the_ID();
    $doctor_name = get_the_title();
    $doctor_address = get_field('address', $doctor_id);
    $doctor_rating = get_field('rating', $doctor_id);
    $doctor_customers = get_field('customers', $doctor_id);
    $services = $args['services']; 
    $service_categories = $args['service_categories']; 
    $label = get_field('label', $doctor_id);
    $video_number = get_field('video_number', $doctor_id);
    $rating_number = get_field('rating_number', $doctor_id);
    $doctor_phone = get_field('phone', $doctor_id);
    $kn = get_field('kn', $doctor_id);
?>

<style>
    .blur-bg {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(4px);
    }
    .bg-border {
        width: 100%;
        height: 1px;
        position: absolute;
        border-bottom: 2px solid #961bb329;;
    }
    .bg-category{
        color:rgb(123, 43, 143);
        border-radius: 5px;
        font-weight:500;
        font-size:11px;
        margin-top: 1px;
    }
    .image-container {
        position: relative;
    }

    .image-container img {
        width: 100%;
        display: block;
    }

    .image-container::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%; 
        background: linear-gradient(to top, white, rgba(255, 255, 255, 0));
    }
    .button-detail{
        background:#EDFFE1;
        color: #45843B;
        font-weight: 600;
        padding:4px 12px;
        border: 1px solid #45843B;
        border-radius: 24px;
    }
    .image-containers{
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
    }
</style>
    <a href="<?= get_permalink() ?>" class="flex relative w-full gap-3  mt-4" >
        <div class=" image-containers" >
            <img src='<?= esc_url($doctor_avatar) ?>' alt="practitioner" class="w-32 h-32" style="width: 120px; height: auto;  object-fit: cover;">
        </div>
        <div class=" w-full flex flex-col gap-1">
            <div class="flex gap-1 items-center justify-between">
                <div class="flex items-center flex-wrap "> 
                    <h1 class=" font-bold" style="font-size:14px"><?= esc_html($doctor_name); ?></h1>
                </div>
                <div class="flex gap-1 items-center text-12 ">
                    <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/star-yellow.svg") ?>" alt="" />
                    <h4><?= esc_html($doctor_rating); ?> (243)</h4>
                </div>
            </div>
            <div class="flex gap-1 items-center" >
                <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/location.svg") ?>" alt="" />
                <div class="flex items-center">
                    <h4 class="text-12"><?= esc_html($doctor_address); ?></h4>
                </div>
            </div>
            <div class="flex gap-1 items-center" >
                <img class="w-3 h-3" src="<?= get_theme_file_uri("assets/images/icons/phone-small.svg") ?>" alt="" />
                <div class="flex items-center">
                    <h4 class="text-12"><?= esc_html($doctor_phone); ?></h4>
                </div>
            </div>
            <div class="flex gap-2 items-center" >
            <button  class="bg-blue-500  rounded-4 px-2 py-1 text-12 button-detail" style="font-size: 12px;">Mở cửa</button>
            <h3 style="font-weight:300">8:00 - 18:00</h3>
            </div>
        </div>
    </a>
