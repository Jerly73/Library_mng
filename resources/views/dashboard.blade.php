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
                <a href="#" class="flex items-center space-x-2 px-4 py-2 bg-red-200 rounded text-gray-800 font-medium">
                    <svg xmlns= "http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <!-- Books -->
                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"
                        viewBox="0 0 24 24">
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
                <h2 class="text-3xl font-bold text-[#6A2727]">Dashboard</h2>

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

            <!-- Book Recommendation -->
            <section class="mt-8">
                <h3 class="text-xl font-semibold text-[#6A2727] mb-4">
                    Book Recommendation
                </h3>

                <div class="flex space-x-6 overflow-x-auto">
                    @foreach(['book1.jpg','book2.jpg','book3.jpg','book4.jpg'] as $book)
                        <img src="{{ asset('images/'.$book) }}"
                             class="w-40 h-56 object-cover rounded shadow">
                    @endforeach
                </div>
            </section>

            <!-- Book Category -->
            <section class="mt-10">
                <h3 class="text-xl font-semibold text-[#6A2727] mb-4">
                    Book Category
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach([
                        ['img'=>'book1.jpg','title'=>'Business'],
                        ['img'=>'book2.jpg','title'=>'Design'],
                        ['img'=>'book3.jpg','title'=>'Money / Investing'],
                        ['img'=>'book4.jpg','title'=>'Horror']
                    ] as $book)

                    <div class="bg-white p-4 rounded-xl shadow text-center">
                        <img src="{{ asset('images/'.$book['img']) }}"
                             class="w-24 h-32 object-cover mx-auto rounded mb-3">

                        <p class="text-sm font-semibold">Title: {{ $book['title'] }}</p>
                        <p class="text-xs text-gray-500 mb-3">Author: Unknown</p>

                        <div class="flex justify-center space-x-2">
                            <button class="bg-blue-500 text-white text-xs px-3 py-1 rounded">
                                Borrow
                            </button>
                            <button class="bg-yellow-400 text-xs px-3 py-1 rounded">
                                Availability
                            </button>
                        </div>
                    </div>

                    @endforeach

                </div>
            </section>

        </main>
    </div>
</x-layout>