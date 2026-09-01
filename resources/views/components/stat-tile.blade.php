{{-- Stat Tile Component --}}
@props(['value', 'label', 'icon' => null])

<div class="rounded-xl border border-border bg-surface p-5 flex flex-col gap-2">
    @if($icon)
        <div class="w-9 h-9 rounded-lg bg-primary/10 text-primary flex items-center justify-center mb-1">
            <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
        </div>
    @endif
    <div class="text-2xl md:text-3xl font-bold text-content leading-tight">{{ $value }}</div>
    <div class="text-sm text-content-secondary leading-snug">{{ $label }}</div>
</div>
