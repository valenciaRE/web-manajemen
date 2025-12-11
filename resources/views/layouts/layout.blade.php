<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-gray-100">

    <!-- SIDEBAR -->
    <aside class="w-64 h-screen bg-white border-r">
        <div class="p-4 text-lg font-semibold border-b">
            Menu
        </div>

        <nav class="p-4 space-y-2">
            <a href="/" class="block px-3 py-2 rounded hover:bg-gray-200">Dashboard</a>
            <a href="{{ route('bukbes') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Buku Besar
            </a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</body>
</html>
