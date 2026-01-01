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
            @foreach ($achievements as $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=3b82f6&color=fff&size=64"
                            alt="Budi Santoso" class="w-10 h-10 rounded-full">
                        <div class="flex flex-col">
                            <span class="text-sm font-medium text-gray-900">
                                {{ $item->title ?? 'N/A' }}
                            </span>

                            <span class="text-xs text-gray-500">
                                {{ $item->students->name ?? 'N/A' }}
                            </span>
                        </div>
                    </td>
                    <td class="py-3">
                        {{ $item->students ? $item->students->nim : 'N/A' }}
                    </td>
                    <td class="py-3">
                        {{ $item->students ? $item->students->studyProgram->name : 'N/A' }}
                    </td>
                    <td class="py-3 ">
                        <span
                            class="bg-{{ $item->getJenisPrestasiAttribute() === 'Akademik' ? 'blue-100' : 'green-100' }} rounded-full px-3 py-1 font-medium text-xs">
                            {{ $item->getJenisPrestasiAttribute() }}</span>
                    </td>
                    <td class="py-3">
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-dark">
                            {{ $item->grade }}</span>
                    </td>
                    <td class="py-3">
                        <span class="text-xs">
                            {{ $item->date->format('d M Y') }}
                        </span>
                    </td>
                    <td class="py-3">
                        @if ($item->status === 'Publish')
                            <span
                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">Publish</span>
                        @elseif($item->status === 'Verified')
                            <span
                                class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">Verified</span>
                        @else
                            <span class="rounded-full bg-gray-400 px-3 py-1 text-xs font-medium text-white">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 flex items-center text-center gap-3">
                        <a href="{{ route('achievements.edit', $item->id) }}" class="text-blue-600 hover:underline"> <i
                                data-lucide="edit" class="h-5 w-5 text-gray-400 hover:text-yellow-400"></i>
                        </a>
                        <form action="{{ route('achievements.destroy', $item->id) }}" method="POST" class="line">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i data-lucide="trash"
                                    class="h-5 w-5 text-gray-400 hover:text-red-400"></i></button>
                        </form>
                    </td>
            @endforeach
        </tbody>
    </table>
</div>
