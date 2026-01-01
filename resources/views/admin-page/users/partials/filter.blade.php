<form method="GET" action="{{ route('users.index') }}">
    <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
    <!-- Search -->
    <div class="relative w-full">
        <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
            <i data-lucide="search" class="h-4 w-4"></i>
        </span>
        <button type="button" onclick="clearSearch()"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600">
            <i data-lucide="x" class="h-4 w-4"></i>
        </button>
        <input
        id="search-input"
            name="search" type="text" value="{{ request('search') }}"
            placeholder="Search..."
            class="w-full rounded-lg border border-gray-200 bg-gray-50 py-2 pl-10 pr-3 text-sm focus:border-blue-500 focus:outline-none"
        />
    </div>

    <!-- Filter -->
    <select name="role" onchange="this.form.submit()"
        class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm sm:w-48"
    >
        <option value="">Semua Role</option>
        <option value="1" {{  request('role') === '1' ? 'selected' : '' }}>Admin</option>
        <option value="2" {{  request('role') === '2' ? 'selected' : '' }}>Dosen</option>
        <option value="3" {{  request('role') === '3' ? 'selected' : '' }}>Mahasiswa</option>
    </select>
</div>
</form>



