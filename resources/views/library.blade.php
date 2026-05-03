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

                <!-- Home -->
                <a href="{{ route('admin.home') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                    </svg>
                    <span>Home</span>
                </a>

                <!-- Students -->
                <a href="{{ route('admin.students') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Students</span>
                </a>

                <!-- Library (active) -->
                <a href="{{ route('admin.library') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042v6.009c0 .904.732 1.636 1.636 1.636h4.708c.904 0 1.636-.732 1.636-1.636V6.042c0 .904-.732 1.636-1.636 1.636h-4.708c-.904 0-1.636.732-1.636 1.636z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.182 6.318a3 3 0 00-4.182 4.182c0 1.318.896 2.4 2.091 2.636V17.25H7.5V11.554c1.195-.236 2.091-1.318 2.091-2.636a3 3 0 00-4.182-4.182z"/>
                    </svg>
                    <span>Library</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">Library Management</h2>

                <div class="flex items-center space-x-6">
                    <!-- Toggle -->
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Admin</span>
                    </div>

                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-[#6A2727]">Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full flex items-center justify-center">
                            <span class="text-lg font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
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

            <!-- Add Book Form -->
            <div class="bg-white rounded-xl shadow p-6 mt-6">
                <h2 class="text-xl font-bold text-[#6A2727] mb-4">Add Book</h2>

                <form method="POST" action="{{ route('admin.library.add') }}">
                    @csrf

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <input name="name" placeholder="Book Name" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                        <input name="writer" placeholder="Writer" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                        <input name="book_id" placeholder="Book ID" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                        <input name="subject" placeholder="Subject" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                        <input name="class" placeholder="Class" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                        <input type="date" name="date" class="border p-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]" required>
                    </div>

                    <button type="submit" class="mt-4 bg-[#6A2727] text-white px-4 py-2 rounded hover:bg-[#4f1d1d]">
                        ADD BOOK
                    </button>
                </form>

            </div>

            <!-- Book List -->
            <div class="bg-white rounded-xl shadow p-6 mt-6">
                <h2 class="text-xl font-bold text-[#6A2727] mb-4">All Books</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#f3e8e8] text-gray-700">
                            <tr>
                                <th class="p-3">#</th>
                                <th class="p-3">Book Name</th>
                                <th class="p-3">Writer</th>
                                <th class="p-3">ID</th>
                                <th class="p-3">Subject</th>
                                <th class="p-3">Class</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Action</th>
                            </tr>
                        </thead>
                        <tbody id="booksTableBody">
                            @forelse($books as $index => $book)
                            <tr class="border-t" data-id="{{ $index }}">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3">{{ $book['name'] }}</td>
                                <td class="p-3">{{ $book['writer'] }}</td>
                                <td class="p-3">{{ $book['id'] }}</td>
                                <td class="p-3">{{ $book['subject'] }}</td>
                                <td class="p-3">{{ $book['class'] }}</td>
                                <td class="p-3">{{ $book['date'] }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('admin.library.delete', $index) }}" class="inline" onsubmit="return confirm('Delete this book?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">No books in library yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</x-layout>
