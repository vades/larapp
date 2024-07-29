<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Description" content="{{ $description ?? 'This is LARAPP' }}">
        <meta name="keywords" content="{{ $keywords ?? 'key1 key2'}}">
        <title>{{ $title ?? 'LARAPP' }}</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="flex flex-col h-screen justify-between">
            <x-web.partials.header />
        <main class="mb-auto container mx-auto p-3 md:pt-4 md:pb-4">
            {{ $slot }}
        </main>
        <x-web.partials.supplementary />
        <x-web.partials.footer />

    </div>

    </body>
</html>
