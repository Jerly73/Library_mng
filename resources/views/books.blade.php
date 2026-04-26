<x-layout>
    <div class="flex min-h-screen bg-gray-100">

        <!-- Sidebar -->
       <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
            <div class="p-6 flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
                <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
            </div>

            <nav class="px-4 space-y-2">
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
                        <path d="M12 6l-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h4l2-2m0-12l2-2h4a2 2 0 012 2v12a2 2 0 01-2 2h-4l-2-2"/>
                    </svg>
                    <span>Books</span>
                </a>
                <!-- Category -->
                <a href="category" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <span>Category</span>
                </a>
                <!-- Availability -->
                <a href="availability" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-200 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    <span>Availability</span>
                </a>
            </nav>
        </aside>

       <!-- Main Content -->
<main class="flex-1 p-6">

    <!-- Header -->
    <div class="flex items-center justify-between border-b pb-4">

        @php
        $categoryNames = [
            1 => 'Mathematics', 2 => 'Science',    3 => 'Literature',
            4 => 'History',     5 => 'Geography',  6 => 'ICT',
            7 => 'Fiction',     8 => 'Non-Fiction', 9 => 'Biography',
            10 => 'Arts',       11 => 'Sports',    12 => 'Reference',
        ];

        $allBooks = [
            ['id'=>1, 'title'=>'Calculus',              'author'=>'James Stewart',    'category_id'=>1,  'cover'=>'book1.jpg', 'description'=>'Fundamentals of differential and integral calculus.',   'status'=>'Available'],
            ['id'=>2, 'title'=>'Algebra Basics',         'author'=>'Ron Larson',       'category_id'=>1,  'cover'=>'book1.jpg', 'description'=>'Core algebra concepts for students.',                    'status'=>'Available'],
            ['id'=>3, 'title'=>'Biology Today',          'author'=>'Neil Campbell',    'category_id'=>2,  'cover'=>'book1.jpg', 'description'=>'Comprehensive guide to modern biology.',                 'status'=>'Reserved'],
            ['id'=>4, 'title'=>'Physics Fundamentals',   'author'=>'Halliday',         'category_id'=>2,  'cover'=>'book1.jpg', 'description'=>'Core concepts in physics.',                              'status'=>'Available'],
            ['id'=>5, 'title'=>'World Literature',       'author'=>'Various Authors',  'category_id'=>3,  'cover'=>'book1.jpg', 'description'=>'A collection of classic world literature.',              'status'=>'Available'],
            ['id'=>6, 'title'=>'The Great Gatsby',       'author'=>'F. Scott Fitzgerald','category_id'=>3,'cover'=>'book1.jpg', 'description'=>'A tale of wealth and obsession in the Jazz Age.',       'status'=>'Available'],
            ['id'=>7, 'title'=>'World History',          'author'=>'J.M. Roberts',     'category_id'=>4,  'cover'=>'book1.jpg', 'description'=>'A sweeping account of human civilization.',             'status'=>'Available'],
            ['id'=>8, 'title'=>'Philippine History',     'author'=>'Teodoro Agoncillo','category_id'=>4, 'cover'=>'book1.jpg', 'description'=>'History of the Filipino people.',                       'status'=>'Reserved'],
            ['id'=>9, 'title'=>'Physical Geography',     'author'=>'James Petersen',   'category_id'=>5,  'cover'=>'book1.jpg', 'description'=>'Introduction to earth\'s physical landscapes.',          'status'=>'Available'],
            ['id'=>10,'title'=>'Computer Science',       'author'=>'Donald Knuth',     'category_id'=>6,  'cover'=>'book1.jpg', 'description'=>'Fundamentals of programming and algorithms.',           'status'=>'Available'],
            ['id'=>11,'title'=>'Harry Potter',           'author'=>'J.K. Rowling',     'category_id'=>7,  'cover'=>'book1.jpg', 'description'=>'A young wizard\'s journey at Hogwarts.',                'status'=>'Available'],
            ['id'=>12,'title'=>'Dune',                   'author'=>'Frank Herbert',    'category_id'=>7,  'cover'=>'book1.jpg', 'description'=>'Epic sci-fi set in a desert world.',                   'status'=>'Reserved'],
            ['id'=>13,'title'=>'Sapiens',                'author'=>'Yuval Noah Harari','category_id'=>8,  'cover'=>'book1.jpg', 'description'=>'A brief history of humankind.',                        'status'=>'Available'],
            ['id'=>14,'title'=>'Thinking Fast and Slow', 'author'=>'Daniel Kahneman',  'category_id'=>8,  'cover'=>'book1.jpg', 'description'=>'How our minds make decisions.',                        'status'=>'Available'],
            ['id'=>15,'title'=>'My Story',               'author'=>'Michelle Obama',   'category_id'=>9,  'cover'=>'book1.jpg', 'description'=>'Memoir of the former First Lady.',                     'status'=>'Available'],
            ['id'=>16,'title'=>'Leonardo da Vinci',      'author'=>'Walter Isaacson',  'category_id'=>9,  'cover'=>'book1.jpg', 'description'=>'Biography of the Renaissance genius.',                 'status'=>'Reserved'],
            ['id'=>17,'title'=>'The Art of Drawing',     'author'=>'Gene Franks',      'category_id'=>10, 'cover'=>'book1.jpg', 'description'=>'Step-by-step drawing techniques.',                     'status'=>'Available'],
            ['id'=>18,'title'=>'Sports Science',         'author'=>'Mike Young',       'category_id'=>11, 'cover'=>'book1.jpg', 'description'=>'The science behind athletic performance.',              'status'=>'Available'],
            ['id'=>19,'title'=>'Encyclopedia Britannica','author'=>'Britannica',       'category_id'=>12, 'cover'=>'book1.jpg', 'description'=>'Comprehensive general reference encyclopedia.',         'status'=>'Available'],
        ];

        $categoryId = $categoryId ?? null;
        $books = $categoryId
            ? array_filter($allBooks, fn($b) => $b['category_id'] == $categoryId)
            : $allBooks;

        $currentCategory = $categoryId ? ($categoryNames[$categoryId] ?? 'Books') : ' Books';
        @endphp

        <h2 class="text-3xl font-bold text-[#6A2727]">
            {{ $currentCategory }}
        </h2>

        <div class="flex items-center space-x-6">
            <!-- Toggle -->
            <div class="bg-[#6A2727]/36 px-4 py-1 rounded flex space-x-2">
                <span class="font-semibold text-[#6A2727]">Student</span>
                <span class="text-[#6A2727]">Teacher</span>
            </div>
            <!-- User -->
            <div class="flex items-center space-x-2">
                <div>
                    <p class="text-sm font-semibold text-[#6A2727]">USER NAME</p>
                    <p class="text-xs text-[#6A2727]">Student</p>
                </div>
                <div class="w-10 h-10 bg-[#6A2727]/36 rounded-full"></div>
            </div>
            <!-- LOGOUT -->
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6 text-[#a66a6a] cursor-pointer hover:text-red-700"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
        </div>
    </div>


    <div class="mb-6 mt-4 flex items-center gap-3">
        <!-- Back to Categories -->
        <a href="/category" class=" bg-[#6A2727]/29 flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
            To Categories
        </a>
    </div>

    <!-- BOOKS GRID -->
    <div class="grid grid-cols-3 gap-6">
        @forelse($books as $book)
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition flex gap-4">

            <!-- IMAGE -->
            <img src="{{ asset('images/' . $book['cover']) }}"
                class="w-24 h-32 object-cover rounded">

            <!-- DETAILS -->
            <div class="flex-1">
                <h3 class="font-bold text-lg">{{ $book['title'] }}</h3>
                <p class="text-sm text-gray-500">{{ $book['author'] }}</p>

                <!-- TAG -->
                <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded">
                    {{ $categoryNames[$book['category_id']] ?? '' }}
                </span>

                <p class="text-xs text-gray-400 mt-2">
                    {{ $book['description'] }}
                </p>

                <!-- BUTTONS -->
                <div class="flex justify-between items-center mt-3">
                    <a class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded cursor-pointer">
                        Reserve
                    </a>
                    <span class="{{ $book['status'] === 'Available' ? 'bg-blue-500' : 'bg-red-400' }} text-white px-3 py-1 rounded text-sm">
                        {{ $book['status'] }}
                    </span>
                </div>
            </div>
        </div>

        @empty
        <div class="col-span-3 text-center py-16 text-gray-400">
            <p class="text-lg">No books found in this category.</p>
            <a href="/category" class="text-[#6A2727] underline text-sm mt-2 inline-block">← Back to Categories</a>
        </div>
        @endforelse
    </div>
</main>
    </div>
</x-layout>