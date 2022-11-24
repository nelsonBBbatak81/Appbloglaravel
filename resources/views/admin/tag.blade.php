<x-admin-layout>
    <x-slot name="title">{{ __('Tag Admin') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:tag.index />
            </div>
        </div>
    </div>
</x-admin-layout>