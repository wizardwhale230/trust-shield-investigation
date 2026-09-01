@extends('layouts.recovery')

@section('title', 'Cookie Policy | Verfins Recovery Solicitors')
@section('description', 'Cookie policy for Verfins Recovery Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Cookie Policy', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Cookie Policy</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>This Cookie Policy explains how Verfins Recovery Solicitors uses cookies and similar technologies on our website.</p>
                <h2>What Are Cookies?</h2>
                <p>Cookies are small text files stored on your device when you visit a website. They help us improve your experience and understand how our website is used.</p>
                <h2>Types of Cookies We Use</h2>
                <ul>
                    <li><strong>Essential Cookies:</strong> Necessary for the website to function properly</li>
                    <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our website</li>
                    <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertising</li>
                </ul>
                <h2>Managing Cookies</h2>
                <p>You can control and manage cookies through your browser settings. Please note that disabling certain cookies may affect the functionality of our website.</p>
                <h2>Contact</h2>
                <p>If you have questions about our cookie policy, contact us at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a>.</p>
            </div>
        </div>
    </section>
@endsection
