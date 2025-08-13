<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-gray-800">✏️ Edit Tugas</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto px-4">
            <form method="POST" action="{{ route('progress.update', $task->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium">Judul Tugas</label>
                    <input type="text" name="judul_tugas" value="{{ $task->judul_tugas }}"
                           class="w-full border px-4 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Deadline</label>
                    <input type="date" name="deadline" value="{{ $task->deadline }}"
                           class="w-full border px-4 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ $task->tanggal_selesai }}"
                           class="w-full border px-4 py-2 rounded">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
