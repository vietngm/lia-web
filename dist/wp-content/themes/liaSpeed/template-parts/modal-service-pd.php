 
     <?php
        $field = get_query_var('field');
    ?>
    <head>
        <style>
            .topping-row::-webkit-scrollbar {
                display: none;
            }
        </style>
    </head>
    <div class="bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0 "></div>
    <div class="relative m-auto rounded-2 bg-white w-full  background-modal p-4 z-[120]" style="
				    height: 85%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    bottom: 0;
                    z-index: 100;
                    position: absolute;
                    background:#ffff;
                    border-radius: 16px 16px 0px 0px;">
            <div class=" overflow-hidden w-full h-full ">
                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center w-full" style="flex-direction:column;justify-content:center">
                        <div class="text-center w-full text-16" style="font-weight:700">Phác đồ thực hiện</div>
                    </div>
                    <div class="close-modal  cursor-pointer">
                        <img class="w-6 h-6" src="<?= get_theme_file_uri("assets/images/icons/close-gray.svg") ?>" alt="" />
                    </div>
                </div>
                <div class=" overflow-auto w-1/2 h-full p-2 topping-row" style="height: 100%;overflow-y: auto;">
                    <?= $field["pd"] ?>
                </div>
                
            </div>
          
    </div>
    
   