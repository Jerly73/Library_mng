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

                <!-- Students (active) -->
                <a href="{{ route('admin.students') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Students</span>
                </a>

                <!-- Library -->
                <a href="{{ route('admin.library') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042v6.009c0 .904.732 1.636 1.636 1.636h4.708c.904 0 1.636-.732 1.636-1.636V6.042c0 .904-.732 1.636-1.636 1.636h-4.708c-.904 0-1.636.732-1.636 1.636z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.182 6.318a3 3 0 00-4.182 4.182c0 1.318.896 2.4 2.091 2.636V17.25H7.5V11.554c1.195-.236 2.091-1.318 2.091-2.636a3 3 0 00-4.182-4.182z"/>
                    </svg>
                    <span>Library</span>
                </a>

                <!-- Pending Requests -->
                <a href="{{ route('admin.pending.requests') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h6M12 6l-4-4m0 0l-4 4m4-4v6m0 0l4-4m-4 4l4 4m-4-4h6"/>
                    </svg>
                    <span>Pending Requests</span>
                </a>

                <!-- Logs -->
                <a href="{{ route('admin.logs') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Logs</span>
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
            <h2 class="text-3xl font-bold text-[#6A2727]">Borrow Book</h2>

         <div class="flex items-center space-x-6">
                    <!-- Admin Badge -->
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727] ">Admin</span>
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

        <!-- BORROW FORM -->
        

        <!-- BORROWED LIST -->
        <div class="bg-white rounded-xl shadow p-6 mt-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#6A2727]">Borrowed List</h3>

                <form method="GET" action="{{ route('admin.students') }}" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="search"
                        value="{{ $borrowSearch }}"
                        placeholder="Search by Student ID or Book ID..."
                        class="border px-3 py-2 rounded focus:ring-2 focus:ring-[#6A2727]"
                    >
                    <button type="submit" class="bg-[#6A2727] text-white px-4 py-2 rounded hover:bg-[#4f1d1d]">
                        Search
                    </button>
                    @if($borrowSearch)
                        <a href="{{ route('admin.students') }}" class="border px-4 py-2 rounded text-gray-700 hover:bg-gray-100">
                            Clear
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-[#f3e8e8] text-gray-700">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">Student ID</th>
                            <th class="p-3">Student Name</th>
                            <th class="p-3">Book ID</th>
                            <th class="p-3">Book Title</th>
                            <th class="p-3">Borrow Date</th>
                            <th class="p-3">Due Date</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($borrowedIssues as $index => $issue)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $index + 1 }}</td>
                            <td class="p-3">{{ $issue->student_id }}</td>
                            <td class="p-3">
                                {{ $issue->student ? $issue->student->name : 'Unknown' }}
                            </td>
                            <td class="p-3">{{ $issue->book->book_id }}</td>
                            <td class="p-3">{{ $issue->book->title }}</td>
                            <td class="p-3">{{ $issue->borrow_date }}</td>
                            <td class="p-3">{{ $issue->due_date }}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-600">
                                    {{ $issue->status }}
                                </span>
                            </td>
                            <td class="p-3">
                                <form method="POST" action="{{ route('return.book') }}" class="inline" onsubmit="return confirm('Return this book?');">
                                    @csrf
                                    <input type="hidden" name="book_id" value="{{ $issue->book_id }}">
                                    <input type="hidden" name="student_id" value="{{ $issue->student_id }}">
                                    <input type="hidden" name="return_date" value="{{ date('Y-m-d') }}">
                                    <button type="submit" class="border px-3 py-1 rounded text-[#6A2727] hover:bg-[#6A2727] hover:text-white">
                                        Return
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500">No borrowed records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($borrowedIssues->count() > 0)
            <div class="flex justify-between items-center mt-4 text-sm text-gray-500">
                <span>Showing {{ $borrowedIssues->count() }} borrowed record(s)</span>
            </div>
            @endif
        </div>

    </main>
    </div>
</x-layout>
