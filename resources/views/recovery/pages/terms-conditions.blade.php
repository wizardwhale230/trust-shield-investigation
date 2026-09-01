@extends('layouts.recovery')

@section('title', 'Terms & Conditions | ' . $settings->site_name . ' Solicitors')
@section('description', 'Terms and conditions for ' . $settings->site_name . ' Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Terms & Conditions', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Terms &amp; Conditions</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>These terms and conditions govern your use of the {{ $settings->site_name  }} Solicitors website and our legal services.</p>
                <h2>Use of Our Website</h2>
                <p>The content on our website is for general information purposes only. It does not constitute legal advice and should not be relied upon as such.</p>
                <h2>Our Services</h2>
                <p>Our legal services are provided under separate engagement terms which will be provided to you before we commence work on your case.</p>
                <h2>Liability</h2>
                <p>While we make every effort to ensure the accuracy of information on our website, we do not guarantee that the content is error-free.</p>
                <h2>Intellectual Property</h2>
                <p>All content on this website, including text, images, logos, and design, is the property of {{ $settings->site_name  }} Solicitors and is protected by copyright laws.</p>
                <h2>Governing Law</h2>
                <p>These terms are governed by the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the courts of England and Wales.</p>
                <h2>Contact</h2>
                <p>If you have questions about these terms, contact us at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a>.</p>
            </div>
        </div>
    </section>
@endsection
