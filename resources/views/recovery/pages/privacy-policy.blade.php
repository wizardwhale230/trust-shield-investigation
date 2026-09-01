@extends('layouts.recovery')

@section('title', 'Privacy Policy | ' . $settings->site_name . ' Solicitors')
@section('description', 'Privacy policy for ' . $settings->site_name . ' Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Privacy Policy', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Privacy Policy</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>{{ $settings->site_name  }} Solicitors (&ldquo;we&rdquo;, &ldquo;us&rdquo;, &ldquo;our&rdquo;) is committed to protecting your personal data and your privacy. This privacy policy explains how we use any personal information we collect about you.</p>
                <h2>What Information Do We Collect?</h2>
                <p>We collect information when you contact us, use our website, or engage our services. This may include:</p>
                <ul>
                    <li>Your name, email address, phone number, and postal address</li>
                    <li>Details about your case, including financial information</li>
                    <li>Information collected automatically through cookies and analytics</li>
                </ul>
                <h2>How Do We Use Your Information?</h2>
                <p>We use your information to:</p>
                <ul>
                    <li>Provide legal services and manage your case</li>
                    <li>Communicate with you about your case</li>
                    <li>Improve our website and services</li>
                    <li>Comply with legal and regulatory obligations</li>
                </ul>
                <h2>How Do We Store Your Data?</h2>
                <p>We store your data securely and retain it only for as long as necessary to provide our services and comply with our legal obligations.</p>
                <h2>Your Rights</h2>
                <p>You have the right to access, correct, or delete your personal data. You also have the right to restrict processing, object to processing, and data portability. Contact us at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a> to exercise any of these rights.</p>
                <h2>Contact</h2>
                <p>If you have questions about this privacy policy, please contact us at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a>.</p>
            </div>
        </div>
    </section>
@endsection
