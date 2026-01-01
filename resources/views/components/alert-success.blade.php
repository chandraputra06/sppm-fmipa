@if (session()->has('success'))
<div
    x-data="{ open: true }"
    x-show="open"
    x-transition
    class="fixed top-4 left-1/2 z-50 w-full max-w-lg -translate-x-1/2 px-4"
>
    <div class="rounded-xl border border-green-200 bg-green-50 p-4 shadow-xl">
        <div class="flex items-start justify-between gap-3">
            <div class="text-sm text-green-800">
                {{ session('success') }}
            </div>
            <button
                @click="open = false"
                class="text-green-600 hover:text-green-800"
            >
                ✕
            </button>
        </div>
    </div>
</div>
@endif

