@props(['title'])

<div {{ $attributes->merge(['class' => 'fixed inset-0 bg-black/70 items-center justify-center z-50 data-[state=open]:flex data-[state=closed]:hidden']) }}>
    <div class="bg-white rounded-xl shadow-2xl p-6 sm:p-8 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">{{ $title }}</h2>
            <button id="closeModalBtn" class="text-slate-500 hover:text-slate-800">&times;</button>
        </div>

        {{ $slot }}

    </div>
</div>
