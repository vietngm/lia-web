<?php
    $field = get_query_var('field');
?>
     <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
    <div class="relative m-auto rounded-2 bg-white w-full  background-modal p-4 z-[120]" style="
				    height: 80%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    bottom: 0;
                    z-index: 100;
                    position: absolute;
                    background:#f9f5fb;
                    border-radius: 16px 16px 0px 0px;">
            <div class=" overflow-hidden w-1/2 h-full">
            <div class="close-modal absolute right-0 top-0 p-2 cursor-pointer">
                <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
            </div>
            <div class=" overflow-hidden w-1/2 h-full">
                <?= $field["bh_ss"] ?>
            </div>
        </div>
    </div>