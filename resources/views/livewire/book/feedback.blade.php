<div class="relative p-5 pb-10">
    <div class="relative text-xl font-bold tracking-wider w-max">Feedbacks
        <span
            class="absolute px-1 text-xs font-light text-white bg-orange-600 rounded-full right-8">{{ $reviews->count() }}</span>
        <i class="mx-4 text-sm bi bi-chevron-right"></i>
    </div>
    <div class="relative w-2/3 ">

        @if ($reviews->count() > 2)
            <div class="absolute z-20 flex justify-between w-[110%] top-1/2 -left-14 ">
                <button><i class="bi bi-chevron-left"></i></button>
                <button><i class="bi bi-chevron-right"></i></button>
            </div>
        @endif


        <div class="flex gap-3 py-4 overflow-x-scroll cool-scroll">

            @forelse ($reviews as $review)
                <div class="p-3 rounded-2xl h-min shrink-0 w-80 bg-neutral-100">
                    <div class="flex justify-between font-bold">
                        <span>{{ $review->user->name }}</span>

                        <div class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $review->rate)
                                    <span><i class="text-orange-500 bi bi-star-fill"></i></span>
                                @else
                                    <span><i class="text-orange-500 bi bi-star"></i></span>
                                @endif
                            @endfor
                        </div>
                    </div>

                    <span class="block p-1 text-md">
                        {{ $review->body }}
                    </span>

                    <span class="block text-xs text-gray-400">{{ $review->created_at->format('d M Y H:i') }}</span>
                </div>
            @empty
                <div class="text-sm text-neutral-400">
                    No reviews yet, be the first one who add a feedback
                </div>
            @endforelse

        </div>
    </div>




    <div x-data="{ shown: 0 }">
        <div x-on:click="shown=1" class="relative py-3 text-xl font-bold tracking-wider cursor-pointer w-max"><i
                class="bi bi-pen-fill"></i> add review
            <i class="mx-4 text-sm bi bi-chevron-right"></i>
        </div>

        @auth

            <div x-transition x-cloak x-show="shown" x-on:click.outside="shown=0" class="grid w-2/3 grid-cols-3 gap-5 p-5">

                <form wire:submit.prevent='save' class="flex flex-col items-end col-span-2">
                    <div class="w-full">
                        <textarea wire:model.defer="feedback.body"
                            class="w-full rounded-lg resize-none border-neutral-300 focus:ring-orange-500 focus:border-transparent bg-neutral-50 placeholder:text-slate-400"
                            placeholder="what do you thing ?"></textarea>
                        @error('feedback.body')
                            <span class="text-sm tracking-wider text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="px-5 py-2 text-white bg-orange-500 rounded-lg">save</button>
                </form>

                <div class="grid justify-center">
                    <div class="flex gap-4 text-4xl text-orange-500">

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $feedback['rate'])
                                <i wire:click="$set('feedback.rate',{{ $i }})"
                                    class="cursor-pointer bi bi-star-fill"></i>
                            @else
                                <i wire:click="$set('feedback.rate',{{ $i }})"
                                    class="cursor-pointer bi bi-star"></i>
                            @endif
                        @endfor

                    </div>
                </div>
            </div>
        @else
            <div x-transition x-cloak x-show="shown" x-on:click.outside="shown=0"
                class="flex flex-col items-center justify-center w-4/5 gap-2 ">
                <div class="w-32">
                    <x-widgets.sorry-icon />
                </div>
                <div>
                    please
                    <a class="text-blue-500" href="{{ route('login') }}">login</a> or
                    <a class="text-blue-500" href="{{ route('register') }}">register</a>
                    to be able to add your feedback
                </div>
            </div>
        @endauth
    </div>
</div>
