<div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr class="border-b text-gray-500 text-center">
                <th class="py-3">Title</th>
                <th class="py-3">NIM</th>
                <th class="py-3">Program Studi</th>
                <th class="py-3">Jenis</th>
                <th class="py-3">Tingkat</th>
                <th class="py-3">Tanggal</th>
                <th class="py-3">Status</th>
                <th class="py-3">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse ($achievements as $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->students->name ?? 'N/A') }}&background=3b82f6&color=fff&size=64"
                            class="w-10 h-10 rounded-full">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $item->title ?? 'N/A' }}
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $item->students->name ?? 'N/A' }}
                            </span>
                        </div>
                    </td>
                    <td class="py-3 text-center">
                        {{ $item->students->nim ?? 'N/A' }}
                    </td>
                    <td class="py-3 text-center">
                        {{ $item->students?->studyProgram->name ?? 'N/A' }}
                    </td>
                    <td class="py-3 text-center">
                        <span
                            class="rounded-full px-3 py-1 text-xs font-medium
                            {{ $item->getJenisPrestasiAttribute() === 'Akademik'
                                ? 'bg-blue-100 text-blue-800'
                                : 'bg-green-100 text-green-800' }}">
                            {{ $item->getJenisPrestasiAttribute() }}
                        </span>
                    </td>

                    <td class="py-3 text-center">
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium">
                            {{ $item->grade }}
                        </span>
                    </td>
                    <td class="py-3 text-center text-xs">
                        {{ $item->date?->format('d M Y') ?? '-' }}
                    </td>
                    <td class="py-3 text-center">
                        @if ($item->status === 'Publish')
                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">
                                Publish
                            </span>
                        @elseif ($item->status === 'Verified')
                            <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">
                                Verified
                            </span>
                        @else
                            <span class="rounded-full bg-gray-400 px-3 py-1 text-xs font-medium text-white">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="py-3 flex justify-center gap-3">
                        <a href="{{ route('achievements.edit', $item->id) }}">
                            <i data-lucide="edit" class="h-5 w-5 text-gray-400 hover:text-yellow-400"></i>
                        </a>

                        <form action="{{ route('achievements.destroy', $item->id) }}" method="POST"
                            >
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i data-lucide="trash" class="h-5 w-5 text-gray-400 hover:text-red-400"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="py-6 text-center text-sm text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-6 ">
        {{ $achievements->links() }}
    </div>
</div>
