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
                <a href="borrowed-books" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 6l-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h4l2-2m0-12l2-2h4a2 2 0 012 2v12a2 2 0 01-2 2h-4l-2-2"/>
                    </svg>
                    <span>Borrowed Books</span>
                </a>
                <a href="{{ route('student.messages') }}" class="flex items-center space-x-2 px-4 py-2 bg-[#6A2727]/36 rounded text-gray-800 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H8l-5 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                    <span>Messages</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-6">
            <div class="flex items-center justify-between border-b pb-4">
                <h2 class="text-3xl font-bold text-[#6A2727]">Messages</h2>

                <div class="flex items-center space-x-6">
                    <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                        <span class="font-semibold text-[#6A2727]">Student</span>
                    </div>

                    <div class="flex items-center space-x-2">
                        <div>
                            <p class="text-sm font-semibold text-[#6A2727]">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-[#6A2727]">Student</p>
                        </div>
                        <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full flex items-center justify-center">
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

            <div class="bg-white rounded-xl shadow mt-5 overflow-hidden">
                <div class="p-4 border-b font-bold text-[#6A2727]">Library Messages</div>

                @forelse($messages as $message)
                    <div class="px-3 py-3 border-b last:border-b-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="font-bold text-[#6A2727]">{{ $message->title }}</h3>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $message->created_at->setTimezone(config('app.timezone'))->format('M d, Y - h:i A') }}
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs {{ $message->type === 'due_date' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                {{ $message->type === 'due_date' ? 'Due Date' : ($message->type === 'book_returned' ? 'Returned' : 'Approved') }}
                            </span>
                        </div>

                        @php
                            $issue = $message->issue;
                            $emailView = null;
                            $emailData = [];

                            if ($issue && $issue->book && $message->type === 'borrow_approved') {
                                $emailView = 'emails.borrow-approved';
                                $emailData = [
                                    'bookTitle' => $issue->book->title,
                                    'bookId' => $issue->book->book_id ?? $issue->book->id,
                                    'studentId' => $issue->student_id,
                                    'studentName' => $issue->student->name ?? Auth::user()->name,
                                    'borrowDate' => $issue->borrow_date,
                                    'dueDate' => $issue->due_date,
                                ];
                            }

                            if ($issue && $issue->book && $message->type === 'due_date') {
                                $emailView = 'emails.book-due-date-notice';
                                $emailData = [
                                    'bookTitle' => $issue->book->title,
                                    'bookId' => $issue->book->book_id ?? $issue->book->id,
                                    'studentId' => $issue->student_id,
                                    'studentName' => $issue->student->name ?? Auth::user()->name,
                                    'borrowDate' => $issue->borrow_date,
                                    'dueDate' => $issue->due_date,
                                ];
                            }

                            if ($issue && $issue->book && $message->type === 'book_returned') {
                                $emailView = 'emails.book-returned-successfully';
                                $emailData = [
                                    'bookTitle' => $issue->book->title,
                                    'bookId' => $issue->book->book_id ?? $issue->book->id,
                                    'studentId' => $issue->student_id,
                                    'studentName' => $issue->student->name ?? Auth::user()->name,
                                    'borrowDate' => $issue->borrow_date,
                                    'returnDate' => $issue->return_date,
                                ];
                            }
                        @endphp

                        @if($emailView)
                            <iframe
                                title="{{ $message->title }}"
                                srcdoc="{{ view($emailView, $emailData)->render() }}"
                                class="mt-2 w-full h-[235px] border-0 bg-white overflow-hidden"
                                scrolling="no"
                                style="border: 0;"
                            ></iframe>
                        @else
                            <div class="mt-2 whitespace-pre-line text-sm text-gray-700 leading-5">{{ $message->body }}</div>
                        @endif
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500">
                        No messages yet.
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</x-layout>
