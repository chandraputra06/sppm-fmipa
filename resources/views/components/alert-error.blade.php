@if (isset($errors) && $errors->any())
<div x-data="{ open: true }" x-show="open" x-transition
    class="fixed top-4 left-1/2 z-50 w-full max-w-lg -translate-x-1/2 px-4 transform">
    <div class="rounded-xl bg-red-50 shadow-xl border border-gray-200 p-4">
        <div class="flex items-start justify-between gap-3">
            <div class="text-sm text-gray-700">
                {{ $errors->first() }}
            </div>
            <button @click="open = false" class="text-gray-500 hover:text-gray-700">✕</button>
        </div>
    </div>
</div>
@endif
