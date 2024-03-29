<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2/dist/tailwind.min.css">{{-- Or your preferred CSS --}}
    <style>
        body {
            background-color: #fff8dc; /* A slightly warmer yellow */
        }

        .container {
            background-color: #fffacd; /* Light yellow background */
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2); /* Stronger shadow */
            padding: 30px;  /* Increase padding */
            border-radius: 8px; /* Slightly rounded corners */
            transform: rotate(0deg); /* A slight tilt */
            max-width: 500px; /* Limit form width */
            margin: 50px auto; /* Center the form */
        }

    </style>
</head>
<body>
<div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Login</h1>

    <form method="POST" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" id="email"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
            <input type="password" name="password" id="password"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
            <a href="{{ route('register') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</a>
        </div>



    </form>
</div>
</body>
</html>
