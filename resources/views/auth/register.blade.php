@extends('auth.layouts.auth')

@section('title', 'Sign Up')

@section('content')

    {{-- Logo/Brand --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun</h1>
        <p class="text-gray-600">Daftar untuk memulai dengan InfoNow!</p>
    </div>

    {{-- Register Card --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

        {{-- Flash Messages --}}
        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <span class="material-icons text-red-600 text-sm">error</span>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Register Form --}}
        <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
            @csrf
            {{-- Name Field --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons text-gray-400 text-xl">
                        person
                    </span>
                    <input type="text" id="name" name="name" required autofocus
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:border-blue-500 focus:ring-1 focus:ring-blue-200
                   focus:outline-none transition  @error('name') @enderror"
                        placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}">
                </div>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons text-gray-400 text-xl">
                        email
                    </span>
                    <input type="email" id="email" name="email" required
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:border-blue-500 focus:ring-1 focus:ring-blue-200
                   focus:outline-none transition  @error('email') @enderror"
                        placeholder="Masukkan email Anda" value="{{ old('email') }}">
                </div>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password Field --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons text-gray-400 text-xl">
                        lock
                    </span>
                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:border-blue-500 focus:ring-1 focus:ring-blue-200
                   focus:outline-none transition  @error('password') @enderror"
                        placeholder="Masukkan password Anda">
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="material-icons text-xl" x-show="!showPassword">visibility</span>
                        <span class="material-icons text-xl" x-show="showPassword">visibility_off</span>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @else
                    {{-- translate bahasa indonesia --}}
                    <p class="mt-1 text-xs text-gray-500">Harus terdiri dari minimal 6 karakter</p>
                @enderror
            </div>

            {{-- Confirm Password Field --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password
                </label>
                <div class="relative" x-data="{ showPassword: false }">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons text-gray-400 text-xl">
                        lock
                    </span>
                    <input :type="showPassword ? 'text' : 'password'" id="password_confirmation"
                        name="password_confirmation" required
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:border-blue-500 focus:ring-1 focus:ring-blue-200
                   focus:outline-none transition"
                        placeholder="Konfirmasi password Anda">
                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <span class="material-icons text-xl" x-show="!showPassword">visibility</span>
                        <span class="material-icons text-xl" x-show="showPassword">visibility_off</span>
                    </button>
                </div>
            </div>

            {{-- Terms & Conditions --}}
            <div class="flex items-start">
                <input type="checkbox" name="terms" id="terms" required
                    class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="terms" class="ml-2 text-sm text-gray-600">
                    Saya setuju dengan
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Syarat Layanan</a>
                    dan
                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Kebijakan Privasi</a>
                </label>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center gap-2 group">
                <span>Buat Akun</span>
                <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>

        </form>




    </div>

    {{-- Sign In Link --}}
    <div class="text-center mt-6">
        <p class="text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                Masuk
            </a>
        </p>
    </div>

@endsection
