<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (isset($title))
            <title>
                {{ $title }} | Blog Nelson
            </title>
        @endif

        <x-partials.head />
        <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->

        <link rel="stylesheet" href="{{ asset('css/base.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
        @bukStyles(true)
        @stack('styles')



        <style>
            body {
                background: transparent;
                color: #000;
            }
            .choices__input {
                color: black;
            }
        </style>
    </head>
    <body>

        <div class="flex flex-row">
            <div class="px-4 py-8 w-1/6 bg-gray-900">
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo02.png') }}" alt="Image Logo" class="w-full h-20"></a>

                <x-partials.nav-admin />
            </div>
            <div class="px-3 py-6 w-full">
                <div class="flex flex-row justify-end">
                    <x-dropdown-admin />
                </div>
                <div class="font-sans antialiased">
                {{ $slot }}
            </div>
            </div>
        </div>

        @livewireScripts
        @bukScripts(true)
        <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

        <!-- <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script> -->
        <script>
            window.addEventListener('swal:modal', event => {
                swal({
                    title: event.detail.message,
                    text: event.detail.text,
                    icon: event.detail.type,
                });
            });
        </script>
        @stack('scripts')
    </body>
</html>
