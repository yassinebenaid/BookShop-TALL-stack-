<div class="p-5 mt-10">
    <div class="py-2 pt-4 text-2xl font-semibold tracking-wide cursor-pointer w-max">
        From Stock <i class="text-lg bi bi-chevron-right"></i>
    </div>

    <div class="flex flex-wrap justify-center gap-5">

        @foreach ($books as $book)
            <livewire:book.book-card :book="$book" wire:key='$book->id' />
        @endforeach
    </div>
</div>
