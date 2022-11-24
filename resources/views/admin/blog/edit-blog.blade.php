<x-admin-layout>
    <x-slot name="title">{{ __('Blog Admin') }}</x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:blog.edit-blog :blog="$blog" />
            </div>
        </div>
    </div>
</x-admin-layout>
