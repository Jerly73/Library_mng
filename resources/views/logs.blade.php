<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>

            <nav class="px-4 space-y-2">
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

                <!-- Logs (active) -->
                <a href="{{ route('admin.logs') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
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
                <h2 class="text-3xl font-bold text-[#6A2727]">Activity Logs</h2>

                <div class="flex items-center space-x-6">
                    <!-- Admin Badge -->
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Admin</span>
                    </div>

                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/30 rounded-full flex items-center justify-center cursor-pointer" onclick="alert('User ID: {{ Auth::id() }}')" title="Click to see User ID">
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

            <div class="bg-white rounded-xl shadow p-4 mt-6">
                <form method="GET" action="{{ route('admin.logs') }}" class="flex flex-wrap items-end gap-3">
                    <div>
                        <label for="student_id" class="block text-sm font-semibold text-[#6A2727] mb-1">Student ID</label>
                        <input
                            type="number"
                            id="student_id"
                            name="student_id"
                            value="{{ $studentIdFilter }}"
                            min="1"
                            placeholder="Enter student ID"
                            class="w-56 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#6A2727]"
                        >
                    </div>
                    <button type="submit" class="bg-[#6A2727] text-white px-4 py-2 rounded text-sm font-semibold hover:bg-[#4f1d1d]">
                        Show Logs
                    </button>
                    @if($studentIdFilter)
                        <a href="{{ route('admin.logs') }}" class="px-4 py-2 rounded text-sm font-semibold border border-gray-300 text-gray-700 hover:bg-gray-100">
                            Clear
                        </a>
                    @endif
                </form>

                @if($studentIdFilter)
                    <p class="mt-3 text-sm text-gray-600">
                        Showing logs for Student ID: <span class="font-semibold text-[#6A2727]">{{ $studentIdFilter }}</span>
                    </p>
                @endif
            </div>

            <!-- ==================== LOGIN & LOGOUT LOGS ==================== -->
            <div class="bg-white rounded-xl shadow overflow-hidden mt-6">
                <div class="p-4 border-b font-bold text-[#6A2727] flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v3.75m-9 12h12a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0018 4.5H6a2.25 2.25 0 00-2.25 2.25v8.25A2.25 2.25 0 006 18.75z"/>
                    </svg>
                    <span>Login &amp; Logout Logs</span>
                </div>

                @if($logs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
<thead class="bg-[#f3e8e8] text-gray-700">
    <tr>
        <th class="p-3 text-left">#</th>
        <th class="p-3 text-left">User Name</th>
        <th class="p-3 text-left">User ID</th>
        <th class="p-3 text-left">Login Time</th>
        <th class="p-3 text-left">Logout Time</th>
    </tr>
</thead>
                        <tbody>
                            @foreach($logs as $index => $log)
                             <tr class="border-t hover:bg-gray-50">
                                  <td class="p-3 text-left">{{ $index + 1 }}</td>
                                 <td class="p-3 text-left font-medium">{{ $log->user->name ?? 'Unknown User' }}</td>
                                 <td class="p-3 text-left">{{ $log->user_id }}</td>
                                 <td class="p-3 text-left">{{ $log->login_label }}</td>
                                 <td class="p-3 text-left">
                                     @if($log->logout_label)
                                         <span class="text-green-600">{{ $log->logout_label }}</span>
                                     @else
                                         <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-600">Currently Active</span>
                                     @endif
                                 </td>
                             </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center mt-4 px-6 py-3 bg-gray-50 border-t text-sm text-gray-500">
                    <span>Showing {{ $logs->count() }} session record(s)</span>
                    <div class="flex space-x-4 text-xs">
                        <span class="flex items-center space-x-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                            <span>Logged out</span>
                        </span>
                        <span class="flex items-center space-x-1">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span>
                            <span>Currently Active</span>
                        </span>
                    </div>
                </div>
                @else
                <div class="p-8 text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-3 text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h6M12 6l-4-4m0 0l-4 4m4-4v6m0 0l4-4m-4 4l4 4m-4-4h6"/>
                    </svg>
                    <p class="text-base">No login/logout records found yet.</p>
                </div>
                @endif
            </div>

            <!-- ==================== BORROW LOGS ==================== -->
            <div class="bg-white rounded-xl shadow overflow-hidden mt-6">
                <div class="p-4 border-b font-bold text-[#6A2727] flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <span>Book Borrow Logs</span>
                </div>

                @if($issueLogs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                         <thead class="bg-[#f3e8e8] text-gray-700">
                             <tr>
                                 <th class="p-3 text-left">#</th>
                                 <th class="p-3 text-left">Student Name</th>
                                 <th class="p-3 text-left">Student ID</th>
                                 <th class="p-3 text-left">Book Title</th>
                                 <th class="p-3 text-left">Book ID</th>
                                 <th class="p-3 text-left">Borrow Date &amp; Time</th>
                                 <th class="p-3 text-left">Return Date &amp; Time</th>
                                 <th class="p-3 text-left">Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             @foreach($issueLogs as $index => $issue)
                             <tr class="border-t hover:bg-gray-50">
                                 <td class="p-3 text-left">{{ $index + 1 }}</td>
                                 <td class="p-3 text-left font-medium">{{ $issue->student->name ?? 'Unknown' }}</td>
                                 <td class="p-3 text-left">{{ $issue->student_id }}</td>
                                 <td class="p-3 text-left">{{ $issue->book->title ?? 'N/A' }}</td>
                                 <td class="p-3 text-left">{{ $issue->book->book_id ?? 'N/A' }}</td>
                                 <td class="p-3 text-left text-blue-600">
                                         @php
                                             $tz       = \App\Models\LoginTracker::SHOW_TZ;
                                             $borrowDt = \Carbon\CarbonImmutable::parse($issue->borrow_date ?? '1970-01-01', $tz);
                                         @endphp
                                         {{ $borrowDt->format('M d, Y - h:i A') }}
                                 </td>
                                 <td class="p-3 text-left text-green-600">
                                     @if($issue->return_date)
                                         @php
                                             $retDt = \Carbon\CarbonImmutable::parse($issue->return_date, $tz);
                                         @endphp
                                         {{ $retDt->format('M d, Y - h:i A') }}
                                     @else
                                         —
                                     @endif
                                 </td>
                                 <td class="p-3 text-left">
                                     @php
                                         $statusColors = [
                                             'Borrowed' => 'bg-blue-100 text-blue-600',
                                             'Returned' => 'bg-green-100 text-green-600',
                                             'Approved' => 'bg-purple-100 text-purple-600',
                                             'Rejected' => 'bg-red-100 text-red-600',
                                             'Pending' => 'bg-yellow-100 text-yellow-600',
                                             'Overdue' => 'bg-orange-100 text-orange-600',
                                         ];
                                     @endphp
                                     <span class="px-3 py-1 rounded-full text-xs {{ $statusColors[$issue->status] ?? 'bg-gray-100 text-gray-600' }}">
                                         {{ $issue->status }}
                                     </span>
                                 </td>
                             </tr>
                             @endforeach
                         </tbody>
                    </table>
                </div>
                <div class="flex justify-between items-center mt-4 px-6 py-3 bg-gray-50 border-t text-sm text-gray-500">
                    <span>Showing {{ $issueLogs->count() }} borrow record(s)</span>
                    <div class="flex space-x-4 text-xs">
                        <span class="flex items-center space-x-1"><span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Borrowed</span>
                        <span class="flex items-center space-x-1"><span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span> Returned</span>
                        <span class="flex items-center space-x-1"><span class="w-2.5 h-2.5 rounded-full bg-purple-500 inline-block"></span> Approved</span>
                        <span class="flex items-center space-x-1"><span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span> Rejected</span>
                        <span class="flex items-center space-x-1"><span class="w-2.5 h-2.5 rounded-full bg-yellow-500 inline-block"></span> Pending</span>
                    </div>
                </div>
                @else
                <div class="p-8 text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-3 text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h6M12 6l-4-4m0 0l-4 4m4-4v6m0 0l4-4m-4 4l4 4m-4-4h6"/>
                    </svg>
                    <p class="text-base">No borrow logs found yet.</p>
                </div>
                @endif
            </div>

        </main>
    </div>
</x-layout>
