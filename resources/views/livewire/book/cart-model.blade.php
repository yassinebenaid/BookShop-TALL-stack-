<div x-data="{ shown: false, newItem: false }" x-on:new-item.window="newItem = true">

    <div x-on:click="shown=true;newItem=false" wire:click="refresh"
        class="relative flex flex-col items-center justify-center duration-200 cursor-pointer hover:text-orange-500 ">
        <i class="text-2xl bi bi-bag"></i>

        <span>Cart</span>

        <small x-show="newItem" x-cloak
            class="bg-orange-600 text-xs text-white absolute rounded-lg px-1 top-0 right-0">N</small>
    </div>

    <div x-cloak x-show="shown" class="fixed top-0 left-0 grid items-center justify-center w-screen h-screen bg-black/30">

        <div x-on:click.outside="shown=false" x-show="shown" x-cloak x-transition
            class="bg-white w-[50rem] p-4 rounded-lg h-[40rem] relative">

            <header class="flex justify-between px-2">
                <div class="text-xl">Cart</div>
                <div x-on:click="shown=false" class="p-1 cursor-pointer">
                    <i class="bi bi-x-lg"></i>
                </div>
            </header>

            <div class="h-[74%] p-2 mt-3 overflow-y-scroll">

                @forelse ($books as $book)
                    <div class="flex items-center justify-between border-b pr-5">
                        <div class="flex gap-6 p-2 ">

                            {{-- delete button --}}
                            <div wire:click="removeFromCart('{{ $book->id }}')"> <i
                                    class="bi bi-x-lg cursor-pointer text-xl text-red-500"></i></div>


                            <img class="h-32 w-24"
                                src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                                alt="">
                            <div class="flex flex-col">
                                <a href="{{ route('book.show', $book->id) }}"
                                    class="font-bold hover:underline">{{ $book->name }}</a>
                                <span
                                    class="text-neutral-500 text-sm">{{ $book->author }},{{ $book->release_year }}</span>
                                <span class="text- xl">{{ number_format($book->discounted_price, 2) }}$</span>
                            </div>
                        </div>
                        <div class="flex gap-20 items-center">
                            <div class="grid grid-cols-4 items-center gap-4 w-32 h-11 mr-4 rounded-lg">
                                <span><i
                                        class="bi bi-chevron-left text-xl text-neutral-400 cursor-pointer hover:text-2xl duration-50"></i></span>
                                <div
                                    class="border-2 col-span-2 rounded-lg  h-full w-full flex items-center justify-center">
                                    1</div>
                                <span><i
                                        class="bi bi-chevron-right text-xl text-neutral-400 cursor-pointer hover:text-2xl duration-100"></i></span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-neutral-500 text-center">
                        Cart is empty
                    </div>
                @endforelse

            </div>

            <div class="grid justify-end">
                <div class="px-4 py-3 h-32 flex flex-col justify-between">
                    <div class="text-2xl text-orange-500 tracking-wide"><span class="text-sm text-slate-600">Total:
                        </span>452$</div>
                    <div
                        class="bg-orange-500 text-white px-4 py-2 rounded-lg cursor-pointer hover:shadow-lg shadow-orange-500">
                        Next</div>
                </div>
            </div>


            <div wire:loading class="w-full h-full absolute left-0 top-10">
                <div class="bg-white rounded-b-lg w-full h-full grid justify center items-center backdrop-blur-sm">
                    <x-widgets.loading />
                </div>
            </div>

        </div>
    </div>

</div>
