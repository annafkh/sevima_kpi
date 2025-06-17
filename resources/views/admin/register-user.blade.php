@extends('layouts.app') {{-- atau layout dashboard kamu --}}

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h2 class="mb-4 text-xl font-semibold">Tambah Pengguna Baru</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register-user.store') }}">
        @csrf

        <div>
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" class="block w-full mt-1" required value="{{ old('name') }}">
        </div>

        <div class="mt-4">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="block w-full mt-1" required value="{{ old('email') }}">
        </div>

        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="block w-full mt-1" required>
        </div>

        <div class="mt-4">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="block w-full mt-1" required>
        </div>

        <div class="mt-4">
            <label for="role">Role</label>
            <select name="role" id="role" required class="block w-full mt-1">
                <option value="">Pilih Role</option>
                <option value="karyawan">Karyawan</option>
                <option value="leader">Leader</option>
                <option value="hc">HC</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded">
                Tambah Pengguna
            </button>
        </div>
    </form>
</div>
@endsection
