<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title ?? 'Aplikasi Manajemen' }}</title>
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow p-4 mb-6">
        <div class="max-w-6xl mx-auto flex justify-between">
            <h1 class="font-bold text-xl">Manajemen App</h1>

            <div class="flex gap-4">
                <a href="/dashboard" class="hover:text-blue-600">Dashboard</a>
                <a href="/buku-besar" class="hover:text-blue-600">Buku Besar</a>
                <a href="/buku-kecil" class="hover:text-blue-600">Buku Kecil</a>
                <a href="/kas" class="hover:text-blue-600">Kas</a>
                <a href="/neraca" class="hover:text-blue-600">Neraca</a>
            </div>
        </div>
    </nav>

    {{-- HALAMAN CONTENT --}}
    <div class="max-w-6xl mx-auto bg-white shadow p-6 rounded">
        @yield('content')
    </div>

</body>
</html>
