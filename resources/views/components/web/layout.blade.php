<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $description ?? config('myapp.metaDescription') }}">
        <meta name="keywords" content="{{ $description ?? config('myapp.metaKeywords') }}">
        <title>{{ $title ??  config('myapp.metaTitle') }}</title>

        @vite(["resources/scss/" . config('myapp.project') . "/app.scss", 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
