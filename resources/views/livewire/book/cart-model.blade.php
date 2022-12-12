<div x-data="cart" x-on:new-item-in-cart.window="newItem = true">

    <div x-on:click="shown=true;newItem=false" wire:click="refresh"
        class="relative flex flex-col items-center justify-center duration-200 cursor-pointer hover:text-orange-500 ">
        <i class="text-2xl bi bi-bag"></i>

        <span>Cart</span>

        <small x-show="newItem" x-cloak
            class="absolute top-0 right-0 px-1 text-xs text-white bg-orange-600 rounded-lg">N</small>
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
                    <div x-init="total += {{ number_format($book->discounted_price, 0) }}" class="flex items-center justify-between pr-5 border-b">
                        <input type="hidden" x-model="total" value=>
                        <div class="flex gap-6 p-2 ">

                            {{-- delete button --}}
                            <div wire:click="removeFromCart('{{ $book->id }}')"
                                x-click="decTotal({{ number_format($book->discounted_price, 2) }})">

                                <i class="text-xl text-red-500 cursor-pointer bi bi-x-lg"></i>
                            </div>


                            <img class="w-24 h-32"
                                src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                                alt="">
                            <div class="flex flex-col">
                                <a href="{{ route('book.show', $book->id) }}"
                                    class="font-bold hover:underline text-slate-700">{{ $book->name }}</a>
                                <span
                                    class="text-sm text-neutral-500">{{ $book->author }},{{ $book->release_year }}</span>
                                <span class="text-slate-700">{{ number_format($book->discounted_price, 2) }}$</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-20">
                            <div x-data="{ count: 1 }"
                                class="grid items-center w-32 grid-cols-4 gap-4 mr-4 rounded-lg h-11">
                                <span x-on:click="count--;total -= {{ number_format($book->discounted_price, 0) }}">
                                    <i
                                        class="text-xl cursor-pointer bi bi-chevron-left text-neutral-400 hover:text-2xl duration-50"></i>
                                </span>

                                <div x-text="count"
                                    class="flex items-center justify-center w-full h-full col-span-2 border-2 rounded-lg">
                                    1
                                </div>

                                <span x-on:click="count++;total += {{ number_format($book->discounted_price, 0) }}"><i
                                        class="text-xl duration-100 cursor-pointer bi bi-chevron-right text-neutral-400 hover:text-2xl"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-neutral-500">
                        Cart is empty
                    </div>
                @endforelse

            </div>

            <div class="grid justify-end">
                <div class="flex flex-col justify-between h-32 px-4 py-3">
                    <div class="text-2xl tracking-wide text-orange-500"><span class="text-sm text-slate-600">Total:
                        </span> <span x-text="total"></span>$</div>
                    <div
                        class="px-4 py-2 text-white bg-orange-500 rounded-lg cursor-pointer hover:shadow-lg shadow-orange-500">
                        Next</div>
                </div>
            </div>


            <div wire:loading class="absolute left-0 w-full h-full top-10">
                <div class="grid items-center w-full h-full bg-white rounded-b-lg justify center backdrop-blur-sm">
                    <x-widgets.loading />
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("cart", () => ({
                shown: false,
                newItem: false,
                prices: [],
                total: 0,

                incTotal(value) {
                    this.total += value
                },

                decTotal(value) {
                    this.total -= value
                },

            }))
        })
    </script>

</div>
