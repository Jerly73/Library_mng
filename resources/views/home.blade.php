<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>
            
            <!-- Menu -->
            <div class="px-6 text-gray-500 font-semibold mb-2">MENU</div>
                <!-- home -->
                <a href="Home" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Home</span>
                </a>
                <!-- students -->
                 <a href="Student" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Student</span>
                </a>
                 <!-- Library -->
                  <a href="Library" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Library</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

             <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">Home</h2>

                <div class="flex items-center space-x-6">


                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">USER NAME</p>
                            <p class="text-xs text-[#6A2727]">Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full"></div>
                    </div>

                    <!-- LOGOUT -->
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-[#a66a6a] cursor-pointer hover:text-red-700"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                    </svg>
                </div>
            </div>

            <div class="border-t-4 border-blue-900 mb-6"></div>

            <!-- Cards -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow text-sm">
                    <p class="text-gray-500">Total Books</p>
                    <p class="text-lg font-bold">1250</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow text-sm">
                    <p class="text-gray-500">Students</p>
                    <p class="text-lg font-bold">320</p>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow text-sm">
                    <p class="text-gray-500">Books Borrowed Today</p>
                    <p class="text-lg font-bold">48</p>
                </div>
            </div>

            <!-- Content -->
            <div class="grid grid-cols-3 gap-6">

                <!-- Left Side -->
                <div class="col-span-2 space-y-6">

                    <!-- Recent Borrowed -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b font-semibold text-red-900">
                            Recent Borrowed Books
                        </div>

                        <table class="w-full text-sm">
                            <thead class="text-gray-500">
                                <tr>
                                    <th class="p-3 text-left">Books</th>
                                    <th class="p-3 text-left">Date</th>
                                    <th class="p-3 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-3">Physics</td>
                                    <td class="p-3">2026-04-12</td>
                                    <td class="p-3">Borrowed</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-3">Biology</td>
                                    <td class="p-3">2026-04-17</td>
                                    <td class="p-3">Returned</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-3">Calculus</td>
                                    <td class="p-3">2026-04-16</td>
                                    <td class="p-3">Borrowed</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="p-3 text-right text-red-900 text-sm cursor-pointer">
                            View All
                        </div>
                    </div>

                    <!-- Due Books -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b font-semibold text-red-900">
                            Due Books
                        </div>

                        <table class="w-full text-sm">
                            <thead class="text-gray-500">
                                <tr>
                                    <th class="p-3 text-left">Books</th>
                                    <th class="p-3 text-left">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-3">Calculus</td>
                                    <td class="p-3">2026-04-15</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-3">Physics</td>
                                    <td class="p-3">2026-04-11</td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-3">Discrete Mathematics</td>
                                    <td class="p-3">2026-04-17</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="p-3 text-right text-red-900 text-sm cursor-pointer">
                            View All
                        </div>
                    </div>

                </div>

                <!-- Right Side -->
                <div class="bg-white rounded-lg shadow p-4 space-y-4">
                    <h3 class="font-semibold text-red-900">Quick Actions</h3>

                    <button class="w-full py-2 bg-gray-200 rounded">
                        Add New Book
                    </button>

                    <button class="w-full py-2 bg-gray-200 rounded">
                        Register Student
                    </button>

                    <button class="w-full py-2 bg-yellow-300 rounded">
                        Issue Book
                    </button>

                    <button class="w-full py-2 bg-pink-300 rounded">
                        Return Book
                    </button>
                </div>

            </div>

        </main>
    </div>
</x-layout>




           