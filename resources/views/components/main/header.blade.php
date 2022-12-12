<div class="sticky z-50 p-3 select-none -top-10 bg-neutral-50">
    <div class="flex justify-between w-4/5 pb-5 m-auto">
        <div>
            <i class="bi bi-globe"></i> en
        </div>
        <div>
            {{ now()->format('Y-m-d H:i') }} <i class="bi bi-clock"></i>
        </div>
    </div>


    <div class="grid items-end w-4/5 grid-cols-8 m-auto gap-">

        <a href="{{ route('home') }}" class="flex justify-start col-span-2 text-4xl ">
            <div class="text-center">
                Shipped
                <div class="text-sm">
                    Books are a uniquely portable magic.
                </div>
            </div>
        </a>

        <livewire:home.search-bar />


        <div class="flex justify-end col-span-2 gap-7 px-7 ">

            @auth
                <livewire:book.wishlist />
            @endauth


            <livewire:book.cart-model />

            <div x-data="{ shown: false }" class="relative">
                <div x-on:click="shown=true"
                    class="relative flex flex-col items-center justify-center duration-200 cursor-pointer hover:text-orange-500">
                    <i class="text-2xl bi bi-person"></i>
                    <span>Account</span>
                </div>
                <div x-on:click.outside="shown=false" x-cloak x-show="shown" x-transition:enter="transition "
                    class="absolute flex flex-col px-4 py-2 bg-white rounded-lg shadow-lg -right-1/2 top-full w-80 ">

                    @auth

                        <div class="p-2 py-3 bg-white border-b">
                            <span class="text-xl text-start">{{ auth()->user()->name }}</span>
                            <span class="text-neutral-400 text-start">{{ auth()->user()->email }}</span>
                        </div>
                    @else
                        <div class="flex flex-col w-full gap-3">
                            <a class="flex-1 px-4 py-2 text-white bg-blue-500 rounded-lg"
                                href="{{ route('register') }}">register</a>
                            <a class="flex-1 px-4 py-2 text-white rounded-lg bg-slate-800"
                                href="{{ route('login') }}">login</a>
                        </div>
                    @endauth

                    <div class="flex flex-col py-2 text-neutral-600">
                        <a href="{{ route('dashboard') }}"
                            class="px-3 py-2 text-blue-600 transition-all hover:pl-6 hover:bg-neutral-50"> Dashboard
                        </a>
                        <div class="px-3 py-2 transition-all hover:pl-6 hover:bg-neutral-50"> about us </div>
                        <div class="px-3 py-2 transition-all hover:pl-6 hover:bg-neutral-50"> contact us </div>
                        <div class="px-3 py-2 transition-all hover:pl-6 hover:bg-neutral-50"> terms </div>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    class="flex justify-between px-3 py-2 mt-4 transition-all hover:pl-6 hover:bg-neutral-50"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }} <i class="bi bi-arrow-bar-right"></i>
                                </x-dropdown-link>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
