    {{-- ito yung header ng page 1 --}}
    <header class="py-3 bg-gray-900">
        <div class="mx-10 flex items-center justify-between">
            {{-- logo --}}
            <a href="">
                <img src="https://www.svgrepo.com/show/272028/houses-home.svg" alt="homelogo" class="w-14">
                {{-- <h1 class="text-gray-700 hover:text-red-500 transision">FindFlat</h1> --}}
            </a>


            {{-- search area --}}

            <div class="w-full max-w-xl mx-auto relative flex">

                {{-- navbar links --}}
                {{-- <div class="flex items-center justify-between flex-grow py-3 pl-96 ml-10"> --}}
                    <div class="w-full max-w-xl mx-auto relative flex">

                        {{-- navbar links --}}
                        {{-- <div class="flex items-center justify-between flex-grow py-3 pl-96 ml-10"> --}}
                        <div class="flex items-center space-x-6 capitalize"> {{-- Removed ml-10 --}}
                            {{-- account button --}}
                            <a href="{{ route('home') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition">Home</a>
                            <a href="{{ route('blogs.show') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Blogs</a>
                            <a href="{{ route('event.dashboard') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Events</a>

                            <a href="{{ route('artwork.homeArtwork') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Artworks</a>
                            <a href="{{ route('material.homeMaterial') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Materials</a>
                            <a href="{{ route('cart.index') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Carts</a>
                            <a href="{{ route('order.show') }}" class="text-gray-100 hover:underline hover:text-red-500 hover:scale-105 transition pl-6">Your Orders</a>
                            {{-- <a href="#" class="text-gray-700 hover:underline hover:text-red-500 pl-12 hover:scale-105 transition">About us</a> --}}
                            @include('layout.message')
                            {{-- listing a property button --}}
                        </div>
                    </div>




                    {{-- login and register --}}
                    {{-- <a href="login" class="text-gray-200 hover:underline hover:text-white transition">Login/Register</a> --}}
                    {{-- end of login and register --}}
                {{-- </div> --}}
                {{-- end of navbar links --}}

                {{-- <span class="absolute left-4 top-3 text-lg text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-1-md focus:outline-none" placeholder="Search">
                <button class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">Search</button> --}}

            </div>


            {{-- yung icon  s --}}
            <div class="flex items-center space-x-7">

                {{-- @include('layout.message') --}}
                {{-- listing a property button --}}
                {{-- <a href="createproperty" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-md">
                        <i class="fas fa-house-flag"></i>
                    </div>
                    <div class="text-sx leading-3">Property</div>
                </a> --}}


                {{-- account button --}}
                {{-- <a href="user" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-md">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="text-sx leading-3">Account</div>
                </a> --}}


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
    </header>
