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
                <a href="books" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium"> 
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5" >
                    <path stroke-linecap="round" stroke-linejoin="round"d="M7 6h10a2 2 0 012 2v11H9a2 2 0 01-2-2V6z" />
                    </svg>
                    <span>Books</span>
                </a>
                <!-- Category -->
               

                <!-- Availability -->
                <a href="availability" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M5 12l4 4 10-10 2 2-12 12-6-6z"/>
                    </svg>
                    <span>Availability</span>
                </a>
                <!-- Borrowed Books -->
                <a href="borrowed-books" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 6l-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h4l2-2m0-12l2-2h4a2 2 0 012 2v12a2 2 0 01-2 2h-4l-2-2"/>
                    </svg>
                    <span>Borrowed Books</span>
                </a>
                <a href="{{ route('student.messages') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H8l-5 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                    <span>Messages</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded shadow-sm">
                {{ session('error') }}
            </div>
            @endif

      <!-- Header -->
     <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">
                   
                        Books
                 
                </h2>

                <div class="flex items-center gap-3">
<!-- Search -->
                     <form method="GET" action="/books" class="flex items-center">
                         @if(isset($category) && $category)
                             <input type="hidden" name="category" value="{{ $category }}">
                         @endif
                         <input
                             type="text"
                             name="search"
                             value="{{ request('search') }}"
                             placeholder="Search books..."
                             class="px-3 py-1.5 border border-gray-300 rounded-lg bg-white text-sm w-44 focus:outline-none focus:border-[#6A2727]"
                         >
                     </form>

                       <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                <span class="font-semibold text-[#6A2727]">Student</span>
            </div>
            <!-- User -->
            <div class="flex items-center space-x-2">
                <div>
                    <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-[#6A2727]">Student</p>
                </div>
                <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full flex items-center justify-center cursor-pointer" onclick="alert('User ID: {{ Auth::id() }}')" title="Click to see User ID">
                    <span class="text-lg font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
            </div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" title="Logout" class="text-[#6A2727]/50 hover:text-[#6A2727] transition-colors cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Body: Categories panel + Book grid -->
            <div class="flex flex-1">

                <!-- Categories Panel (matches the photo: gray box with category list) -->
                <div class="w-44 bg-gray-200 border-r border-gray-300 py-4 flex-shrink-0">
                    <div class="px-4 mb-2 text-sm font-bold text-[#6A2727]">Categories</div>

                    <a href="/books"
                        class="block px-4 py-2 text-sm {{ !isset($category) || !$category ? 'bg-gray-600 text-white font-semibold' : 'text-gray-700 hover:bg-gray-300' }}">
                        All
                    </a>

                    @foreach($categoryNames as $id => $name)
                    <a href="/books?category={{ $id }}&search={{ request('search') }}"
                        class="block px-4 py-2 text-sm {{ isset($category) && $category == $id ? 'bg-gray-600 text-white font-semibold' : 'text-gray-700 hover:bg-gray-300' }}">
                        {{ $name }}
                    </a>
                    @endforeach
                </div>

                <!-- Book Grid -->
                <div class="flex-1 p-6">
                    <div class="grid grid-cols-3 gap-5">
                        @forelse($books as $book)
                        <div class="bg-white p-4 rounded-xl shadow hover:shadow-md transition flex gap-4">

                            <!-- Cover -->
                            <img src="{{ asset('images/' . $book->cover) }}"
                                class="w-20 h-28 object-cover rounded-lg flex-shrink-0">

                            <!-- Details -->
                            <div class="flex-1 min-w-0 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-bold text-sm text-gray-800 leading-tight line-clamp-2">{{ $book->title }}</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $book->author }}</p>
                                    <span class="inline-block mt-1 text-xs bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">
                                        {{ $categoryNames[$book->category_id] ?? '' }}
                                    </span>
                                    <p class="text-xs text-gray-400 mt-1.5 line-clamp-2">{{ $book->description }}</p>
                                </div>

                                <div class="flex justify-between items-center mt-2">
                                    @if($book->status === 'Available')
                                        <form method="POST" action="{{ route('reserve.book') }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded-lg cursor-pointer font-semibold transition">
                                                Reserve
                                            </button>
                                        </form>
                                    @elseif($book->status === 'Reserved')
                                        <span class="text-xs px-3 py-1 rounded-lg font-semibold bg-gray-200 text-gray-600">
                                            Reserved
                                        </span>
                                    @else
                                        <span class="text-xs px-2.5 py-1 rounded-lg font-semibold bg-gray-400 text-white">
                                            Not Available
                                        </span>
                                    @endif
                                    <span class="text-xs px-2.5 py-1 rounded-lg font-semibold {{ $book->status === 'Available' ? 'bg-blue-500 text-white' : ($book->status === 'Reserved' ? 'bg-yellow-500 text-white' : 'bg-red-400 text-white') }}">
                                        {{ $book->status }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @empty
                        <div class="col-span-3 text-center py-20 text-gray-400">
                            <p class="text-base">{{ request('search') ? 'No books match your search.' : 'No books found in this category.' }}</p>
                            
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-layout>
