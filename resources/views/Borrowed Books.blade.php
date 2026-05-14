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
                <a href="availability" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M5 12l4 4 10-10 2 2-12 12-6-6z"/>
                    </svg>
                    <span>Availability</span>
                </a>
                <!-- Borrowed Books -->
                <a href="borrowed-books" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
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

        <!-- HEADER -->
        <div class="flex items-center justify-between border-b pb-4">

            <!-- LEFT: TITLE -->
            <h2 class="text-3xl font-bold text-[#6A2727]">
                My Books & Requests
            </h2>

            <!-- RIGHT: USER INFO -->
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
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full flex items-center justify-center cursor-pointer" onclick="alert('User ID: {{ Auth::id() }}')" title="Click to see User ID">
                            <span class="text-lg font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    </div>

                <!-- LOGOUT -->
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

            @if($issues->where('status', 'Pending')->count() > 0)
            <!-- PENDING SECTION -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold text-[#6A2727] mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 text-yellow-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h6M12 6l-4-4m0 0l-4 4m4-4v6m0 0l4-4m-4 4l4 4m-4-4h6"/>
                    </svg>
                    Pending Requests ({{ $issues->where('status', 'Pending')->count() }})
                </h3>
                <div class="grid grid-cols-3 gap-6">
                    @foreach($issues->where('status', 'Pending') as $issue)
                    <div class="bg-white p-4 rounded-xl shadow flex gap-4 border-l-4 border-yellow-400">
                        <img src="{{ asset('images/' . $issue->book->cover) }}"
                            class="w-24 h-32 object-cover rounded">

                        <div class="flex-1">
                            <h3 class="font-bold text-lg">{{ $issue->book->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $issue->book->author }}</p>
                            <p class="text-xs text-gray-400 mt-2 line-clamp-2">{{ $issue->book->description }}</p>

                            <div class="mt-3 space-y-1">
                                <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded text-sm font-medium">
                                    Pending Approval
                                </span>
                                <p class="text-xs text-gray-500">
                                    Requested: {{ $issue->borrow_date }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Due: {{ $issue->due_date }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($issues->whereIn('status', ['Approved', 'Borrowed'])->count() > 0)
            <!-- BORROWED SECTION -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-[#6A2727] mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v-13m0 0L4 9m4-4 4 4m11 4l-4-4m-4 4l-4 4M9 21h6m-6 0v-3.75"/>
                    </svg>
                    Borrowed Books ({{ $issues->whereIn('status', ['Approved', 'Borrowed'])->count() }})
                </h3>
                <div class="grid grid-cols-3 gap-6">
                    @foreach($issues->whereIn('status', ['Approved', 'Borrowed']) as $issue)
                    <div class="bg-white p-4 rounded-xl shadow flex gap-4 border-l-4 border-green-500">
                        <img src="{{ asset('images/' . $issue->book->cover) }}"
                            class="w-24 h-32 object-cover rounded">

                        <div class="flex-1">
                            <h3 class="font-bold text-lg">{{ $issue->book->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $issue->book->author }}</p>
                            <p class="text-xs text-gray-400 mt-2 line-clamp-2">{{ $issue->book->description }}</p>

                            <div class="mt-3 space-y-1">
                                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded text-sm font-medium">
                                    {{ $issue->status }}
                                </span>
                                <p class="text-xs text-gray-500">
                                    Borrowed: {{ $issue->borrow_date }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Due: {{ $issue->due_date }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($issues->count() == 0)
            <div class="text-center py-16 text-gray-400">
                <p class="text-lg">No books or requests yet.</p>
                <p class="text-sm mt-2">Browse the library to reserve and request books.</p>
            </div>
            @endif
        

    </div>
</x-layout>