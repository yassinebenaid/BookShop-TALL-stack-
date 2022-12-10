<x-main-layout>
    <x-main.header />

    <div class="w-4/5 m-auto">
        <x-home.categories />

        <x-widgets.section-navigator :category="$book->category->name" :book="$book->name" />

        <div class="grid grid-cols-3">
            <div class="col-span-2">

                <x-book.main-info :book="$book" />

            </div>

            <x-book.details-and-control :book="$book" />
        </div>


        <livewire:book.feedback :book="$book" />

        <div class="w-5/6 py-10 pb-20">
            <div x-on:click="shown=1" class="relative py-3 text-2xl font-bold tracking-wider cursor-pointer w-max">
                You may also like
                <i class="mx-4 text-sm bi bi-chevron-right"></i>
            </div>
            <div class="flex flex-wrap gap-5 p-4">

                @foreach ($similars as $book)
                    <livewire:book.book-card :book="$book" />
                @endforeach
            </div>
        </div>
    </div>

    <x-main.footer />

    <x-widgets.go-to-top-button />
</x-main-layout>
