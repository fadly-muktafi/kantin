<x-admin-layout>
    <x-slot name="header">Detail Activity Log</x-slot>

    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <div class="space-y-4">
            <div>
                <span class="text-sm font-medium text-gray-500">User:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $activityLog->user->name ?? 'System' }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Aksi:</span>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 ml-2">
                    {{ $activityLog->aksi }}
                </span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Deskripsi:</span>
                <p class="text-sm text-gray-900 mt-1">{{ $activityLog->deskripsi }}</p>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">IP Address:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $activityLog->ip_address ?? '-' }}</span>
            </div>
            <div>
                <span class="text-sm font-medium text-gray-500">Tanggal:</span>
                <span class="text-sm text-gray-900 ml-2">{{ $activityLog->created_at->format('d M Y, H:i:s') }}</span>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </div>
</x-admin-layout>

