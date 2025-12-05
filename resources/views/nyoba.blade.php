<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Layout</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Manajemen App</h1>
        <div class="space-x-4">
            <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            <a href="#" class="text-gray-700 hover:text-blue-600">Logout</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="max-w-5xl mx-auto mt-10 p-10 bg-white shadow-lg rounded-xl text-center">
        <h2 class="text-3xl font-bold mb-3">Selamat Datang di Sistem Manajemen</h2>
        <p class="text-gray-600 mb-6">Kelola data, laporan, dan aktivitas bisnis Anda dengan mudah.</p>
        <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">Mulai Sekarang</a>
    </header>

    <!-- Features Section -->
    <section class="max-w-5xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-blue-500 text-white rounded-xl shadow">
            <h3 class="text-xl font-bold mb-2">Dashboard</h3>
        </div>

        <div class="p-6 bg-green-500 text-white rounded-xl shadow">
            <h3 class="text-xl font-bold mb-2">Manajemen Data</h3>
        </div>

        <div class="p-6 bg-purple-500 text-white rounded-xl shadow">
            <h3 class="text-xl font-bold mb-2">Laporan</h3>
        </div>
    </section>

</body>
</html>
