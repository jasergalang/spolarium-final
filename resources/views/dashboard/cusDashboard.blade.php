@extends('layout.authlayout')

@section('content')
{{-- login --}}


@include('layout.nav')
   <div class="bg-cover bg-no-repeat bg-center py-36" style="background-image: url('https://images.pexels.com/photos/17929272/pexels-photo-17929272/free-photo-of-top-floor-of-a-red-brick-residential-building.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
        <div class="container">
            <h1 class="text-4xl text-white font-medium mb-4">
                RenEase
            </h1>
            <p class="text-xl text-white font-medium mb-4">
                Renting a place to stay is like unlocking a door to possibilities, <br>
                where every key moment becomes a chapter in the story of your life.
            </p>
            <div class="mt-12 hover:scale-105 hover:shadow-2xl transition">
                <a href="showproperty" class="bg-red-500 text-white px-8 py-3 font-medium rounded-2xl border border-white hover:text-white">Rent Now</a>
            </div>
        </div>
   </div>
{{-- end of banner --}}
{{-- feature (do we need this also??)--}}
   <div class="container py-16">
        <div class="w-10/12 grid grid-cols-3 gap-6 mx-auto justify-center">
            <div class="border border-primary rounded-md px-3 py-6 flex justify-center items-center gap-5">
                <img src="https://www.svgrepo.com/show/521416/star-struck.svg" alt="1f" class="w-auto h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Browse to your hearts content</h4>
                    <p class="text-gray-500 text-sm">FOR FREE</p>
                </div>
            </div>

            <div class="border border-primary rounded-md px-3 py-6 flex justify-center items-center gap-5">
                <img src="https://www.svgrepo.com/show/521348/drooling-face.svg" alt="1f" class="w-auto h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Browse to your hearts content</h4>
                    <p class="text-gray-500 text-sm">FOR FREE</p>
                </div>
            </div>

            <div class="border border-primary rounded-md px-3 py-6 flex justify-center items-center gap-5">
                <img src="https://www.svgrepo.com/show/521357/face-screaming-in-fear.svg" alt="1f" class="w-auto h-12 object-contain">
                <div>
                    <h4 class="font-medium capitalize text-lg">Browse to your hearts content</h4>
                    <p class="text-gray-500 text-sm">FOR FREE</p>
                </div>
            </div>
        </div>
   </div>
{{-- end of feature --}}


<div class="container py-16">
    <h2 class="text-3xl font-medium text-gray-800 mb-6">Rent by Category</h2>

    <div class="grid grid-cols-3 gap-3">
        <!-- Location -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1531761535209-180857e963b9?q=80&w=1548&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#location-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Location</a>
        </div>
        <!-- Property Type -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?q=80&w=1546&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#property-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Property Type</a>
        </div>
        <!-- Price -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1561414927-6d86591d0c4f?q=80&w=1546&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#price-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Price</a>
        </div>
        <!-- Bedrooms -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://plus.unsplash.com/premium_photo-1670076505419-99468d952c61?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#bedrooms-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Bedrooms</a>
        </div>
        <!-- Short Term -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1434082033009-b81d41d32e1c?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#shortterm-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Short Term</a>
        </div>
        <!-- Bathrooms -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1620626011761-996317b8d101?q=80&w=1469&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#bathrooms-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Bathrooms</a>
        </div>
        <!-- Floor Area -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://plus.unsplash.com/premium_photo-1676823547757-f00b51e17eff?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#floor-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Floor Area</a>
        </div>
        <!-- Amenities -->
        <div class="relative rounded-sm overflow-hidden group">
            <img src="https://images.unsplash.com/photo-1668911128602-9c03cf73df99?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-cover">
            <a href="showproperty#amenities-id" class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-50 transition">Amenities</a>
        </div>
    </div>
</div>




                <div class="container mb-10 grid grid-cols-3 gap-3">

                    {{-- product contents --}}


                {{-- Property card --}}

                    <div class="bg-white shadow rounded overflow-hidden group">
                        <div class="relative">
                            {{-- Property image --}}
                            <img src="" alt="Property Image" class="w-96 h-52">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                {{-- Your additional HTML or Blade code --}}
                            </div>
                        </div>

                        {{-- Property details --}}
                        <div class="pt-4 pb-3 px-4">
                            <a href="#">
                                <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition"></h4>
                            </a>
                            <div class="flex items-baseline mb-1 space-x-2 font-roboto">

                                <p class="text-xl text-primary font-semibold">
                                    Address:
                                </p><br>

                            </div>
                            <div class="flex items-baseline mb-1 space-x-2 font-roboto">


                                <p class="text-xl text-primary font-semibold">

                                        Price: 90000

                                </p>
                            </div>
                        </div>
                        {{-- end of property details --}}

                            {{-- button view --}}
                        <a href="{" class="block w-full py-1 text-center text-white bg-primary border border-primary rounded-b hover:bg-transparent hover:text-primary transition">View</a>

                    </div>
                    {{-- end of property card --}}


                 {{-- end of products image --}}
                </div>



{{-- q&a ? --}}
    <div class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container grid grdi-cols-1 py-4">
            <h3 class="text-black font-semibold text-xl py-5">House and Lot for Rent: A Smart Option Before Getting Your Forever Home</h3>
            <p class="text-gray-800 font-medium text-justify">
                The Philippine economy has been growing for more than ten years, and this trend is expected to continue.
                Some people now find it more sensible to rent a home due to the Philippines' increasing real estate property values.
                <br><br>
                Additionally, vacant lots are getting harder to come by, especially in metropolitan regions like Metro Manila.
                The trend is leading to an increase in the value of houses and lots.
                Even if price increases are a drawback, those looking for real estate might want to think about renting a home and land.
                Renters in the future will profit from owning a property without having to commit to anything financially or otherwise.
            </p>

            <h3 class="text-black font-semibold text-xl py-5">Average Rental Prices for Houses and Lots for Rent</h3>
            <p class="text-gray-800 font-medium text-justify">
                The most affordable house and lot for rent in the Philippines cost Php 4,000 monthly.
                If you are after luxury living in a progressive city, expect that the fee of a house and lot for rent can reach up to Php 2.6 million monthly.
            </p>

            <h3 class="text-black font-semibold text-xl py-5">Why Rent a House and Lot</h3>
            <p class="text-gray-800 font-medium text-justify">
                Renting a house and lot is one option to get well-built residences without having to pay a lot of money upfront.
                Renters can live in excellent residential projects that are close to institutions and establishments that provide a variety of goods, services, entertainment, and conveniences.
                <br><br>
                There are also rent-to-own residences and lots available.
                These are good for people who wish to buy a house but don't have the funds on hand to pay the entire price right now.
                Most property owners want a leasing period of at least six months to one year for people interested in renting to acquire a house and lot.
            </p>
        </div>
    </div>
{{-- end of q&a ? --}}

@endsection

@section('scripts')
    @parent

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            var errorMessage = @json($errors->all());
            alert(errorMessage.join('\n'));
        </script>
    @endif
@endsection

