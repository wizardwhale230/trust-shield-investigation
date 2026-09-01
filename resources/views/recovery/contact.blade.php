@extends('layouts.recovery')

@section('title', 'Contact | ' . $settings->site_name . ' Solicitors')
@section('description', 'If you have been the victim of investment fraud and would like to know more about what you can do, contact us at ' . $settings->site_name . ' today to arrange a free consultation.')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[['label' => 'Contact', 'url' => null]]" />
            <h1 class="text-3xl md:text-4xl">Contact Us</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                Get in touch with our team for a free consultation about your case.
            </p>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg text-sm text-green-800">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16">
                {{-- Contact Form --}}
                <div class="lg:col-span-3">
                    <h2 class="text-xl font-semibold mb-6">Send us a message</h2>
                    <form action="{{ route('recovery.contact.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-name" class="block text-sm font-medium text-content mb-1">Full Name</label>
                                <input type="text" id="contact-name" name="name" required class="input-field" placeholder="Your full name" value="{{ old('name') }}">
                                @error('name') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="contact-email" class="block text-sm font-medium text-content mb-1">Email</label>
                                <input type="email" id="contact-email" name="email" required class="input-field" placeholder="your@email.com" value="{{ old('email') }}">
                                @error('email') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-phone" class="block text-sm font-medium text-content mb-1">Phone Number</label>
                                <input type="tel" id="contact-phone" name="phone" class="input-field" placeholder="Your phone number" value="{{ old('phone') }}">
                            </div>
                            <div>
                                <label for="contact-service" class="block text-sm font-medium text-content mb-1">Service Required</label>
                                <select id="contact-service" name="service" class="input-field">
                                    <option value="">Select a service</option>
                                    <option value="trading-scams" @selected(old('service') === 'trading-scams')>Trading Scams</option>
                                    <option value="cryptocurrency" @selected(old('service') === 'cryptocurrency')>Cryptocurrency Recovery</option>
                                    <option value="forex" @selected(old('service') === 'forex')>Forex Trading Scams</option>
                                    <option value="investment" @selected(old('service') === 'investment')>Investment Scams</option>
                                    <option value="bank-fraud" @selected(old('service') === 'bank-fraud')>Bank Fraud</option>
                                    <option value="romance-fraud" @selected(old('service') === 'romance-fraud')>Romance Fraud</option>
                                    <option value="other" @selected(old('service') === 'other')>Other</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="contact-message" class="block text-sm font-medium text-content mb-1">Message</label>
                            <textarea id="contact-message" name="message" rows="5" required class="input-field" placeholder="Tell us about your case">{{ old('message') }}</textarea>
                            @error('message') <p class="text-sm text-error mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="btn-primary">Send Message</button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="lg:col-span-2">
                    <h2 class="text-xl font-semibold mb-6">Contact information</h2>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-surface-muted rounded-md">
                                <i data-lucide="mail" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-content mb-1">Email</p>
                                <a href="mailto:{{ $settings->contact_email ?? '' }}" class="text-sm text-content-secondary hover:text-primary transition-colors">{{ $settings->contact_email ?? '' }}</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-surface-muted rounded-md">
                                <i data-lucide="phone" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-content mb-1">Phone</p>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->office_phone ?? '') }}" class="text-sm text-content-secondary hover:text-primary transition-colors">{{ $settings->office_phone ?? '' }}</a>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-surface-muted rounded-md">
                                <i data-lucide="clock" class="w-5 h-5 text-primary"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-content mb-1">Office Hours</p>
                                <p class="text-sm text-content-secondary">Mon - Fri: 9:00 - 17:30</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 p-6 bg-surface-muted rounded-lg">
                        <h4 class="text-base font-semibold text-content mb-2">Prefer to start online?</h4>
                        <p class="text-sm text-content-secondary mb-4">Use our quick claim form to get started right away.</p>
                        <a href="{{ route('recovery.claim') }}" class="btn-primary w-full text-center">Start Your Claim</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
