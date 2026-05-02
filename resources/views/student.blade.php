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

            <!-- FORM CARD -->
            <div class="bg-white rounded-xl shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-[#6A2727] mb-6">
                    Borrow Book to Teacher
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-gray-600 mb-1">Teacher ID</label>
                        <div class="flex">
                            <input type="text" placeholder="Enter Teacher ID"
                                class="w-full border rounded-l px-3 py-2 focus:outline-none">
                            <button class="bg-gray-200 px-3 rounded-r">🔍</button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Book ID</label>
                        <div class="flex">
                            <input type="text" placeholder="Enter Book ID"
                                class="w-full border rounded-l px-3 py-2 focus:outline-none">
                            <button class="bg-gray-200 px-3 rounded-r">🔍</button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Borrow Date</label>
                        <input type="date"
                            class="w-full border rounded px-3 py-2 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-gray-600 mb-1">Due Date</label>
                        <input type="date"
                            class="w-full border rounded px-3 py-2 focus:outline-none">
                    </div>
                </div>

                <div class="mt-6">
                    <button class="bg-[#6A2727] text-white px-6 py-2 rounded hover:bg-[#4f1d1d]">
                        BORROW BOOK
                    </button>
                </div>
            </div>

            <!-- BORROWED LIST -->
            <div class="bg-white rounded-xl shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-[#6A2727]">Borrowed List</h3>

                    <input type="text" placeholder="Search by Teacher ID or Book ID..."
                        class="border px-3 py-2 rounded focus:outline-none">
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#f3e8e8] text-gray-700">
                            <tr>
                                <th class="p-2">#</th>
                                <th class="p-2">Teacher ID</th>
                                <th class="p-2">Teacher Name</th>
                                <th class="p-2">Book ID</th>
                                <th class="p-2">Book Title</th>
                                <th class="p-2">Borrow Date</th>
                                <th class="p-2">Due Date</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-t">
                                <td class="p-2">1</td>
                                <td class="p-2">2024-00123</td>
                                <td class="p-2">Juan Dela Cruz</td>
                                <td class="p-2">BK-00045</td>
                                <td class="p-2">The Alchemist</td>
                                <td class="p-2">2024-04-20</td>
                                <td class="p-2">2024-05-04</td>
                                <td class="p-2">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                        Borrowed
                                    </span>
                                </td>
                                <td class="p-2">
                                    <button class="border px-3 py-1 rounded text-[#6A2727]">
                                        View
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-t">
                                <td class="p-2">2</td>
                                <td class="p-2">2024-00145</td>
                                <td class="p-2">Maria Santos</td>
                                <td class="p-2">BK-00012</td>
                                <td class="p-2">To Kill a Mockingbird</td>
                                <td class="p-2">2024-04-19</td>
                                <td class="p-2">2024-05-03</td>
                                <td class="p-2">
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                        Borrowed
                                    </span>
                                </td>
                                <td class="p-2">
                                    <button class="border px-3 py-1 rounded text-[#6A2727]">
                                        View
                                    </button>
                                </td>
                            </tr>

                            <tr class="border-t">
                                <td class="p-2">3</td>
                                <td class="p-2">2024-00178</td>
                                <td class="p-2">Pedro Reyes</td>
                                <td class="p-2">BK-00067</td>
                                <td class="p-2">Rich Dad Poor Dad</td>
                                <td class="p-2">2024-04-18</td>
                                <td class="p-2">2024-05-02</td>
                                <td class="p-2">
                                    <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">
                                        Overdue
                                    </span>
                                </td>
                                <td class="p-2">
                                    <button class="border px-3 py-1 rounded text-[#6A2727]">
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-sm text-gray-500">
                    Showing 1 to 3 of 3 borrowed records
                </div>

                <div class="mt-4">
                    <button class="bg-[#6A2727] text-white px-4 py-2 rounded">
                        VIEW ALL TRANSACTIONS
                    </button>
                </div>
            </div>
        </main>
    </div>
</x-layout>




           