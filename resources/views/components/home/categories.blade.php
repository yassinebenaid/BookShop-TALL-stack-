@props(['current' => request('category')?->name])

<div class="relative" x-data="showmore" x-on:click.outside="opened = 12">

    <div class="relative grid items-center grid-cols-12 py-2 bg-white">

        @foreach ($categories as $category)
            @once
                <a href="{{ route('home') }}" x-show="{{ $loop->index }} < opened" x-transition
                    class="py-2 pb-6 font-semibold tracking-wider text-black/60">

                    <div :class="{ 'text-black hover:text-black': '{{ $current }}' == '' }"
                        class="px-5 duration-200 cursor-pointer w-max hover:text-orange-500">
                        Home
                    </div>

                </a>
            @endonce


            <a href="{{ route('home', $category->name) }}" x-cloak x-show="{{ $loop->index + 1 }} < opened" x-transition
                class="py-2 pb-6 font-semibold tracking-wider text-black/60">

                <div :class="{ 'text-black hover:text-black text-lg': '{{ $current }}' == '{{ $category->name }}' }"
                    class="px-5 duration-200 cursor-pointer w-max hover:text-orange-500">
                    {{ $category->name }}
                </div>

            </a>
        @endforeach

    </div>


    <div x-on:click="toggle" :class="{ 'rotate-90 ': opened !== 12 }"
        class="absolute top-0 right-0 p-4 text-xl transition-transform cursor-pointer "
        aria-label="show more categories" title="show more categories">
        <i class="bi bi-chevron-right "></i>
    </div>


    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('showmore', () => ({
                opened: 12,
                get toggle() {
                    (this.opened === 100) ? (this.opened = 12) : (this.opened = 100)
                }
            }))
        })
    </script>

</div>
