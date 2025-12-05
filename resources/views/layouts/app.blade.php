<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #2d2d2d;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #444;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center">Akuntansi</h4>
    <hr class="bg-light">

    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
    <a href="{{ route('buku-besar') }}">📘 Buku Besar</a>
    <a href="#">📄 Laporan</a>
    <a href="#">⚙ Pengaturan</a>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger w-100 mt-3">Logout</button>
    </form>
</div>


<div class="content">
    @yield('content')
</div>

</body>
</html>