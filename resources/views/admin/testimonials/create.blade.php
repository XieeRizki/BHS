@extends('layouts.admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-secondary">Tambah Testimoni Baru</h1>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Pesan/Testimoni</label>
            <textarea name="message" rows="5" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>{{ old('message') }}</textarea>
            @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Foto Profil</label>
            <input type="file" name="avatar" accept="image/*" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            @error('avatar') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Rating</label>
            <select name="rating" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang)</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 Bintang)</option>
            </select>
            @error('rating') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }} class="w-4 h-4">
                <span class="ml-3 text-secondary font-bold">Aktifkan Testimoni</span>
            </label>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-orange-600 transition-all">
                Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 bg-gray-400 text-white font-bold rounded-lg hover:bg-gray-500 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection