<div class="fixed z-20  top-0 left-0 w-full h-screen bg-black opacity-80 flex flex-col justify-center transition-all">
<div class="bg-white text-black max-w-md mx-auto mb-10 shadow-md px-4 py-4 animate__animated animate__fadeInDown">
    <div class="flex flex-row justify-between px-2 py-2">
        <h3 class="text-md font-bold">{{ $titlemodal }}</h3>
        <button class="bg-transparent text-xl font-bold text-black transition-all hover:text-slate-300" wire:click="closeModal">x</button>
    </div>
    <div class="py-3 px-6">
        <p class="text-md">{{ $descriptionmodal }}</p>
    </div>
    <div class="flex flex-row justify-end">
        <button class="bg-emerald-500 text-white font-bold text-md px-2 py-2 mr-2 hover:bg-emerald-600" wire:click="deleteItem">Yes</button>
        <button class="bg-stone-500 text-white font-bold text-md px-2 py-2 hover:bg-stone-600" wire:click="closeModal">Cancel</button>
    </div>
</div>
</div>

<div wire:loading wire:target="deleteItem">
    <livewire:components.spinner>
</div>
