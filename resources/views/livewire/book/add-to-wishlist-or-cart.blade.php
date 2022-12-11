<div class="flex items-center">
    <button wire:click='toggleToCart'
        class="px-6 py-3 mx-4 text-white transition bg-orange-600 rounded-lg shadow shadow-orange-500 hover:shadow-orange-700 hover:shadow-lg">
        Add to cart
    </button>

    @auth
        <button wire:click='addToWishlist' id="{{ $book->id }}"
            class="px-2 pt-2 mx-4 text-3xl text-orange-600 transition border-2 border-orange-500 rounded-lg hover:bg-orange-600 hover:text-white">
            <i class="bi  {{ $liked ? 'bi-heart-fill text-red-500' : 'bi-heart' }}"></i>
        </button>
    @endauth
</div>
