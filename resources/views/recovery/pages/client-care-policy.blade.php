@extends('layouts.recovery')

@section('title', 'Client Care Policy | ' . $settings->site_name . ' Solicitors')
@section('description', 'Client care policy for ' . $settings->site_name . ' Solicitors.')

@section('content')
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1505664194779-8beaceb93744?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Client Care Policy', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Client Care Policy</h1>
        </div>
    </section>
    <section>
        <div class="section-container section-padding max-w-3xl">
            <div class="prose-content">
                <p>At {{ $settings->site_name  }} Solicitors, we are committed to providing the highest standards of client care. This policy outlines our commitment to you.</p>
                <h2>Communication</h2>
                <p>We will keep you informed about the progress of your case at regular intervals. You can contact your case handler directly by phone or email during office hours.</p>
                <h2>Costs</h2>
                <p>We will provide you with clear and transparent information about our fees at the outset of your case. Any changes to the estimated costs will be communicated to you immediately.</p>
                <h2>Quality of Service</h2>
                <p>We strive to provide an excellent service. If at any point you are unhappy with the service you receive, please refer to our Complaints Procedure.</p>
                <h2>Contact</h2>
                <p>For any client care enquiries, please contact us at <a href="mailto:{{ $settings->contact_email ?? '' }}">{{ $settings->contact_email ?? '' }}</a> or call <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}">{{ $settings->office_phone ?? '' }}</a>.</p>
            </div>
        </div>
    </section>
@endsection
