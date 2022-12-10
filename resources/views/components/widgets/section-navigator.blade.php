@props(['category', 'book' => false])

<div class="flex gap-2 py-3 tracking-wider text-neutral-500">

    <a href="{{ route('home') }}" class="transition-colors hover:text-orange-500">Home</a>

    @if ($category)
        /
        <a href="{{ route('home', $category) }}" class="transition-colors hover:text-orange-500">
            {{ $category }}
        </a>
    @endif

    @if ($book)
        /
        <div class="transition-colors ">
            {{ $book }}
        </div>
    @endif

</div>
