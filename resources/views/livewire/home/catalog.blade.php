<div class="grid grid-cols-12 gap-5 ">

    <div class="flex flex-wrap col-span-9 py-5 pt-10 gap-7">


        @forelse ($books as $book)
            <livewire:book.book-card :book='$book' :wire:key='$book->id'>

            @empty
                <div class="flex flex-col items-center w-40 gap-2 m-auto ">
                    <x-widgets.sorry-icon />
                    <span class="font-light tracking-widest text-slate-400">No results</span>
                </div>
        @endforelse


        <div class="w-full">
            {{ $books->links() }}
        </div>
    </div>





    {{-- filters --}}

    <div class="col-span-3 py-10 bg-white">

        <div class="sticky top-52">

            {{-- search --}}
            <div class="relative">
                <div class="relative flex justify-center py-5">
                    {{-- <form wire:submit.prevent='search'> --}}
                    <button type="submit">
                        <i class="absolute bi bi-search left-20 top-7 text-slate-400"></i>
                    </button>
                    <input wire:keyup.enter='$set("filters.keywords",$event.target.value)' type="search"
                        placeholder="book name,author..."
                        class="pl-12 border rounded-lg w-60 border-slate-300 focus:ring-0 focus:border-orange-300 placeholder:text-neutral-400 placeholder:font-light">
                    {{-- </form> --}}
                </div>
                <span class="absolute bottom-0 text-xs left-14 text-slate-400">press <span
                        class="px-1 py-1 bg-gray-100 rounded-md">Enter</span> to save
                </span>
            </div>

            {{-- year --}}
            <div x-data="{ opened: false, selected: 0 }" class="relative flex justify-center py-5">

                <div x-on:click="opened=true" class="flex justify-between w-full px-20 text-lg cursor-pointer">
                    <span x-text="selected != 0 ? selected : 'release year'"></span>
                    <i :class="{ 'rotate-180': opened }" class="transition-transform bi bi-chevron-up"></i>
                </div>

                <div x-cloak x-show="opened" x-on:click.outside="opened=false"
                    class="absolute z-10 flex flex-col overflow-scroll bg-white shadow-lg top-14 max-h-60">

                    <span wire:click="$set('filters.year','any')" x-on:click="selected = 'any';opened=false"
                        class="px-20 py-2 border-b cursor-pointer hover:text-orange-500 hover:bg-neutral-100">any</span>

                    @for ($i = 2022; $i > 1970; $i--)
                        <span wire:click="$set('filters.year',{{ $i }})"
                            x-on:click="selected = {{ $i }};opened=false"
                            class="px-20 py-2 border-b cursor-pointer hover:text-orange-500 hover:bg-neutral-100">{{ $i }}</span>
                    @endfor
                </div>

            </div>

            {{-- rate --}}
            <div class="relative flex flex-col items-center justify-start gap-2 py-5 text-xl">

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="1" class="cursor-pointer"> 8+ </label>
                    <input wire:model="filters.ages" value="8" type="checkbox" id="1"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="2" class="cursor-pointer"> 10+ </label>
                    <input wire:model="filters.ages" value="10" type="checkbox" id="2"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="3" class="cursor-pointer"> 12+ </label>
                    <input wire:model="filters.ages" value="12" type="checkbox" id="3"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="4" class="cursor-pointer"> 13+ </label>
                    <input wire:model="filters.ages" value="13" type="checkbox" id="4"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="5" class="cursor-pointer"> 17+ </label>
                    <input wire:model="filters.ages" value="17" type="checkbox" id="5"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

                <div class="flex justify-between pl-20 cursor-pointer w-60">
                    <label for="6" class="cursor-pointer"> 21+ </label>
                    <input wire:model="filters.ages" value="21" type="checkbox" id="6"
                        class="p-3 rounded-md cursor-pointer border-slate-400 checked:bg-orange-600 ">
                </div>

            </div>




            {{-- price --}}
            <div>

                <form wire:submit.prevent='filterByPrice' x-data="{ focused: false }"
                    class="flex flex-col items-center gap-3">
                    <div class="flex justify-center ">
                        <div class="flex flex-col">
                            <label class="text-sm text-neutral-500">From</label>
                            <input wire:model.defer="filters.price.min" type="number" placeholder="0 $"
                                class="w-32 border rounded-l-lg border-slate-300 focus:ring-0 focus:border-orange-300 placeholder:text-neutral-300 placeholder:font-light">
                        </div>

                        <div class="flex flex-col">
                            <label class="text-sm text-neutral-500">To</label>
                            <input wire:model.defer='filters.price.max' type="number" placeholder="99999 $"
                                class="w-32 border rounded-r-lg border-slate-300 focus:ring-0 first-letter:focus:ring-0 focus:border-orange-300 placeholder:font-light placeholder:text-neutral-300">
                        </div>
                    </div>

                    <button class="self-end block px-4 py-1 text-white bg-orange-500 rounded-md mr-14">save</button>
                </form>

            </div>

        </div>

    </div>

    <div wire:loading>
        <x-widgets.loading />
    </div>
</div>
