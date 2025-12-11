<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <div class="w-64 min-h-screen bg-gray-900 text-white">
        <div class="p-6 text-xl font-semibold">
            Akuntansi
        </div>

        <nav class="mt-4 space-y-2">
            <a href="/dashboard" class="block px-6 py-3 hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('bukbes') }}" class="block px-6 py-3 hover:bg-gray-700">Buku Besar</a>
            <a href="/laporan" class="block px-6 py-3 hover:bg-gray-700">Laporan</a>
            <a href="/pengaturan" class="block px-6 py-3 hover:bg-gray-700">Pengaturan</a>

            <form method="POST" action="/logout">
                @csrf
                <button class="w-full text-left px-6 py-3 bg-red-600 hover:bg-red-700 mt-4">
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- KONTEN -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</body>
</html>
