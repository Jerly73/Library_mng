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

 

        <h2 class="text-3xl font-bold text-[#6A2727]">
            @if(request('category') && request('search'))
                {{ $categoryNames[request('category')] ?? 'Books' }} - Search: "{{ request('search') }}"
            @elseif(request('category'))
                {{ $categoryNames[request('category')] ?? 'Books' }}
            @elseif(request('search'))
                Search: "{{ request('search') }}"
            @else
                All Books
            @endif
        </h2>

        <div class="flex items-center gap-3">
            <!-- Search -->
            <form method="GET" action="/books" class="flex items-center gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search books..." 
                    class="px-3 py-2 border rounded-md bg-white text-sm w-48"
                >
            </form>

            <!-- Category Filter -->
            <form method="GET" action="/books" class="flex items-center gap-2">
                <label for="category" class="text-sm font-semibold text-[#6A2727]">Filter by Category:</label>
                <select name="category" id="category" onchange="this.form.submit()" class="px-3 py-2 border rounded-md bg-white text-sm">
                    <option value="">All Categories</option>
                    @foreach($categoryNames as $id => $name)
                        <option value="{{ $id }}" {{ request('category') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
            </form>

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

    <!-- All Books Button -->
    <div class="mb-6 mt-4 flex items-center gap-3">
   
    </div>

    <!-- BOOKS GRID -->
    <div class="grid grid-cols-3 gap-6">
        @forelse($books as $book)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition flex gap-4">

            <!-- IMAGE -->
            <img src="{{ asset('images/' . $book->cover) }}"
                class="w-24 h-32 object-cover rounded">

            <!-- DETAILS -->
            <div class="flex-1">
                <h3 class="font-bold text-lg">{{ $book->title }}</h3>
                <p class="text-sm text-gray-500">{{ $book->author }}</p>

                <!-- TAG -->
                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                    {{ $categoryNames[$book->category_id] ?? '' }}
                </span>

                <p class="text-xs text-gray-400 mt-2">
                    {{ $book->description }}
                </p>

                <!-- BUTTONS -->
                <div class="flex justify-between items-center mt-3">
                    <a class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded cursor-pointer">
                        Reserve
                    </a>
                    <span class="{{ $book->status === 'Available' ? 'bg-blue-500' : 'bg-red-400' }} text-white px-3 py-1 rounded text-sm">
                        {{ $book->status }}
                    </span>
                </div>
            </div>
        </div>

        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <p class="text-lg">{{ request('search') ? 'No books match your search.' : 'No books found in this category.' }}</p>
            <a href="/books" class="text-[#6A2727] underline text-sm mt-2 inline-block">← View all books</a>
        </div>
        @endforelse
    </div>
</main>
    </div>
</x-layout>
