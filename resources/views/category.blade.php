<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>

            <nav class="px-4 space-y-2">
                <!-- Menu -->
                <div class="px-6 text-gray-500 font-semibold mb-2">MENU</div>

                <!-- Dashboard -->
                <a href="dashboard" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                <!-- Books -->
                <a href="books" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" >
                    <path stroke-linecap="round" stroke-linejoin="round"d="M7 6h10a2 2 0 012 2v11H9a2 2 0 01-2-2V6z" />
                    </svg>
                    <span>Books</span>
                </a>
                <!-- Category -->
                <a href="category" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" >
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Category</span>
                </a>
                <!-- Availability -->
                <a href="availability" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg"fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" >
                        <path d="M5 12l4 4 10-10 2 2-12 12-6-6z"/>
                    </svg>
                    <span>Availability</span>
                </a>
                <!-- Borrowed Books -->
                <a href="Borrowed Books" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 6l-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h4l2-2m0-12l2-2h4a2 2 0 012 2v12a2 2 0 01-2 2h-4l-2-2"/>
                    </svg>
                    <span>Borrowed Books</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">Category</h2>

                <div class="flex items-center space-x-6">
                    <!-- Toggle -->
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Student</span>
                        
                    </div>

                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">USER NAME</p>
                            <p class="text-xs text-[#6A2727]">Student</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full"></div>
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

            <!-- SEARCH -->
            <div class="mb-6 mt-4">
                <input type="text"
                    placeholder="Search category ..."
                    class="w-100  px-4 py-1.5 text-sm rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <!-- GRID -->
            <div class="grid grid-cols-3 gap-6">

                @php
                $categories = [
                    ['id'=>1,'name'=>'Mathematics','books'=>120,'img'=>'math.png'],
                    ['id'=>2,'name'=>'Science','books'=>95,'img'=>'science.png'],
                    ['id'=>3,'name'=>'Literature','books'=>80,'img'=>'books.png'],
                    ['id'=>4,'name'=>'History','books'=>60,'img'=>'history.png'],
                    ['id'=>5,'name'=>'Geography','books'=>50,'img'=>'globe.png'],
                    ['id'=>6,'name'=>'ICT','books'=>70,'img'=>'laptop.png'],
                    ['id'=>7,'name'=>'Fiction','books'=>200,'img'=>'fiction.png'],
                    ['id'=>8,'name'=>'Non-Fiction','books'=>150,'img'=>'research.png'],
                    ['id'=>9,'name'=>'Biography','books'=>40,'img'=>'user.png'],
                    ['id'=>10,'name'=>'Arts','books'=>45,'img'=>'art.png'],
                    ['id'=>11,'name'=>'Sports','books'=>55,'img'=>'sports.png'],
                    ['id'=>12,'name'=>'Reference','books'=>70,'img'=>'reference.png'],
                ];
                @endphp

                @foreach($categories as $cat)
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md hover:-translate-y-1 transition flex items-center gap-3 border border-gray-100">

                    <!-- TEXT -->
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800">{{ $cat['name'] }}</h3>
                        <p class="text-sm text-gray-400 mt-1">{{ $cat['books'] }} books</p>

                        <a href="books/{{ $cat['id'] }}"  class="mt-2 bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-2 py-1 rounded-lg cursor-pointer inline-block">
                            View Books
                        </a>
                    </div>

                    <!-- IMAGE -->
                    <img src="{{ asset('images/'.$cat['img']) }}"
                        class="w-16 h-16 object-contain">
                </div>
                @endforeach
            </div>
        </main>
    </div>
</x-layout>