<div class="overflow-x-auto">
    <table class="w-full border-collapse text-sm">
        <thead>
            <tr class="border-b text-left text-gray-500 ">
                <th class="py-3">Name</th>
                <th class="py-3">Email</th>
                <th class="py-3">Role</th>
                <th class="py-3">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="py-3">{{ $user->name }}</td>
                    <td class="py-3">{{ $user->email }}</td>
                    <td class="py-3"><span
                            class="{{ $user->userRole()['bg'] }} {{ $user->userRole()['text'] }} px-2 py-1 rounded-full text-xs font-medium">{{ $user->userRole()['label'] }}</span>
                    </td>
                    <td class="py-3 flex items-center gap-3">
                        <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 hover:underline"> <i
                                data-lucide="edit" class="h-5 w-5 text-gray-400 hover:text-yellow-400"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="line">
                            @csrf
                            @method('DELETE')
                            <button type="submit"><i data-lucide="trash"
                                    class="h-5 w-5 text-gray-400 hover:text-red-400"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
