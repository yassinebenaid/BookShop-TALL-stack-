<div x-data="{ showed: false }" x-on:mouseenter="showed=true" x-on:mouseleave="showed=false"
    class="grid w-48 px-3 py-2 font-semibold grid-rows-12">



    <div class="relative w-48 col-span-7 overflow-hidden">


        @if ($withDiscount)
            <div class="absolute px-5 py-20 text-sm rotate-45 bg-orange-600/80 -top-14 left-5">
                <span class="absolute text-white -rotate-45 -translate-x-1/2 left-1/2">{{ $book->discount }}% </span>
            </div>
        @endif


        <div class="absolute flex w-full py-2 bottom-4 justify-evenly">

            @auth
                <div wire:click="addToWishlist" x-cloak x-show="showed" x-transition.0
                    class="px-3 pt-3 pb-1 rounded-[50%] text-2xl text-white  bg-orange-500/90 cursor-pointer right-8 bottom-5">
                    <i class="bi {{ $liked ? 'bi-heart-fill text-red-500' : 'bi-heart' }}"></i>
                </div>
            @endauth

            <div wire:click='toggleToCart' x-show="showed" x-transition.scale.0 x-cloak
                class="px-3 pt-3 pb-1 rounded-[50%] text-2xl text-white  bg-orange-500/90 cursor-pointer left-8 bottom-5">
                <i class="bi {{ $inCart ? 'bi-cart-fill' : 'bi-cart' }}"></i>
            </div>
        </div>



        <img class="w-48"
            src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
            alt="">
    </div>




    <a href="{{ route('book.show', $book->id) }}" class="col-span-5 px-5 w-52">

        <div class="truncate">{{ $book->name }}</div>
        <div class="text-xs font-normal tracking-widest text-neutral-400">
            {{ substr($book->author, 0, 19) }},{{ $book->release_year }}
        </div>

        <div class="flex justify-between">
            <div class="text-sm">
                <i class="text-orange-500 bi bi-star-fill"></i> 4.5
            </div>
            <div class="self-end">
                <div class="inline mx-1 text-xs font-light line-through text-neutral-400">{{ $book->price }}$ </div>
                {{ number_format($book->discountedPrice, 2) }}$
            </div>
        </div>
    </a>
</div>
