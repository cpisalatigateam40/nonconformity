<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Nonconformity')</title>

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: konfigurasi warna kustom --}}
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#2563eb',
                    success: '#16a34a',
                    warning: '#facc15',
                    danger: '#dc2626',
                }
            }
        }
    }
    </script>

    @stack('styles')
</head>

<body class=" min-h-screen flex flex-col" style="background: #E7EEFF;">

    {{-- Topbar --}}
    @include('layouts.topbar')

    {{-- Main Content --}}
    <main class="flex-1 py-8 md:py-6 container max-w-7xl mx-auto ">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    @yield('script')
</body>

</html>