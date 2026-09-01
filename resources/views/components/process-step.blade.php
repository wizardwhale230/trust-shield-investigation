{{-- Process Step Component --}}
@props(['number', 'icon' => 'check', 'title', 'desc'])

<div class="relative rounded-xl border border-border bg-surface p-6 flex flex-col gap-3 h-full">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-primary text-white flex items-center justify-center font-bold text-sm flex-shrink-0">
            {{ $number }}
        </div>
        <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        </div>
    </div>
    <h3 class="text-lg font-semibold text-content">{{ $title }}</h3>
    <p class="text-sm text-content-secondary leading-relaxed">{{ $desc }}</p>
</div>
