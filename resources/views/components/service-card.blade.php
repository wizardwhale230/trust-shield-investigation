{{-- Service Card Component --}}
@props(['title', 'desc' => '', 'url' => '#', 'icon' => 'shield'])

<a href="{{ $url }}" class="group card flex flex-col gap-4">
    <div class="flex items-center gap-3">
        <i data-lucide="{{ $icon }}" class="w-5 h-5 text-primary flex-shrink-0"></i>
        <h4 class="text-base font-semibold text-content group-hover:text-primary transition-colors">{{ $title }}</h4>
    </div>
    @if($desc)
        <p class="text-sm text-content-secondary leading-relaxed">{{ $desc }}</p>
    @endif
    <span class="inline-flex items-center gap-1 text-sm font-medium text-primary opacity-0 group-hover:opacity-100 transition-opacity mt-auto">
        Learn more <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
    </span>
</a>
