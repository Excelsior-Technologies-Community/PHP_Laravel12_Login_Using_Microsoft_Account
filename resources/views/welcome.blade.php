<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsoft Login - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
            Laravel Microsoft Login
        </h1>
        
        <div class="space-y-4">
            @guest
                <a href="{{ route('microsoft.login') }}" 
                   class="flex items-center justify-center gap-3 w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11.4 24H0V12.6h11.4V24zM24 24H12.6V12.6H24V24zM11.4 11.4H0V0h11.4v11.4zM24 11.4H12.6V0H24v11.4z"/>
                    </svg>
                    <span class="font-semibold">Login with Microsoft</span>
                </a>
            @else
                <div class="text-center">
                    <p class="text-gray-700 mb-4">Welcome, {{ Auth::user()->name }}!</p>
                    <a href="{{ route('dashboard') }}" 
                       class="inline-block bg-green-600 text-white py-2 px-6 rounded-lg hover:bg-green-700 transition duration-300">
                        Go to Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" 
                                class="text-red-600 hover:text-red-800 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            @endguest
            
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                    {{ $errors->first() }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>