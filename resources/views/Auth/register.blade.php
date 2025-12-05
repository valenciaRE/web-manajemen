<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>
<body class="h-full bg-gray-50 dark:bg-gray-900">

<section class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen">
    <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 dark:border dark:border-gray-700 sm:max-w-md p-6">

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Create an account
        </h1>

        <!-- FORM REGISTER BENAR -->
        <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5">
                Register
            </button>

            <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
            </p>

        </form>
    </div>
</section>

</body>
</html>
