{{-- Team Member Card Component --}}
@props(['image', 'name', 'role', 'specialism' => '', 'linkedin' => null])

<div class="flex flex-col gap-3">
    <div class="aspect-square overflow-hidden rounded-xl bg-surface-subtle">
        <img src="{{ $image }}" alt="{{ $name }}, {{ $role }}" class="w-full h-full object-cover" loading="lazy">
    </div>
    <div class="flex flex-col gap-1">
        <h3 class="text-base font-semibold text-content leading-tight">{{ $name }}</h3>
        <p class="text-xs uppercase tracking-wider text-primary font-semibold">{{ $role }}</p>
        @if($specialism)
            <p class="text-sm text-content-secondary leading-snug mt-1">{{ $specialism }}</p>
        @endif
        @if($linkedin)
            <a href="{{ $linkedin }}" rel="noopener" target="_blank" class="inline-flex items-center gap-1 text-xs font-medium text-primary hover:underline mt-2">
                <i data-lucide="linkedin" class="w-3.5 h-3.5"></i>
                Connect on LinkedIn
            </a>
        @endif
    </div>
</div>
