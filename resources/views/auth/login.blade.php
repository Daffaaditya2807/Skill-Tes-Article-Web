@extends('auth.layouts.auth')

@section('title', 'Login')

@section('content')

    {{-- Logo/Brand --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
        <p class="text-gray-600">Masuk agar dapat menggunakan InfoNow!</p>
    </div>

    {{-- Login Card --}}
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <span class="material-icons text-green-600 text-sm">check_circle</span>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2"
                x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                <span class="material-icons text-red-600 text-sm">error</span>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Login Form --}}
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf
            {{-- Email Field --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-icons text-gray-400 text-xl">
                        email
                    </span>

                    <input type="email" id="email" name="email" required autofocus
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:border-blue-500 focus:ring-1 focus:ring-blue-200
                   focus:outline-none transition 
                   @error('email') @enderror"
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
                @enderror
            </div>



            {{-- Submit Button --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center gap-2 group">
                <span>Masuk</span>
                <span class="material-icons text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
            </button>

        </form>
    </div>

    {{-- Sign Up Link --}}
    <div class="text-center mt-6">
        <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                Daftar gratis
            </a>
            <a href="{{ route('landing') }}" class="block mt-4 text-blue-600 hover:text-blue-700 font-medium">
                Kembali ke Beranda
            </a>
        </p>

    </div>

@endsection
