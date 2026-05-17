<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>

            <nav class="px-4 space-y-2 ">
                <!-- Menu -->
                <div class="px-6 text-gray-500 font-semibold mb-2">MENU</div>

                <!-- Dashboard -->
                <a href="dashboard" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"    >
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
                <h2 class="text-3xl font-bold text-[#6A2727]">Dashboard</h2>

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

<!-- Book Recommendation -->
             <section class="mt-8">
                 <h3 class="text-xl font-semibold text-[#6A2727] mb-4">
                     Book Recommendation
                 </h3>

                 <div class="flex justify-center space-x-16 overflow-x-auto">
                     @foreach($books->take(5) as $book)
                         <img src="{{ asset('images/'.$book->cover) }}"
                              class="w-40 h-56 object-cover rounded shadow">
                     @endforeach
                 </div>
             </section>

             <!-- Book Category -->
             <section class="mt-10">
                 <h3 class="text-xl font-semibold text-[#6A2727] mb-4">
                     Book Category
                 </h3>

                 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0">

                     @foreach($books->take(4) as $book)
                     <div class=" w-50 h-67 bg-white p-4 rounded-xl shadow text-center">
                         <img src="{{ asset('images/'.$book->cover) }}"
                              class="w-24 h-32 object-cover mx-auto rounded mb-3">

                         <p class="text-sm font-semibold">Title: {{ $book->title }}</p>
                         <p class="text-xs text-gray-500 mb-3">Author: {{ $book->author }}</p>

                         <div class="flex justify-center space-x-2">
                         
                          <form method="POST" action="{{ route('reserve.book') }}" class="inline">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                            <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-2 rounded cursor-pointer font-semibold transition">
                                                Reserve
                                            </button>
                                        </form>
                         
                         <a href="availability" class="bg-orange-400 text-white text-xs px-3 py-2 rounded cursor-pointer hover:bg-blue-500">
                                 Availability
                             </a>
                         </div>
                     </div>

                     @endforeach

                 </div>
             </section>

        </main>
    </div>
</x-layout>
