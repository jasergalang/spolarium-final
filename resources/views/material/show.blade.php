<!-- Button to view material (opens modal) -->
<button type="button" class="btn btn-primary bg-gray-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-full" onclick="openMaterialModal('{{ $material->id }}')">
    View Material
</button>
<!-- Modal -->
<div class="modal" id="materialModal_{{ $material->id }}" tabindex="-1" aria-labelledby="materialModalLabel_{{ $material->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-gray-200">
            <div class="modal-header">
                <h5 class="modal-title" id="materialModalLabel_{{ $material->id }}">{{ $material->name }}</h5>
                <button type="button" class="close" onclick="closeMaterialModal('{{ $material->id }}')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="max-w-xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <img id="materialImage_{{ $material->id }}" class="h-96 w-full object-cover md:w-48" src="{{ asset('images/' . $material->image->first()->image_path) }}" alt="Material Image">
                        </div>
                        <div class="p-8">
                            <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Material Details</div>
                            <p class="mt-2 text-gray-500"><strong>Price:</strong> ${{ $material->price }}</p>
                            <p class="mt-2 text-gray-500"><strong>Stock:</strong> {{ $material->stock }}</p>
                            <p class="mt-2 text-gray-500"><strong>Description:</strong> {{ $material->desc }}</p>
                            <p class="mt-2 text-gray-500"><strong>Category:</strong> {{ $material->category }}</p>
                            <p class="mt-2 text-gray-500"><strong>Status:</strong> {{ $material->status }}</p>
                            <form action="{{ route('cart.addMaterial') }}" method="POST">
                                @csrf
                                <input type="hidden" name="material_id" value="{{ $material->id }}">
                                <div class="mt-2">
                                    <label for="quantity_{{ $material->id }}" class="text-gray-600">Quantity:</label>
                                    <input type="number" id="quantity_{{ $material->id }}" name="quantity_{{ $material->id }}" value="1" min="1" class="w-20 px-2 py-1 border rounded-md">
                                </div>
                                <div class="mt-4">
                                    @if(!$customer->cart->material()->where('material_id', $material->id)->exists())
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Add to Cart
                                        </button>
                                    @else
                                        <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded cursor-not-allowed" disabled>
                                            Already in Cart
                                        </button>
                                    @endif
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeMaterialModal('{{ $material->id }}')">Close</button>
            </div>
        </div>
    </div>c
</div>

{{-- JavaScript to handle modal --}}
<script>
    function openMaterialModal(materialId) {
        var modal = document.getElementById("materialModal_" + materialId);
        modal.style.display = "block";
    }

    function closeMaterialModal(materialId) {
        var modal = document.getElementById("materialModal_" + materialId);
        modal.style.display = "none";
    }
</script>
