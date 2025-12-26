<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="font-bold text-xl text-gray-800">
                    Microsoft Login App
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">Hello, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="max-w-7xl mx-auto py-12 px-4">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-blue-800 mb-3">User Information</h2>
                    <div class="space-y-2">
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Microsoft ID:</strong> {{ Auth::user()->microsoft_id }}</p>
                        <p><strong>Account Created:</strong> {{ Auth::user()->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                
                <div class="bg-green-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold text-green-800 mb-3">Microsoft Features</h2>
                    <ul class="space-y-2">
                        <li>✓ Secure authentication via Microsoft</li>
                        <li>✓ Email verification handled by Microsoft</li>
                        <li>✓ Single Sign-On capability</li>
                        <li>✓ Enterprise-ready security</li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8">
                <a href="/" 
                   class="inline-block bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-900 transition duration-300">
                    ← Back to Home
                </a>
            </div>
        </div>
    </main>
</body>
</html>