@props(['book'])
<div class="flex flex-col gap-5 px-5 pt-20">
    <div class="pt-3">
        <div class="grid w-full grid-cols-2 p-2 ">
            <span class="font-semibold text-x">Author</span>
            <span>{{ $book->author }}</span>
        </div>
        <div class="grid w-full grid-cols-2 p-2 ">
            <span class="font-semibold text-x">Release year</span>
            <span>{{ $book->release_year }}</span>
        </div>
        <div class="grid w-full grid-cols-2 p-2 ">
            <span class="font-semibold text-x">Pages</span>
            <span>{{ $book->pages_count }}</span>
        </div>
        <div class="grid w-full grid-cols-2 p-2 ">
            <span class="font-semibold text-x">Age classing</span>
            <span>{{ $book->age_class }}+</span>
        </div>
        <div class="grid w-full grid-cols-2 p-2 ">
            <span class="font-semibold text-x">Category</span>
            <span>{{ $book->category->name }}</span>
        </div>
    </div>

    <livewire:book.add-to-wishlist-or-cart :book="$book" />

</div>
