<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microsoft Login Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->

    <nav class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold text-blue-700">
                    Microsoft Login Dashboard
                </h1>

                <p class="text-sm text-gray-500">
                    Laravel 12 | Microsoft OAuth Authentication
                </p>
            </div>

            <div class="flex items-center gap-4">

                <span class="font-semibold text-gray-700">
                    Welcome,
                    <span class="text-blue-600">
                        {{ $currentUser?->name ?? 'Guest User' }}
                    </span>
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </nav>

    <div class="max-w-7xl mx-auto py-8 px-4">

        <!-- Dashboard Statistics -->

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-blue-600 text-white rounded-xl shadow-lg p-6">

                <h2 class="text-lg font-semibold">
                    Total Users
                </h2>

                <p class="text-4xl font-bold mt-3">
                    {{ $totalUsers }}
                </p>

            </div>

            <div class="bg-green-600 text-white rounded-xl shadow-lg p-6">

                <h2 class="text-lg font-semibold">
                    Microsoft Users
                </h2>

                <p class="text-4xl font-bold mt-3">
                    {{ $microsoftUsers }}
                </p>

            </div>

            <div class="bg-purple-600 text-white rounded-xl shadow-lg p-6">

                <h2 class="text-lg font-semibold">
                    Today's Users
                </h2>

                <p class="text-4xl font-bold mt-3">
                    {{ $todayUsers }}
                </p>

            </div>

        </div>

        <!-- Action Buttons -->

        <div class="mt-8 flex gap-4">

            <a href="{{ route('users.index') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg shadow">

                Manage Users

            </a>

            <a href="{{ route('login.history') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg shadow">

                Login Activity

            </a>

        </div>

        <!-- Current User Information -->

        <div class="bg-white rounded-xl shadow-lg mt-8">

            <div class="border-b px-6 py-4">

                <h2 class="text-xl font-bold text-gray-700">

                    Current User Information

                </h2>

            </div>

            <div class="p-6">

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <p class="mb-3">
                            <strong>Name :</strong>
                            {{ $currentUser?->name ?? '-' }}
                        </p>

                        <p class="mb-3">
                            <strong>Email :</strong>
                            {{ $currentUser?->email ?? '-' }}
                        </p>

                    </div>

                    <div>

                        <p class="mb-3">
                            <strong>Microsoft ID :</strong>
                            {{ $currentUser?->microsoft_id ?? '-' }}
                        </p>

                        <p class="mb-3">
                            <strong>Joined :</strong>
                            {{ $currentUser?->created_at?->format('d M Y h:i A') ?? '-' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Latest Registered Users -->

        <div class="bg-white rounded-xl shadow-lg mt-8">

            <div class="border-b px-6 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <h2 class="text-xl font-bold text-gray-700">
                    Latest Registered Users
                </h2>

                <form method="GET" class="flex gap-2">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Name or Email"
                        class="border border-gray-300 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                        Search
                    </button>

                </form>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="bg-gray-100">

                        <tr>

                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                ID
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                Name
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                Email
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                Microsoft ID
                            </th>

                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">
                                Created At
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @forelse($latestUsers as $user)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $user->id }}
                            </td>

                            <td class="px-6 py-4 font-medium">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->microsoft_id ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $user->created_at->format('d M Y h:i A') }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-8 text-gray-500">

                                No users found.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-5">
            {{ $latestUsers->links() }}
        </div>

        <!-- Footer -->

        <div class="mt-8 text-center text-gray-500 text-sm">

            Laravel 12 • Microsoft OAuth Login Project • Dashboard Module

        </div>

    </div>

</body>

</html>