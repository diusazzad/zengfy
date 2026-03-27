@props(['label', 'color' => 'blue'])

<div class="bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex items-center gap-4 transition-all hover:shadow-md group">
    <div class="w-14 h-14 rounded-2xl bg-{{ $color }}-50 dark:bg-{{ $color }}-900/40 flex items-center justify-center text-{{ $color }}-600 dark:text-{{ $color }}-400 group-hover:scale-110 transition-transform">
        {{ $icon }}
    </div>
    <div>
        <p class="text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest">{{ $label }}</p>
        <p class="text-2xl font-black text-gray-900 dark:text-white leading-tight">
            {{ $slot }}
        </p>
    </div>
</div>
