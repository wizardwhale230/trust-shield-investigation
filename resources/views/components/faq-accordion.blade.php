{{-- FAQ Accordion Component --}}
@props(['items' => []])

@if(count($items))
<div class="space-y-2">
    @foreach($items as $i => $item)
        <div x-data="{ open: false }" class="border border-border-muted rounded-lg">
            <button @click="open = !open" class="flex items-center justify-between w-full px-5 py-4 text-left" :aria-expanded="open">
                <span class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-content-tertiary">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <span class="text-sm font-semibold text-content">{{ $item['question'] }}</span>
                </span>
                <i data-lucide="plus" class="w-4 h-4 text-content-tertiary flex-shrink-0 transition-transform" :class="open && 'rotate-45'"></i>
            </button>
            <div x-show="open" x-transition x-cloak>
                <div class="px-5 pb-4 ml-8">
                    <p class="text-sm text-content-secondary leading-relaxed">{!! $item['answer'] !!}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
