<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>

            <nav class="px-4 space-y-2">
                <!-- Dashboard -->
                <a href="#" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <!-- Books -->
                <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-red-200 rounded text-gray-800 font-medium"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" >
                        <path d="M12 6l-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h4l2-2m0-12l2-2h4a2 2 0 012 2v12a2 2 0 01-2 2h-4l-2-2"/>
                    </svg>
                    <span>Books</span>
                </a>
                <!-- Category -->
                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Category</span>
                </a>
                <!-- Availability -->
                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    <span>Availability</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">Books</h2>

                <div class="flex items-center space-x-6">
                    <!-- Toggle -->
                    <div class="bg-red-200 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Student</span>
                        <span class="text-[#6A2727]">Teacher</span>
                    </div>

                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">USER NAME</p>
                            <p class="text-xs text-[#6A2727]">Student</p>
                        </div>
                        <div class="w-10 h-10 bg-red-400 rounded-full"></div>
                    </div>

                                <!-- LOGOUT -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 text-[#a66a6a] cursor-pointer hover:text-red-700"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">

            @for ($i = 0; $i < 9; $i++)
            <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition flex gap-4">

                <!-- IMAGE -->
                <img src="{{ asset('images/book1.jpg') }}"
                    class="w-24 h-32 object-cover rounded">

                <!-- DETAILS -->
                <div class="flex-1">
                    <h3 class="font-bold text-lg">Calculus</h3>
                    <p class="text-sm text-gray-500">James Stewart</p>

                    <!-- TAG -->
                    <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                        Mathematics
                    </span>

                    <p class="text-xs text-gray-400 mt-2">
                        Comprehensive guide covering fundamentals of differential and integral calculus.
                    </p>

                    <!-- BUTTONS -->
                    <div class="flex justify-between items-center mt-3">
                        <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                            Reserve
                        </button>

                        <span class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                            Available
                        </span>
                    </div>
                </div>

            </div>
            @endfor


        </main>
    </div>
</x-layout>