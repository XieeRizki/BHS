@extends('layouts.admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-secondary">Tambah Testimoni VIP</h1>
</div>

<div class="bg-white rounded-lg shadow p-8 max-w-2xl">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: RIZKI R." class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Kolom Role/Jabatan Baru Berdasarkan Desain -->
        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Jabatan / Keterangan (Opsional)</label>
            <input type="text" name="role" value="{{ old('role') }}" placeholder="Contoh: Anggota Komunitas Mancing" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Pesan/Testimoni <span class="text-red-500">*</span></label>
            <textarea name="message" rows="4" placeholder="Ketik ulasan di sini..." class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary" required>{{ old('message') }}</textarea>
            @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Foto Profil (Opsional)</label>
            <input type="file" name="avatar" accept="image/jpeg, image/png, image/jpg, image/webp" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            <p class="text-xs text-gray-500 mt-1">* Format yang diizinkan: JPG, PNG, WEBP. Maks 2MB.</p>
            @error('avatar') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-secondary font-bold mb-2">Rating Bintang <span class="text-red-500">*</span></label>
            <select name="rating" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-primary">
                <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Bintang)</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Bintang)</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3 Bintang)</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2 Bintang)</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1 Bintang)</option>
            </select>
            @error('rating') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-8">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-primary rounded focus:ring-primary">
                <span class="ml-3 text-secondary font-bold">Aktifkan Testimoni Ini</span>
            </label>
            <p class="text-xs text-gray-500 ml-8 mt-1">Jika centang dilepas, testimoni tidak akan muncul di halaman publik.</p>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-green-700 transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Testimoni
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 bg-gray-400 text-white font-bold rounded-lg hover:bg-gray-500 transition-all flex items-center gap-2">
                <i class="fas fa-times"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection