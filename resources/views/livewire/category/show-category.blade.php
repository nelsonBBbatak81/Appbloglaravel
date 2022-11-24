<div class="animate__animated animate__fadeInDown max-w-lg mx-auto">
    <div class="flex flex-row justify-end mb-10">
        <x-jet-button type="button" wire:click="back">
            {{ __('Back') }}
        </x-jet-button>
    </div>
    <div class="grid grid-cols-1 gap-2">
        <div class="flex flex-row">
            <p class="w-2/5"><strong>Title</strong></p>
            <p class="w-full">{{ $title }}</p>
        </div>
        <div class="flex flex-row">
            <p class="w-2/5"><strong>Slug</strong></p>
            <p class="w-full">{{ $slug }}</p>
        </div>
        <div class="flex flex-row">
            <p class="w-2/5"><strong>Meta Description</strong></p>
            <p class="w-full">{{ $meta_info }}</p>
        </div>
        <div class="flex flex-row">
            <p class="w-2/5"><strong>Figure</strong></p>
            <img class="w-full h-40" src="{{ asset('storage/images/category/'.$image) }} " />
        </div>
    </div>
</div>
