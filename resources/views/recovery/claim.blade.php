@extends('layouts.recovery')

@section('title', 'Start Your Claim | ' . $settings->site_name . ' Solicitors')
@section('description', 'Start recovering your losses and arrange a free legal consultation with our team of solicitors today. Contact ' . $settings->site_name . ' Solicitors to find out more.')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Start Your Claim', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Start Your Claim</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                Answer a few quick questions and we&rsquo;ll arrange a free consultation to discuss your case.
            </p>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            <x-claim-wizard />
        </div>
    </section>

@endsection
