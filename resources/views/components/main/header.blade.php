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

        <div class="relative col-span-4" x-data="{ opened: false }">
            <button class="absolute px-5 py-1 left-4 text-neutral-400 top-1"><i class="bi bi-search"></i></button>
            <input x-on:focus="opened=true" x-on:blur="opened=false" type="search"
                placeholder="looking for awsome books ?"
                class="border-0 pl-20 w-full rounded-lg placeholder:text-neutral-400 focus:shadow-lg focus:py-3 focus:rounded-[1rem_1rem_0_0] focus:ring-0">

            <div x-cloak x-show="opened"
                class="absolute z-10 bg-white w-full shadow-lg p-5 rounded-[0_0_1rem_1rem] border-t">
                <div class="px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100"><i
                        class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                    pretty good choice</div>
                <div class="px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100"><i
                        class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                    reflext the id</div>
                <div class="px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100"><i
                        class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                    somthing new</div>
                <div class="px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100"><i
                        class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                    greate alpha</div>
                <div class="px-5 py-2 duration-100 cursor-pointer hover:bg-neutral-100"><i
                        class="px-2 pr-4 bi bi-search text-neutral-400"></i>
                    pretty good choice</div>

            </div>
        </div>


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
                        <div class="flex gap-3 w-full flex-col">
                            <a class="bg-blue-500 text-white py-2 px-4 rounded-lg flex-1"
                                href="{{ route('register') }}">register</a>
                            <a class="bg-slate-800 text-white py-2 px-4 rounded-lg flex-1"
                                href="{{ route('login') }}">login</a>
                        </div>
                    @endauth

                    <div class="flex flex-col py-2 text-neutral-600">
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
