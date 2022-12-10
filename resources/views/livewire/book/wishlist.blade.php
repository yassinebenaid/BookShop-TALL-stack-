<div x-data="{ shown: 0, newItem: false }" x-on:new-item.window="newItem = true">

    <div x-on:click="shown=true;newItem=false" wire:click="refresh"
        class="relative flex flex-col items-center justify-center duration-200 cursor-pointer hover:text-orange-500 ">
        <i class="text-2xl bi bi-heart"></i>

        <span>Wishlist</span>

        <small x-show="newItem" x-cloak
            class="bg-orange-600 text-xs text-white absolute rounded-lg px-1 top-0 right-0">N</small>
    </div>

    <div x-cloak x-show="shown" class="fixed top-0 left-0 grid items-center justify-center w-screen h-screen bg-black/30">

        <div x-on:click.outside="shown=false" x-show="shown" x-cloak x-transition
            class="bg-white w-[50rem] p-4 rounded-lg h-[40rem] relative">

            <header class="flex justify-between px-2">
                <div class="text-xl">Wishlist</div>
                <div x-on:click="shown=false" class="p-1 cursor-pointer">
                    <i class="bi bi-x-lg"></i>
                </div>
            </header>

            <div class="max-h-[94%] p-2 mt-3 overflow-y-scroll">

                @foreach ($books as $book)
                    <div class="flex items-center justify-between border-b">
                        <div class="flex gap-6 p-2 ">
                            <img class="h-20 w-14"
                                src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                                alt="">
                            <div class="flex flex-col">
                                <a href="{{ route('book.show', $book->id) }}"
                                    class="font-bold hover:underline">{{ $book->name }}</a>
                                <span class="text-neutral-500">{{ $book->author }},{{ $book->release_year }}</span>
                                <span class="text-xl">{{ $book->discounted_price }}$</span>
                            </div>
                        </div>
                        <div>
                            <span wire:click='removeFromWishlist("{{ $book->id }}")'
                                class="px-5 py-3 mx-2 text-white bg-red-500 rounded-lg cursor-pointer">
                                Remove <i class="bi bi-trash"></i></span>
                            <span class="px-5 py-3 mx-2 text-white bg-blue-500 rounded-lg cursor-pointer">
                                add to cart <i class="bi bi-cart"></i></span>
                        </div>
                    </div>
                @endforeach
            </div>


            <div wire:loading class="w-full h-full absolute left-0 top-10">
                <div class="bg-white rounded-b-lg w-full h-full grid justify center items-center backdrop-blur-sm">
                    <x-widgets.loading />
                </div>
            </div>

        </div>
    </div>

</div>
