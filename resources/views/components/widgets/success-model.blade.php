<div x-data="{ shown: false, message: null }" x-cloak x-show="shown" x-on:success.window="shown=true;message=$event.detail"
    class="fixed top-0 left-0 z-50 grid items-center justify-center w-screen h-screen bg-black/20">

    <div x-show="shown" x-transition class="flex flex-col gap-2 p-3 text-center bg-white rounded-lg w-96">

        <div>
            <div class="flex items-center justify-center mx-auto my-2 bg-green-100 rounded-full w-14 h-14">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>

            </div>
            <div class="text-2xl ">Success</div>
        </div>

        <div class="text-neutral-400" x-text="message">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto a
        </div>

        <button x-on:click="shown=false" class="py-2 text-white bg-blue-600 rounded-lg px-9">OK</button>
    </div>
</div>
