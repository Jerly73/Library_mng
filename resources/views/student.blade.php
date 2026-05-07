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
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">

        <!-- Header -->
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-3xl font-bold text-[#6A2727]">Borrow Book</h2>

            <div class="flex items-center space-x-6">
                <div class="bg-[#6A2727]/20 px-4 py-1 rounded">
                    <span class="font-semibold text-[#6A2727]">Admin</span>
                </div>

                <div class="flex items-center space-x-2">
                    <div>
                        <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Admin</p>
                    </div>
                    <div class="w-10 h-10 bg-[#6A2727]/30 rounded-full flex items-center justify-center">
                        <span class="font-bold text-[#6A2727]">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-[#6A2727] hover:text-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- BORROW FORM -->
        <div class="bg-white rounded-xl shadow p-6 mt-6">
            @php
            $availableBooks = \App\Models\Book::where('status', 'Available')->get();
            @endphp
            <h3 class="text-xl font-bold text-[#6A2727] mb-4">Borrow Book to Student</h3>

            <form method="POST" action="{{ route('borrow.book') }}">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="student_id" placeholder="Enter Student ID"
                        class="border p-2 rounded focus:ring-2 focus:ring-[#6A2727]" required>

                    <select name="book_id" class="border p-2 rounded focus:ring-2 focus:ring-[#6A2727]" required>
                        <option value="">Select Available Book</option>
                        @foreach($availableBooks as $book)
                        <option value="{{ $book->id }}">
                            {{ $book->title }} (ID: {{ $book->book_id }})
                        </option>
                        @endforeach
                    </select>

                    <input type="date" name="borrow_date" placeholder="Borrow Date"
                        class="border p-2 rounded focus:ring-2 focus:ring-[#6A2727]" required>

                    <input type="date" name="due_date" placeholder="Due Date"
                        class="border p-2 rounded focus:ring-2 focus:ring-[#6A2727]" required>
                </div>

                <div class="mt-4 text-right">
                    <button type="submit" class="bg-[#6A2727] text-white px-6 py-2 rounded hover:bg-[#4f1d1d]">
                        BORROW BOOK
                    </button>
                </div>
            </form>

            @if(session('success'))
            <div class="mt-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mt-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
            @endif
        </div>

        <!-- BORROWED LIST -->
        <div class="bg-white rounded-xl shadow p-6 mt-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-[#6A2727]">Borrowed List</h3>

                <input type="text" placeholder="Search by Student ID or Book ID..."
                    class="border px-3 py-2 rounded focus:ring-2 focus:ring-[#6A2727]">
            </div>

            @php
            $borrowedIssues = \App\Models\Issue::with('book')
                ->where('status', 'Borrowed')
                ->orderBy('due_date', 'asc')
                ->get();
            @endphp

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
                            <td class="p-3">-</td>
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
