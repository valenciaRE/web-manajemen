<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-center mb-6">Forgot Password</h2>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <label class="block mb-2 text-gray-700">Email</label>
            <input type="email" name="email"
                   class="w-full p-2 border rounded mb-3" required>

            <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Kirim Link Reset
            </button>

            <p class="text-center mt-3 text-sm">
                <a href="{{ route('login') }}" class="text-blue-600">Kembali ke login</a>
            </p>

        </form>
    </div>
</div>

</body>
</html>
