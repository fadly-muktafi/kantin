<x-admin-layout>
    <x-slot name="header">Detail User</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <div class="space-y-4">
            <div>
                <span class="text-sm font-medium text-gray-500">Nama:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $user->name }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Email:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $user->email }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Role:</span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                    {{ $user->role }}
                </span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Tanggal Dibuat:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $user->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
            <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Edit
            </a>
        </div>
    </div>
</x-admin-layout>

