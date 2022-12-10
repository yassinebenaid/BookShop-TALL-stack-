<div class="w-4/5 m-auto mb-20">

    <x-home.categories />


    <div>
        <x-home.category-infos />
    </div>

    <div>
        <livewire:home.catalog />
    </div>

    <div wire:loading>
        <x-widgets.loading />
    </div>
    <div>
        <x-widgets.go-to-top-button />
    </div>
</div>
