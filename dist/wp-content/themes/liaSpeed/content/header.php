     <div class="container border-b border-gray-300">
       <div class="flex items-center justify-between h-[64px]">
         <!-- Toggle menu for mobile -->
         <!-- Logo -->
         <a href="<?= get_home_url() ?>" class="flex items-center space-x-4">
           <img style="height:48px" src="<?= get_theme_file_uri("assets/images/logo.png") ?>" />
         </a>

         <button class=" lg:hidden w-7.5 h-7.5 rounded-8 bg-primary flex items-center justify-center cursor-pointer"
           tbc-toggle-target="#chat-modal">
           <img class="w-4 h-4" src="<?= get_theme_file_uri("assets/images/icons/phone-white.svg") ?>" />
         </button>
         <div class="relative flex hidden lg:block">
           <div class="relative flex">
             <form action="<?= home_url('/') ?>" method="get" class="relative ">
               <div style="border-radius:10px ; border:1px solid #ddd;">
                 <div>
                   <button style="padding-left:8px" type="submit"
                     class="pl-3 absolute inset-y-0 bottom-0 top-0 left-0 flex items-center pr-3">
                     <img src="<?= get_theme_file_uri('assets/images/icons/search.svg') ?>" alt="Search"
                       class="w-5 h-5 pl-3" />
                   </button>
                 </div>
                 <div style="padding-left:16px">
                   <input style="border:none" type="text" name="s" placeholder="Tìm kiếm..."
                     class=" focus-input w-full h-10 px-4 pr-10 text-sm rounded-full shadow-sm focus:none focus:ring focus:border-blue-000" />
                 </div>
               </div>
             </form>
             <a href="<?=$booking_url?>" style="display:flex;align-item:center;padding-left:12px">
               <img style="width:26px" src="<?= get_theme_file_uri("assets/images/icons/calendar-lines.svg") ?>" />
             </a>
           </div>
         </div>
       </div>
     </div>