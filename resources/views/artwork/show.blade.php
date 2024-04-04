

      <!-- Button to view artwork (opens modal) -->
           <button type="button" class="btn btn-primary bg-gray-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full" onclick="openModal('{{ $artwork->id }}')">
            View Artwork
        </button>

        <!-- Modal -->
        <div class="modal" id="exampleModal_{{ $artwork->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-gray-200">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $artwork->name }}</h5>
                        <button type="button" class="close" onclick="closeModal('{{ $artwork->id }}')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0">
                                    <img id="artworkImage_{{ $artwork->id }}" class="h-96 w-full object-cover md:w-48" src="{{ asset('images/' . $artwork->image->first()->image_path) }}" alt="Artwork Image">
                                </div>
                                <div class="p-8">
                                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Artwork Details</div>
                                    <p class="mt-2 text-gray-500"><strong>Artist:</strong> {{ $artwork->artist->user->fname }} {{ $artwork->artist->user->lname }}</p>
                                    <p class="mt-2 text-gray-500"><strong>Price:</strong> ${{ $artwork->price }}</p>
                                    <p class="mt-2 text-gray-500"><strong>Description:</strong> {{ $artwork->desc }}</p>
                                    <p class="mt-2 text-gray-500"><strong>Categories:</strong> {{ $artwork->category }}</p>
                                    <p class="mt-2 text-gray-500"><strong>Size:</strong> {{ $artwork->size }}</p>
                                    <div class="mt-4">
                                        <form action="{{ route('cart.addArtwork') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="artwork_id" value="{{ $artwork->id }}">
                                            @if($artwork->status == 'available')
                                                @if(!$customer->cart->artwork()->where('artwork_id', $artwork->id)->exists())
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        Add to Cart
                                                    </button>
                                                @else
                                                    <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>
                                                        Already in Cart
                                                    </button>
                                                @endif
                                            @else
                                                <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>
                                                   Already Sold
                                                </button>
                                            @endif
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('{{ $artwork->id }}')">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- JavaScript to handle modal --}}
        <script>
            function openModal(artworkId) {
                var modal = document.getElementById("exampleModal_" + artworkId);
                modal.style.display = "block";
            }

            function closeModal(artworkId) {
                var modal = document.getElementById("exampleModal_" + artworkId);
                modal.style.display = "none";
            }
        </script>

