@extends('layouts.recovery')

@section('title', 'Client Testimonials | ' . $settings->site_name . ' Solicitors')
@section('description', 'We have recovered millions of pounds for our clients over the years and you can read some of our testimonials here. Contact ' . $settings->site_name . ' today.')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-surface-muted border-b border-border-muted overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-surface/95 via-surface/85 to-surface/40"></div>
        <div class="relative section-container py-16 md:py-24">
            <x-breadcrumb :items="[
                ['label' => 'Our Company', 'url' => route('recovery.about')],
                ['label' => 'Testimonials', 'url' => null],
            ]" />
            <h1 class="text-3xl md:text-4xl">Client Testimonials</h1>
            <p class="mt-4 text-lg text-content-secondary max-w-2xl">
                We have recovered millions of pounds for our clients. Read what they have to say about our services.
            </p>
        </div>
    </section>

    <section>
        <div class="section-container section-padding">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $all_testimonials = [
                    ['initials' => 'HH', 'name' => 'H Harris', 'title' => 'Fantastic company', 'body' => "I picked up " . $settings->site_name . " on a google search, read the reviews and decided to contact them to see if they could help me with a Crypto scam. Right from the start they've been helpful and thorough, I'm about a month into the case and they've already recovered some of my funds. Can't recommend Sophie and " . $settings->site_name . " enough, true lifesavers."],
                    ['initials' => 'RR', 'name' => 'Richard', 'title' => $settings->site_name . ' have done a great job to date', 'body' => $settings->site_name . " have done a great job to date already recovering part of the money lost due to a crypto investment scam credited back to my account within a couple of weeks from providing all relevant information and authorisation to proceed. They appear already to be an extremely professional company with regular contact and updates being provided by Sophie."],
                    ['initials' => 'DD', 'name' => 'Debbie', 'title' => 'Unbelievable service', 'body' => "Josh was so helpful with getting all my money back that I lost through crypto. He was so helpful and informative the whole way through the process. I will always recommend him to anyone who needs help recovering funds. I personally lost six figures, which he got back for me within two weeks. UNBELIEVABLE SERVICE."],
                    ['initials' => 'AA', 'name' => 'Aharon', 'title' => 'A big thank you to Avi and the team', 'body' => "A big thank you to Avi and the team for helping me with my case and all its hurdles along the way. I didn't expect to recover a penny but with the help of " . $settings->site_name . ", a large amount of the capital was recovered. Would highly recommend."],
                    ['initials' => 'JR', 'name' => 'John Ramsdale', 'title' => 'Highly recommend this firm', 'body' => "The team at " . $settings->site_name . " have been really amazing. Hannah has been absolutely great with how she has handled my case so far with the banks. They have recovered some of my funds and are working on recovering the rest for me now. I really wasn't expecting anything back at all so very grateful for this. The whole team pay a lot of attention to detail and reply quickly to my queries and I trust them to work on recovery the rest of my funds. I would highly recommend this firm."],
                    ['initials' => 'CC', 'name' => 'Chris', 'title' => 'Josh & his team have done a great job', 'body' => "Josh & his team have done a great job & should be applauded for their determination & patience to resolve my case successfully. I would highly recommend this company."],
                    ['initials' => 'LM', 'name' => 'Lloyd M', 'title' => 'Professional and a great team', 'body' => "Professional and a great team, always available to talk things through providing great advice. A big thankyou to Grace for all of her great work!"],
                    ['initials' => 'EE', 'name' => 'Emma', 'title' => $settings->site_name . ' have explained the processes', 'body' => $settings->site_name . " have explained the processes thoroughly in terms of fighting for scammed funds. They were very informative on the phone and by email, we've really appreciated their help. We went down the no win no fee route which has taken 7 months, they told it would be 9 months, so it was quicker than expected. We have recovered some lost funds."],
                ];
                @endphp

                @foreach($all_testimonials as $t)
                <x-testimonial-card
                    :initials="$t['initials']"
                    :name="$t['name']"
                    :title="$t['title']"
                    :body="$t['body']"
                    :rating="5"
                />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta-banner :dark="true" title="Join our list of satisfied clients" subtitle="Start your free consultation today." />

@endsection
