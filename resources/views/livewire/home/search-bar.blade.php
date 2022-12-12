<div class="relative col-span-4" x-data="{ opened: false }" x-on:click.outside="opened=false">
    <button class="absolute px-5 py-1 left-4 text-neutral-400 top-1"><i class="bi bi-search"></i></button>

    <input wire:model.debounce.200ms="search" x-on:focus="opened=true" type="search"
        placeholder="looking for awsome books ?"
        class="border-0 pl-20 w-full rounded-lg placeholder:text-neutral-400 focus:shadow-lg focus:py-3 focus:rounded-[1rem_1rem_0_0] focus:ring-0">




    <div x-cloak x-show="opened"
        class="absolute flex flex-col flex-wrap z-10 bg-white w-full shadow-lg p-5 rounded-[0_0_1rem_1rem] border-t">

        @foreach ($suggestions as $book)
            <a href="{{ route('book.show', $book->id) }}"
                class="w-full px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100">
                <i class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                {{ $book->name }}
            </a>
        @endforeach

    </div>
</div>
