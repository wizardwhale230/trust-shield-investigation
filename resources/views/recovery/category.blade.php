@extends('layouts.recovery')

@section('title', $categoryName . ' | ' . $settings->site_name . ' Solicitors')
@section('description', 'Browse our ' . strtolower($categoryName) . ' recovery services.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[
                ['label' => 'Services', 'url' => route('recovery.services')],
                ['label' => $categoryName, 'url' => null],
            ]" />
            <h1 class="text-3xl md:text-4xl">{{ $categoryName }}</h1>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($services as $slug => $s)
                <x-service-card
                    :title="$s['name']"
                    :desc="$s['description']"
                    :url="route('recovery.service', $slug)"
                    :icon="$s['icon']"
                />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-banner :dark="true" title="Need help with your case?" subtitle="Contact us for a free, no-obligation consultation." />
@endsection
