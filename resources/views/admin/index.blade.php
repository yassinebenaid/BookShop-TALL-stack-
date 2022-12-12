<x-main-layout class="bg-slate-100">
    <div class="grid grid-cols-7 ">
        <x-admin.sidebar />
        <div class="col-span-6">
            <x-admin.navbar />

            <div class="h-[57rem] overflow-scroll">
                <x-admin.categories />
            </div>
        </div>
    </div>
</x-main-layout>
