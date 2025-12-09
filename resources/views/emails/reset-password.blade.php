<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-center mb-6">Reset Password</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block mb-2 text-gray-700">Email</label>
            <input type="email" name="email" value="{{ request('email') }}"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Password Baru</label>
            <input type="password" name="password"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full p-2 border rounded mb-3" required>

            <button class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Reset Password
            </button>

        </form>
    </div>
</div>

</body>
</html>
