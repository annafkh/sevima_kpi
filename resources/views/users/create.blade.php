<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="name">Nama</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring" value="{{ old('name') }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="email">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                 <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="role">Role</label>
                    <select name="role" id="role" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
                        <option value="">-- Pilih Role --</option>
                        <option value="karyawan" {{ old('role', $user->role ?? '') == 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                        <option value="leader" {{ old('role', $user->role ?? '') == 'leader' ? 'selected' : '' }}>Leader</option>
                        <option value="hc" {{ old('role', $user->role ?? '') == 'hc' ? 'selected' : '' }}>HC</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div id="karyawan-select" class="mt-2 hidden">
                    <label for="karyawan_id">Pilih Karyawan:</label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($availableKaryawans as $karyawan)
                            <option value="{{ $karyawan->id }}" 
                                    data-nama="{{ $karyawan->nama }}" 
                                    data-jabatan="{{ $karyawan->jabatan }}">
                                {{ $karyawan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>        
                                       
                <div class="mb-4" id="leader-select" style="display: none;">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="leader_id">Leader dari Karyawan</label>
                    <select name="leader_id" id="leader_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring" disabled>
                        <option value="">-- Leader --</option>
                        @foreach($leaders as $leader)
                            <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="px-4 py-2 text-black bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
                    <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">Batal</a>
                </div>          
            </form>
        </div>
    </div>
    <script>
        const roleSelect = document.getElementById('role');
        const leaderSelect = document.getElementById('leader-select');
        roleSelect.addEventListener('change', function () {
            if (this.value === 'karyawan') {
                leaderSelect.style.display = 'block';
            } else {
                leaderSelect.style.display = 'none';
            }
        });
    
        // Trigger on page load
        document.addEventListener('DOMContentLoaded', () => {
            if (roleSelect.value === 'karyawan') {
                leaderSelect.style.display = 'block';
            }
        });
    </script>     
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const karyawanSection = document.getElementById('karyawan-select');
            const karyawanSelect = document.getElementById('karyawan_id');
            const nameInput = document.getElementById('name');

            function toggleKaryawanSection() {
                if (roleSelect.value === 'karyawan') {
                    karyawanSection.classList.remove('hidden');
                } else {
                    karyawanSection.classList.add('hidden');
                    karyawanSelect.value = '';
                    nameInput.value = '';
                    nameInput.readOnly = false;
                }
            }

            roleSelect.addEventListener('change', toggleKaryawanSection);
            toggleKaryawanSection(); // jalankan saat halaman pertama kali dibuka

            karyawanSelect.addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                const nama = selected.getAttribute('data-nama');

                if (this.value !== '') {
                    nameInput.value = nama;
                    nameInput.readOnly = true;
                } else {
                    nameInput.value = '';
                    nameInput.readOnly = false;
                }
            });
        });
    </script>
    <script>
        const leaderMapping = @json($leaderMapping);
    
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const karyawanSelect = document.getElementById('karyawan_id');
            const nameInput = document.getElementById('name');
            const leaderSelect = document.getElementById('leader_id');
    
            // Tampilkan select karyawan hanya kalau role = karyawan
            function toggleKaryawanSelect() {
                const karyawanDiv = document.getElementById('karyawan-select');
                const leaderDiv = document.getElementById('leader-select');
                if (roleSelect.value === 'karyawan') {
                    karyawanDiv.classList.remove('hidden');
                    leaderDiv.style.display = 'block';
                } else {
                    karyawanDiv.classList.add('hidden');
                    leaderDiv.style.display = 'none';
                    nameInput.readOnly = false;
                    nameInput.value = '';
                    karyawanSelect.value = '';
                    leaderSelect.value = '';
                }
            }
    
            roleSelect.addEventListener('change', toggleKaryawanSelect);
            toggleKaryawanSelect(); // on page load
    
            // Auto isi nama + leader saat karyawan dipilih
            karyawanSelect.addEventListener('change', function () {
                const selected = this.options[this.selectedIndex];
                const nama = selected.getAttribute('data-nama');
                const jabatan = selected.getAttribute('data-jabatan');
    
                if (this.value !== '') {
                    nameInput.value = nama;
                    nameInput.readOnly = true;
                } else {
                    nameInput.value = '';
                    nameInput.readOnly = false;
                }
    
                const matchedLeaderId = leaderMapping[jabatan];
                if (matchedLeaderId) {
                    leaderSelect.value = matchedLeaderId;
                } else {
                    leaderSelect.value = '';
                }
            });
        });
    </script>    
</x-app-layout>
