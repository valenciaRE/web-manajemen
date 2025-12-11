<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                {{ $message }}
            </div>
        @enderror

        <!-- FORM LOGIN YANG BENAR -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <label class="block mb-2 text-gray-700">Email</label>
            <input type="email" name="email"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Password</label>
            <input type="password" name="password"
                   class="w-full p-2 border rounded mb-3" required>

            <!-- TOMBOL LOGIN HARUS DI DALAM FORM -->
            <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

        <div class="flex justify-between mt-4 text-sm">
            <a href="{{ route('register') }}" class="text-blue-600">Register</a>
            <a href="{{ route('password.request') }}" class="text-blue-600">Forgot password?</a>
        </div>

    </div>
</div>

</body>
</html>
