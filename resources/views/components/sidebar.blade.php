<aside class="w-64 h-screen bg-gray-900 text-white flex flex-col">

    <div class="p-4 text-xl font-semibold border-b border-gray-700">
        Akuntansi
    </div>

    <nav class="flex-1 px-4 space-y-2 mt-4">

        <a href="/dashboard"
            class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>

        <a href="/buku-besar"
            class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->is('buku-besar') ? 'bg-gray-700' : '' }}">
            Buku Besar
        </a>

        <a href="/laporan"
            class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->is('laporan') ? 'bg-gray-700' : '' }}">
            Laporan
        </a>

        <a href="/pengaturan"
            class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->is('pengaturan') ? 'bg-gray-700' : '' }}">
            Pengaturan
        </a>
    </nav>

    <a href="/logout"
       class="bg-red-600 hover:bg-red-700 text-center py-3 mt-auto">
        Logout
    </a>

</aside>
