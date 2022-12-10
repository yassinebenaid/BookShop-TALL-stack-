@props(['book'])

<div>
    <div class="py-4">
        <div class="inline text-4xl font-bold">{{ $book->name }}</div>
        <div class="inline text-lg text-neutral-600">{{ $book->author }}, {{ $book->release_year }}</div>
    </div>

    <div class="grid grid-cols-2 gap-4 p-4">
        <div x-data="{ shown: 1 }" class="flex gap-5">

            <img x-ref="main"
                src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                class="w-80 h-[26rem]">


            <div class="flex flex-col gap-3">

                <img x-on:click="$refs.main.src = $el.src;shown=1" :class="{ 'border border-orange-500': shown == 1 }"
                    class="w-24 h-32 cursor-pointer opacity-70"
                    src="https://media.springernature.com/full/springer-static/cover-hires/book/978-1-4842-2793-0"
                    alt="">
                <img x-on:click="$refs.main.src = $el.src;shown=2" :class="{ 'border border-orange-500': shown == 2 }"
                    class="w-24 h-32 cursor-pointer opacity-70"
                    src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                    alt="">
                <img x-on:click="$refs.main.src = $el.src;shown=3" :class="{ 'border border-orange-500': shown == 3 }"
                    class="w-24 h-32 cursor-pointer opacity-70"
                    src="https://4.bp.blogspot.com/-GKFuvO3ssEk/W5K9cOCT7II/AAAAAAAAIuw/odDHEosfIfIwhuLy_axxHJzIkQKbvjQ7ACLcBGAs/s1600/item_XL_9946258_11948756.jpg"
                    alt="">
            </div>
        </div>


        <div>
            <div class="py-2 text-4xl tracking-wider ">{{ $book->discountedPrice }}$</div>
            <div class="py-2 text-lg">{{ number_format($book->feedback_avg_rate, 1) }} <i
                    class="text-orange-500 bi bi-star-fill"></i>
            </div>

            <div x-data="{ showed: 0 }" class="tracking-wide">
                <span class="px-2">

                    {{ substr($book->description, 0, 705) }}
                    <button x-on:click="showed=1" x-show="!showed"
                        class="text-orange-500 shadow-[-1rem_1rem_30px_1.5rem_white]">show
                        more <i class="bi bi-chevron-up "></i></button>
                </span>
                @if (strlen($book->description) > 705)
                    <div x-cloak x-show="showed" class="fixed top-0 left-0 z-50 w-screen h-screen bg-black/30">
                        <div x-show="showed" x-on:click.outside="showed=0" x-transition
                            class="absolute border-b-8 ring-8 ring-white border-white rounded-lg h-[30rem] overflow-y-scroll  p-8 -translate-x-1/2 -translate-y-1/2 bg-white shadow min-w-[62rem] top-1/2 left-1/2">
                            {{ $book->description }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
