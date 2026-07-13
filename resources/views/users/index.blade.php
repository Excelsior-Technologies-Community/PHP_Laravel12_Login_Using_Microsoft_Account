<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto mt-10">

    <div class="bg-white rounded-lg shadow">

        <div class="flex justify-between items-center p-6 border-b">

            <h1 class="text-2xl font-bold">
                User Management
            </h1>

            <a href="{{ route('dashboard') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Dashboard
            </a>

        </div>

        <div class="p-6">

            @if(session('success'))

                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>

            @endif

            <form method="GET" class="mb-5">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search by Name or Email"
                        class="border rounded w-full px-4 py-2">

                    <button
                        class="bg-green-600 text-white px-6 rounded">
                        Search
                    </button>

                </div>

            </form>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-200">

                    <tr>

                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Microsoft ID</th>
                        <th class="p-3 text-left">Created</th>
                        <th class="p-3 text-center">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $user->id }}</td>

                            <td class="p-3">{{ $user->name }}</td>

                            <td class="p-3">{{ $user->email }}</td>

                            <td class="p-3">{{ $user->microsoft_id }}</td>

                            <td class="p-3">
                                {{ $user->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3 text-center">

                                <form
                                    action="{{ route('users.destroy',$user) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this user?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center p-5">

                                No Users Found.

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-5">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

</body>
</html>