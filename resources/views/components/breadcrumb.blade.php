{{-- Breadcrumb Component --}}
@props(['items' => []])

@if(count($items))
<nav aria-label="Breadcrumb" class="mb-6">
    <ol class="flex items-center gap-1.5 text-sm">
        <li><a href="{{ route('recovery.home') }}" class="text-content-tertiary hover:text-content transition-colors">Home</a></li>
        @foreach($items as $crumb)
            <li class="flex items-center gap-1.5">
                <i data-lucide="chevron-right" class="w-3 h-3 text-content-tertiary"></i>
                @if($crumb['url'] ?? null)
                    <a href="{{ $crumb['url'] }}" class="text-content-tertiary hover:text-content transition-colors">{{ $crumb['label'] }}</a>
                @else
                    <span class="text-content-secondary font-medium">{{ $crumb['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
