{{-- Resource / Article Card Component --}}
@props(['image', 'tag', 'date', 'title', 'excerpt', 'url' => '#'])

<a href="{{ $url }}" class="group card flex flex-col gap-0 p-0 overflow-hidden">
    <div class="aspect-[16/10] overflow-hidden bg-surface-subtle">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
    </div>
    <div class="flex flex-col gap-3 p-5 flex-1">
        <div class="flex items-center gap-3 text-xs">
            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full">
                <i data-lucide="tag" class="w-3 h-3"></i>
                {{ $tag }}
            </span>
            <span class="text-content-secondary">{{ $date }}</span>
        </div>
        <h3 class="text-base font-semibold text-content leading-snug group-hover:text-primary transition-colors">{{ $title }}</h3>
        <p class="text-sm text-content-secondary leading-relaxed flex-1">{{ $excerpt }}</p>
        <span class="inline-flex items-center gap-1 text-sm font-medium text-primary mt-auto">
            Read more <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
        </span>
    </div>
</a>
