<x-layout>
<div class="flex min-h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r sticky top-0 h-screen overflow-y-auto">
        <div class="p-6 flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain">
            <h1 class="text-xl font-bold text-[#6A2727]">Cena LIBRARY</h1>
        </div>

            <!-- Menu -->
            <div class="px-6 text-gray-500 font-semibold mb-2">MENU</div>
                <!-- home -->
                <a href="Home" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Home</span>
                </a>
                <!-- students -->
                 <a href="Student" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Student</span>
                </a>
                 <!-- Library -->
                  <a href="Library" class="flex items-center space-x-2 px-4 py-2  hover:bg-gray-200 rounded">
                    <svg xmlns= "http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    </svg>
                    <span>Library</span>
                </a>
            </nav>
        </aside>


    <!-- Main -->
    <main class="flex-1 p-6">

        <!-- ADD BOOK -->
        <div class="bg-white rounded-xl shadow p-6 mb-6">

            <h2 class="text-xl font-bold text-[#6A2727] mb-4">Add Book</h2>

            <form id="addBookForm">
                @csrf

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    <input name="name" placeholder="Book Name" class="border p-2 rounded" required>
                    <input name="writer" placeholder="Writer" class="border p-2 rounded" required>
                    <input name="book_id" placeholder="Book ID" class="border p-2 rounded" required>
                    <input name="subject" placeholder="Subject" class="border p-2 rounded" required>
                    <input name="class" placeholder="Class" class="border p-2 rounded" required>
                    <input type="date" name="date" class="border p-2 rounded" required>

                </div>

                <button class="mt-4 bg-[#6A2727] text-white px-4 py-2 rounded">
                    ADD BOOK
                </button>
            </form>

        </div>

        <!-- BOOK LIST -->
        <div class="bg-white rounded-xl shadow p-6">

            <h2 class="text-xl font-bold text-[#6A2727] mb-4">All Books</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">

                    <thead class="bg-[#f3e8e8] text-gray-700">
                        <tr>
                            <th class="p-2">#</th>
                            <th class="p-2">Book Name</th>
                            <th class="p-2">Writer</th>
                            <th class="p-2">ID</th>
                            <th class="p-2">Subject</th>
                            <th class="p-2">Class</th>
                            <th class="p-2">Date</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($books as $index => $book)

                        <tr class="border-t">

                            <td class="p-2">{{ $index + 1 }}</td>
                            <td class="p-2">{{ $book['name'] }}</td>
                            <td class="p-2">{{ $book['writer'] }}</td>
                            <td class="p-2">{{ $book['id'] }}</td>
                            <td class="p-2">{{ $book['subject'] }}</td>
                            <td class="p-2">{{ $book['class'] }}</td>
                            <td class="p-2">{{ $book['date'] }}</td>

                            <td class="p-2">
                                <button class="text-red-500 delete-btn" data-id="{{ $index }}">
                                    Delete
                                </button>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-4 text-gray-500">
                                No books yet
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

        </div>

    </main>

</div>

<!-- 🔥 AJAX SCRIPT -->
<script>
document.getElementById('addBookForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch('/library/add', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(() => {
        location.reload();
    });
});

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {

        let id = this.getAttribute('data-id');

        fetch(`/library/delete/${id}`)
        .then(res => res.json())
        .then(() => {
            this.closest('tr').remove();
        });

    });
});
</script>

</x-layout>