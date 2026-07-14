<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login History</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-100 min-h-screen">


<div class="max-w-7xl mx-auto py-8 px-4">


    <div class="bg-white shadow-lg rounded-xl overflow-hidden">


        <!-- Header -->

        <div class="flex flex-col md:flex-row justify-between items-center px-6 py-4 border-b gap-3">


            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Microsoft Login Activity
                </h1>


                <p class="text-sm text-gray-500">
                    Track user authentication history and login details
                </p>

            </div>



            <a href="{{ route('dashboard') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">

                ← Dashboard

            </a>


        </div>




        <!-- Table -->

        <div class="overflow-x-auto px-6 py-4">


            <table class="w-full text-sm">


                <thead class="bg-gray-100">


                    <tr>


                        <th class="px-5 py-3 text-left font-semibold text-gray-700">
                            User
                        </th>


                        <th class="px-5 py-3 text-left font-semibold text-gray-700">
                            Provider
                        </th>


                        <th class="px-5 py-3 text-left font-semibold text-gray-700">
                            IP Address
                        </th>


                        <th class="px-5 py-3 text-left font-semibold text-gray-700">
                            Device
                        </th>


                        <th class="px-5 py-3 text-left font-semibold text-gray-700">
                            Login Time
                        </th>


                    </tr>


                </thead>




                <tbody class="divide-y divide-gray-200">


                @forelse($histories as $history)


                    <tr class="hover:bg-gray-50">


                        <!-- User -->


                        <td class="px-5 py-3 whitespace-nowrap">


                            <div class="font-semibold text-gray-800">

                                {{ $history->user->name }}

                            </div>


                            <div class="text-xs text-gray-500">

                                {{ $history->user->email }}

                            </div>


                        </td>





                        <!-- Provider -->


                        <td class="px-5 py-3">


                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">

                                {{ ucfirst($history->provider) }}

                            </span>


                        </td>





                        <!-- IP Address -->


                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">

                            {{ $history->ip_address }}

                        </td>





                        <!-- Device -->


                        <td class="px-5 py-3 text-gray-700 max-w-xs">


                            <div class="truncate">

                                {{ $history->device }}

                            </div>


                        </td>





                        <!-- Login Time -->


                        <td class="px-5 py-3 text-gray-700 whitespace-nowrap">

                            {{ $history->login_at->format('d M Y, h:i A') }}

                        </td>



                    </tr>



                @empty


                    <tr>

                        <td colspan="5"
                            class="text-center py-8 text-gray-500">

                            No login activity found.

                        </td>

                    </tr>


                @endforelse



                </tbody>


            </table>



        </div>




        <!-- Pagination -->


        <div class="px-6 py-3 border-t flex justify-center">


            {{ $histories->onEachSide(1)->links('pagination::tailwind') }}


        </div>



    </div>


</div>



</body>

</html>