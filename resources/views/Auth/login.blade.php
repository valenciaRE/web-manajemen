<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Tailwind CDN TANPA VITE -->
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

<<<<<<< HEAD
        @error('email')
            <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
                {{ $message }}
            </div>
        @enderror
=======
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                          Password
                      </label>
                      <input type="password" name="password" id="password" 
                          placeholder="Kata Sandi"
                          class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg 
                          focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                          dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                          required>
                  </div>
>>>>>>> 33a1d641f93277cb5ef7ce9af31ebb3e309c47ac

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <label class="block mb-2 text-gray-700">Email</label>
            <input type="email" name="email"
                   class="w-full p-2 border rounded mb-3" required>

<<<<<<< HEAD
            <label class="block mb-2 text-gray-700">Password</label>
            <input type="password" name="password"
                   class="w-full p-2 border rounded mb-3" required>
=======
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don't have an account yet? 
                     <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        Register
                    </a>

                      </a>
                  </p>
              </form>
>>>>>>> 33a1d641f93277cb5ef7ce9af31ebb3e309c47ac

            <button class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>

            <div class="flex justify-between mt-4 text-sm">
                <a href="{{ route('register') }}" class="text-blue-600">Register</a>
                <a href="{{ route('password.request') }}" class="text-blue-600">Forgot password?</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>

