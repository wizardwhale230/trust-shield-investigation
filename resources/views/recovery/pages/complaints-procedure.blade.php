@extends('layouts.recovery')

@section('title', 'Complaints Procedure | ' . $settings->site_name . ' Solicitors')
@section('description', 'Complaints procedure for ' . $settings->site_name . ' Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Complaints Procedure', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Complaints Procedure</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>We are committed to providing a high-quality legal service. If you are unhappy with any aspect of our service, please let us know and we will do our best to resolve your concerns.</p>
                <h2>How to Make a Complaint</h2>
                <p>In the first instance, please contact us by email at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a> or by phone on <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}">{{ $settings->office_phone ?? '' }}</a>, outlining the nature of your complaint.</p>
                <h2>What Happens Next</h2>
                <ol>
                    <li>We will acknowledge your complaint within 2 working days</li>
                    <li>We will investigate the matter thoroughly</li>
                    <li>We will provide a detailed written response within 8 weeks</li>
                    <li>If you remain unhappy, we will inform you of your right to complain to the Legal Ombudsman</li>
                </ol>
                {{-- <h2>Legal Ombudsman</h2> --}}
                {{-- <p>If you are not satisfied with our response, you may contact the Legal Ombudsman at <a href="https://www.legalombudsman.org.uk" target="_blank" rel="noopener noreferrer">www.legalombudsman.org.uk</a>.</p> --}}
            </div>
        </div>
    </section>
@endsection
