@props(['status'])

@php
    $colorMap = [
        'delivered'  => 'bg-success-100 text-success-700',
        'completed'  => 'bg-success-100 text-success-700',
        'in transit' => 'bg-warning-100 text-warning-700',
        'in-transit' => 'bg-warning-100 text-warning-700',
        'pending'    => 'bg-warning-100 text-warning-700',
        'processing' => 'bg-info-100 text-info-700',
        'shipped'    => 'bg-info-100 text-info-700',
        'cancelled'  => 'bg-danger-100 text-danger-700',
        'failed'     => 'bg-danger-100 text-danger-700',
        'on hold'    => 'bg-danger-100 text-danger-700',
        'on-hold'    => 'bg-danger-100 text-danger-700',
    ];
    $statusLower = strtolower(trim($status));
    $classes = $colorMap[$statusLower] ?? 'bg-surface-100 text-surface-700';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold $classes"]) }}>
    {{ $status }}
</span>
