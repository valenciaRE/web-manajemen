<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ $title ?? 'Sistem Akuntansi' }}</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    /* small polish */
    .table-fixed th, .table-fixed td { white-space: nowrap; }
    .scroll-shadow { box-shadow: inset 0 -20px 20px -20px rgba(0,0,0,0.2); }
  </style>
</head>
<body class="flex bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen">

  <!-- SIDEBAR -->
  <aside id="sidebar" class="w-64 bg-gray-900 dark:bg-gray-950 text-white min-h-screen transition-all duration-300">
    <div class="p-6 flex items-center justify-between">
      <h1 class="text-xl font-semibold">Akuntansi</h1>
      <button onclick="toggleSidebar()" class="p-2 bg-gray-800 rounded hidden md:inline">☰</button>
    </div>

    <nav class="mt-2">
      <a class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('dashboard') ? 'bg-gray-700' : '' }}" href="/dashboard">Dashboard</a>
      <a class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('buku-besar') ? 'bg-gray-700' : '' }}" href="/buku-besar">Buku Besar</a>
      <a class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('laporan') ? 'bg-gray-700' : '' }}" href="/laporan">Laporan</a>
      <a class="block px-6 py-3 hover:bg-gray-700 {{ request()->is('pengaturan') ? 'bg-gray-700' : '' }}" href="/pengaturan">Pengaturan</a>

      <form method="POST" action="/logout" class="px-6 mt-6">
        @csrf
        <button class="w-full bg-red-600 hover:bg-red-700 py-2 rounded">Logout</button>
      </form>
    </nav>
  </aside>

  <!-- MAIN -->
  <main class="flex-1 p-6 lg:p-8">
    <!-- Small top controls -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h2 class="text-2xl font-bold">@yield('page-title','Dashboard')</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">@yield('page-subtitle')</p>
      </div>

      <!-- theme toggle (icon only) -->
      <div class="flex items-center gap-3">
        <button id="themeBtn" onclick="toggleTheme()" class="p-2 rounded bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-900 shadow">
          🌓
        </button>
      </div>
    </div>

    @yield('content')
  </main>

  <script>
    // sidebar collapse for small screens
    function toggleSidebar(){
      const sb = document.getElementById('sidebar');
      sb.classList.toggle('w-20');
      sb.classList.toggle('w-64');
    }

    // theme
    document.addEventListener('DOMContentLoaded', ()=> {
      if(localStorage.getItem('theme')==='dark') document.documentElement.classList.add('dark');
    });
    function toggleTheme(){
      const html = document.documentElement;
      html.classList.toggle('dark');
      localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    }
  </script>

</body>
</html>
