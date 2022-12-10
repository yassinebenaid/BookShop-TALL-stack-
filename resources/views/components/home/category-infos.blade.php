@props(['category'])
<div class="mt-5 ">
    <x-widgets.section-navigator :category="$category->name" />

    <div class="grid items-end grid-cols-3">
        <div class="col-span-2 text-5xl font-semibold tracking-wide">

            {{ $category->name }}

            <span class="text-sm text-neutral-500">
                {{ $category->books_count }} item
            </span>
        </div>

        <div class="text-sm text-neutral-500">
            reverse <i class="bi bi-chevron-right "></i>
        </div>
    </div>
</div>
