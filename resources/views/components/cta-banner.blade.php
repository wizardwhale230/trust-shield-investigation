{{-- CTA Banner Component --}}
@props(['title' => 'Ready to recover your funds?', 'subtitle' => 'Get a free consultation with our team of expert fraud lawyers today.', 'button' => 'Start Your Claim', 'url' => null, 'dark' => false])

@php $url = $url ?? route('recovery.claim'); @endphp

<section class="{{ $dark ? 'bg-content' : 'bg-surface-muted' }}">
    <div class="section-container section-padding">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-2xl md:text-3xl font-semibold {{ $dark ? 'text-content-inverse' : 'text-content' }} mb-4">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-base {{ $dark ? 'text-content-tertiary' : 'text-content-secondary' }} mb-8">{{ $subtitle }}</p>
            @endif
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ $url }}" class="btn-primary">{{ $button }}</a>
                <a href="{{ route('recovery.contact') }}" class="{{ $dark ? 'btn-ghost text-content-inverse border border-content-tertiary/30 hover:bg-content-inverse/10' : 'btn-secondary' }}">Contact Us</a>
            </div>
        </div>
    </div>
</section>
