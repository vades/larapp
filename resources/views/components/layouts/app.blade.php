<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="Description" content="{{ $description ?? 'This is LARAPP' }}">
        <title>{{ $title ?? 'LARAPP' }}</title>

        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="flex flex-col h-screen justify-between">
        <header class="bg-skin-header">
            <section class="flex justify-between items-center container mx-auto p-3 md:p-4">
                <div>app-header-brand</div>
                <div>pp-header-nav</div>
            </section>
        </header>

        <main class="mb-auto container mx-auto p-3 md:pt-4 md:pb-4">
            {{ $slot }}
        </main>
        <section>

            <div class="container mx-auto p-4">
                <div>app-footer-supplementary </div>

            </div>
        </section>
        <footer class="bg-skin-footer border-t border-skin-footer">
            <section class="container mx-auto text-center text-sm p-4 md:flex justify-between items-center text-skin-footer">
                <div>app-footer-copyright</div>
                <div>app-footer-nav</div>
            </section>
        </footer>
    </div>

    </body>
</html>
