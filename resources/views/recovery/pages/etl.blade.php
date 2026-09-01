@extends('layouts.recovery')

@section('title', 'ETL | ' . $settings->site_name . ' Solicitors')
@section('description', 'European Trust Label certification for ' . $settings->site_name . ' Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[
                ['label' => 'Our Company', 'url' => route('recovery.about')],
                ['label' => 'ETL', 'url' => null],
            ]" />
            <h1 class="text-3xl md:text-4xl">European Trust Label</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>{{ $settings->site_name  }} Solicitors holds the European Trust Label (ETL), which certifies that our business practices meet the highest standards of transparency and consumer protection.</p>
                <h2>What is the ETL?</h2>
                <p>The European Trust Label is a quality mark awarded to companies that demonstrate adherence to strict legal compliance standards. It verifies that a company meets requirements for transparency, data protection, and fair business practices.</p>
                <h2>What This Means for You</h2>
                <p>Our ETL certification gives you confidence that we operate to the highest ethical and legal standards, providing an additional layer of trust and accountability.</p>
            </div>
        </div>
    </section>
@endsection
