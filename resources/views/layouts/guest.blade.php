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
        @else
            <title>
                Blog Nelson
            </title>
        @endif

        <link
      href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css"
      rel="stylesheet"
    />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous"/>

        <x-partials.head />
        @bukStyles(true)
    </head>
    <body>
        <x-partials.navigation />

        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        @livewireScripts
        @bukScripts(true)

        <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>
        <script src="https://unpkg.com/embla-carousel/embla-carousel.umd.js"></script>
    </body>
</html>
