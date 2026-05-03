<x-layout title="Cena Library - Student Registration">
    <div class="min-h-screen bg-white flex justify-center items-center">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-[#e5e5e5] p-10 rounded-xl shadow-[0_4px_15px_rgba(0,0,0,0.1)] text-center w-[420px] relative">

                {{-- Student Badge --}}
                <div class="absolute top-5 right-5 flex items-center text-[15px] font-bold text-[#8B4513]">
                    <span>Student</span>
                    <span class="ml-2 text-xl"></span>
                </div>

                {{-- Logo --}}
                <div class="mb-8">
                    <span class="block text-4xl text-[#923535]">
                        <span class="font-bold">C</span>ena
                    </span>
                    <span class="block text-3xl text-[#923535] font-bold">LIBRARY</span>
                </div>

                {{-- Name --}}
                <div class="mb-5 text-left">
                    <label for="name" class="block mb-2 font-bold text-[#333] text-sm">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter Full Name"
                        class="w-full px-3 py-3 bg-[#6a272719] border border-[#6a272719] rounded-md text-base box-border focus:outline-none focus:ring-1 focus:ring-[#923535]"
                        required
                        autofocus
                    >
                </div>

                {{-- Email --}}
                <div class="mb-5 text-left">
                    <label for="email" class="block mb-2 font-bold text-[#333] text-sm">
                        Email Address
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter Email Address"
                        class="w-full px-3 py-3 bg-[#6a272719] border border-[#6a272719] rounded-md text-base box-border focus:outline-none focus:ring-1 focus:ring-[#923535]"
                        required
                        autocomplete="email"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-5 text-left">
                    <label for="password" class="block mb-2 font-bold text-[#333] text-sm">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter Password"
                        class="w-full px-3 py-3 bg-[#6a272719] border border-[#6a272719] rounded-md text-base box-border focus:outline-none focus:ring-1 focus:ring-[#923535]"
                        required
                        autocomplete="new-password"
                    >
                </div>

                {{-- Confirm Password --}}
                <div class="mb-5 text-left">
                    <label for="password_confirmation" class="block mb-2 font-bold text-[#333] text-sm">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full px-3 py-3 bg-[#6a272719] border border-[#6a272719] rounded-md text-base box-border focus:outline-none focus:ring-1 focus:ring-[#923535]"
                        required
                        autocomplete="new-password"
                    >
                </div>

                {{-- Register Button --}}
                <button
                    type="submit"
                    class="bg-[#923535] text-white py-3 px-25 border-none rounded-full cursor-pointer text-lg font-bold w-full mt-2 transition-colors duration-300 hover:bg-[#000000cd]"
                >
                    Register
                </button>

                <p class="mt-3 text-xs text-gray-400">
                    Only @umindanao.edu.ph email addresses are allowed.
                </p>

                <p class="mt-4 text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#923535] hover:underline font-semibold">
                        Sign In
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-layout>
