<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Artwork Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <img class="h-48 w-full object-cover md:w-48" src="artwork_image.jpg" alt="Artwork Image">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Artwork Details</div>
                            <a href="#">
                                <h2 class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Artwork Title</h2>
                            </a>
                            <p class="mt-2 text-gray-500">Artist: John Doe</p>
                            <p class="mt-2 text-gray-500">Price: $1000</p>
                            <p class="mt-2 text-gray-500">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et odio purus.</p>
                            <div class="mt-4">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- JavaScript to handle modal --}}
<script>
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
    }
</script>