<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Nama</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
    <label class="block mb-2 text-sm font-bold text-gray-700" for="role">Role</label>
    <select name="role" id="role" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
        <option value="">-- Pilih Role --</option>
        <option value="karyawan" {{ old('role', $user->role) == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
        <option value="leader" {{ old('role', $user->role) == 'leader' ? 'selected' : '' }}>Leader</option>
        <option value="hc" {{ old('role', $user->role) == 'hc' ? 'selected' : '' }}>HC</option>
    </select>
    @error('role')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>


                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="px-4 py-2 text-black bg-blue-600 rounded hover:bg-blue-700">Update</button>
                    <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
