{{-- navbar (1) --}}
<div class="bg-gray-700">
    <div class="container flex">

         {{-- categories --}}
         <div class="mr-5">
             <div class="px-8 py-4 hover:bg-primary flex items-center cursor-pointer relative group">
                 <span class="text-white">
                     <i class="fas fa-bars"></i>
                 </span>
                 <span class="capitalize ml-2 text-white">All Categories</span>

                 <div class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-solid hidden group-hover:block transition">

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-map-location-dot w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Painting</span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-list w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Printmaking/span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-peso-sign w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Photography</span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-bed w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Sculpture</span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-bath w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Drawing</span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-ruler-combined w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Digital Art</span>
                     </a>

                     <a href="" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                         <i class="fa-solid fa-person-shelter w-5 h-5 object-contain"></i>
                         <span class="ml-6 text-gray-600 text-sm">Collage</span>
                     </a>
                 </div>
             </div>
         </div>
         {{-- end of categories --}}

         {{-- navbar links --}}
         <div class="flex items-center justify-between flex-grow pl-12">
             <div class="flex items-center space-x-6 capitalize">
                 <a href="{{ route('artwork.dashboard') }}"class="text-gray-200 hover:underline hover:text-white transition">Artwork Dashboard</a>
                 <a href="{{ route('artwork.create') }}" class="text-gray-200 hover:underline hover:text-white transition">Artworks</a>
                 <a href="{{ route('blogs.index') }}"class="text-gray-200 hover:underline hover:text-white transition">Blogs Dashboard</a>
                 <a href="{{ route('blogs.create') }}" class="text-gray-200 hover:underline hover:text-white transition">Blogs</a>
                
             </div>
             {{-- login and register --}}
             <a href="" class="text-gray-200 hover:underline hover:text-white transition">Login/Register</a>
             {{-- end of login and register --}}
         </div>
         {{-- end of navbar links --}}
         @auth
         <!-- Show links for authenticated users -->
         <a href="{{ route('logout') }}" class="text-center text-gray-700 hover:text-primary transition relative hover:scale-105">
             <div class="text-xl">
                 <i class="fa-solid fa-right-from-bracket"></i>
             </div>
             {{-- <div class="text-sx leading-3">Log Out</div> --}}
         </a>
     @else
         <!-- Show links for guests (unauthenticated users) -->
         <a href="{{ route('login') }}" class="text-center text-gray-700 hover:text-primary transition relative">
             <div class="text-2xl">
                 <i class="fa-solid fa-right-from-bracket"></i>
             </div>
             <div class="text-sx leading-3">Log In</div>
         </a>
     @endauth
    </div>
</div>
{{-- end of navbar --}}
