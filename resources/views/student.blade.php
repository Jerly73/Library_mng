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
                <h2 class="text-3xl font-bold text-[#6A2727]">Students</h2>

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

            <!-- Student List -->
            <div class="bg-white rounded-xl shadow p-6 mt-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-[#6A2727]">Student List</h3>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Search student..." class="border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-[#6A2727]">
                        <button class="bg-[#6A2727] text-white px-4 py-2 rounded hover:bg-[#4f1d1d]">
                            Search
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#f3e8e8] text-gray-700">
                            <tr>
                                <th class="p-3">ID</th>
                                <th class="p-3">Name</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $student->id }}</td>
                                <td class="p-3 font-medium">{{ $student->name }}</td>
                                <td class="p-3">{{ $student->email }}</td>
                                <td class="p-3">{{ $student->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr class="border-t">
                                <td colspan="4" class="p-4 text-center text-gray-500">No students found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(isset($students) && $students->count() > 0)
                <div class="mt-4 text-sm text-gray-500">
                    Showing {{ $students->count() }} student(s)
                </div>
                @endif
            </div>

        </main>
    </div>
</x-layout>
