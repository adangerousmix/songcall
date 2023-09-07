<!DOCTYPE html>
<html data-theme="night" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Song Call' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen font-sans antialiased">
        <!-- The navbar with `sticky` -->
        <x-nav sticky>
            <x-slot:brand>
                Song Call
            </x-slot:brand>

            <!-- Right side actions -->
            <x-slot:actions>
                <a href="#"><x-icon name="o-x-circle" /> Stop</a>
                <a href="#"><x-icon name="o-no-symbol" /> End</a>
            </x-slot:actions>
        </x-nav>
        <!-- The main content -->
        <x-main>
            <!-- The `$slot` goes here -->
            <x-slot:content>
                {{ $slot }}
            </x-slot:content>
        </x-main>
    </body>
</html>
