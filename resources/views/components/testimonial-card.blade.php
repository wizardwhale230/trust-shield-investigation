{{-- Testimonial Card Component --}}
@props(['initials' => '??', 'name' => 'Anonymous', 'title' => '', 'body' => '', 'rating' => 5])

<div class="card flex flex-col gap-4">
    <div class="flex items-center gap-0.5">
        @for ($i = 0; $i < $rating; $i++)
            <i data-lucide="star" class="w-4 h-4 text-warning fill-warning"></i>
        @endfor
    </div>
    @if($title)
        <p class="text-sm font-semibold text-content">{{ $title }}</p>
    @endif
    <p class="text-sm text-content-secondary leading-relaxed flex-1">{{ $body }}</p>
    <div class="flex items-center gap-3 pt-2 border-t border-border-muted">
        <div class="w-8 h-8 rounded-full bg-surface-subtle flex items-center justify-center text-xs font-semibold text-content-secondary">{{ $initials }}</div>
        <span class="text-sm font-medium text-content">{{ $name }}</span>
    </div>
</div>
