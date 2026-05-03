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
                
                <!-- Availability -->
                <a href="availability" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
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
                <h2 class="text-3xl font-bold text-[#6A2727]">Availability</h2>

                <div class="flex items-center space-x-6">
                    <!-- Toggle -->
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Student</span>
                        
                    </div>

                    <!-- User -->
                  <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-[#6A2727]">Student</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full"></div>
                    </div>

                    <!-- LOGOUT -->
                     <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="w-6 h-6 text-[#a66a6a] hover:text-red-700 cursor-pointer transition-colors" title="Logout">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
                            </svg>
                        </button>
                    </form>
                        </div>
                    </div>

            <div class="bg-white rounded-xl shadow overflow-hidden">

                <!-- HEADER -->
                <div class="grid grid-cols-3 bg-gray-100 px-6 py-3 font-semibold text-gray-500">
                    <div>Book Title</div>
                    <div>Category</div>
                    <div>Status</div>
                </div>

                <!-- DATA -->
                @php
                $books = [
                    ['title'=>'The Hobbit','category'=>'Fantasy','status'=>'Available','icon'=>''],
                    ['title'=>'Design','category'=>'Arts','status'=>'Available','icon'=>''],
                    ['title'=>'To Kill a Mockingbird','category'=>'Fiction','status'=>'Borrowed','icon'=>''],
                    ['title'=>'Money / Investing','category'=>'Business','status'=>'Available','icon'=>''],
                    ['title'=>'Introduction to Algebra','category'=>'Mathematics','status'=>'Borrowed','icon'=>''],
                    ['title'=>'History of Ancient Rome','category'=>'History','status'=>'Borrowed','icon'=>''],
                    ['title'=>'Physics Fundamentals','category'=>'Science','status'=>'Borrowed','icon'=>''],
                    ['title'=>'Understanding Computers','category'=>'Technology','status'=>'Available','icon'=>''],
                    ['title'=>'World Atlas','category'=>'Geography','status'=>'Available','icon'=>''],
                    ['title'=>'Art for Beginners','category'=>'Arts','status'=>'Available','icon'=>''],
                    ['title'=>'Business Ethics','category'=>'Business','status'=>'Borrowed','icon'=>''],
                    ['title'=>'Momo','category'=>'Horror','status'=>'Borrowed','icon'=>''],
                ];
                @endphp

                @foreach($books as $book)
                <div class="grid grid-cols-3 items-center px-6 py-4 border-t">

                    <!-- TITLE -->
                    <div class="flex items-center gap-3">
                        <span class="text-xl">{{ $book['icon'] }}</span>
                        <span class="font-medium">{{ $book['title'] }}</span>
                    </div>

                    <!-- CATEGORY -->
                    <div class="flex items-center gap-2 text-gray-600">
                        <span></span>
                        <span>{{ $book['category'] }}</span>
                    </div>

                    <!-- STATUS -->
                    <div>
                        @if($book['status'] == 'Available')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium">
                                Available →
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                Borrowed →
                            </span>
                        @endif
                    </div>

                </div>
                @endforeach

            </div>

        </main>
    </div>
</x-layout>