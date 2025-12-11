<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow">

        <h2 class="text-2xl font-bold text-center mb-6">Register</h2> 

        @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            <label class="block mb-2 text-gray-700">Name</label>
            <input type="text" name="name"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Email</label>
            <input type="email" name="email"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Password</label>
            <input type="password" name="password"
                   class="w-full p-2 border rounded mb-3" required>

            <label class="block mb-2 text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full p-2 border rounded mb-3" required>

            <button class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Register
            </button>

            <p class="text-center mt-3 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600">Login</a>
            </p>

        </form>
    </div>
</div>

</body>
</html>
