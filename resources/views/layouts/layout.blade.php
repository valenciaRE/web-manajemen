<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Akuntansi' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 h-screen bg-gray-900 text-gray-200 fixed">
        <div class="p-4 text-xl font-bold border-b border-gray-700">Akuntansi</div>

        <nav class="mt-4">
            <a href="/dashboard"
               class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
                Dashboard
            </a>

            <a href="/buku-besar"
               class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('buku-besar') ? 'bg-gray-700' : '' }}">
                Buku Besar
            </a>

            <a href="/laporan"
               class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('laporan') ? 'bg-gray-700' : '' }}">
                Laporan
            </a>

            <a href="/pengaturan"
               class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('pengaturan') ? 'bg-gray-700' : '' }}">
                Pengaturan
            </a>

            <form action="/logout" method="POST" class="mt-4 px-6">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="ml-64 p-6 w-full">
        @yield('content')
    </main>

</div>

</body>
</html>