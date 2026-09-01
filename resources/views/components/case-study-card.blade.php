{{-- Case Study Card Component --}}
@props(['image', 'category', 'title', 'summary', 'recovered', 'duration'])

<article class="card flex flex-col gap-0 p-0 overflow-hidden">
    <div class="relative aspect-[4/3] overflow-hidden bg-surface-subtle">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">
        <span class="absolute top-3 left-3 inline-flex items-center gap-1 bg-surface/95 backdrop-blur-sm text-primary text-xs font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full border border-border-muted">
            <i data-lucide="folder" class="w-3 h-3"></i>
            {{ $category }}
        </span>
    </div>
    <div class="flex flex-col gap-3 p-5 flex-1">
        <h3 class="text-base font-semibold text-content leading-snug">{{ $title }}</h3>
        <p class="text-sm text-content-secondary leading-relaxed flex-1">{{ $summary }}</p>
        <div class="flex items-center gap-2 pt-3 border-t border-border-muted mt-auto">
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary/10 px-2.5 py-1 rounded-full">
                <i data-lucide="banknote" class="w-3 h-3"></i>
                {{ $recovered }}
            </span>
            <span class="inline-flex items-center gap-1.5 text-xs font-medium text-content-secondary">
                <i data-lucide="clock" class="w-3 h-3"></i>
                {{ $duration }}
            </span>
        </div>
    </div>
</article>
