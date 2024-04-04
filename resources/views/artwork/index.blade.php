<div class="container mb-10 grid grid-cols-3 gap-3">
    @foreach($artworks as $artwork)
        <div class="bg-white shadow rounded overflow-hidden group">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($artwork->image as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('images/' . $image->image_path) }}" alt="Artwork Image" class="w-96 h-52">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="pt-4 pb-3 px-4">
                <a href="#" onclick="openModal('{{ $artwork->id }}')">
                    <h4 class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">{{ $artwork->name }}</h4>
                </a>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto">
                    <p class="text-xl text-primary font-semibold">
                        <span class="text-gray-600">Price:</span> <span class="text-gray-600 font-bold">${{ $artwork->price }}</span>
                        <br>
                        <span class="text-gray-600">Artist:</span> <span class="text-gray-600 font-bold">{{ $artwork->artist->user->fname }} {{ $artwork->artist->user->lname }}</span>
                        <br>
                        <span class="text-gray-600">Status:</span> <span class="text-green-600 font-bold">{{ $artwork->status }}</span>
                    </p>
                </div>

                @include('artwork.show')
            </div>
        </div>
    @endforeach
</div>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
    window.addEventListener('load', function() {
        var swiperContainers = document.querySelectorAll('.swiper-container');
        swiperContainers.forEach(function (swiperContainer) {
            var swiper = new Swiper(swiperContainer, {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    });
</script>

