@component('mail::message')
# Welcome to {{ $settings->site_name ?? config('app.name') }}

Dear {{ $user->name }},

Thank you for registering with {{ $settings->site_name ?? config('app.name') }}. Your account has been successfully created and you may now access your secure client dashboard to file a case, submit supporting documents, and communicate with your assigned case officer.

@component('mail::button', ['url' => route('dashboard')])
Open Your Dashboard
@endcomponent

@component('mail::panel')
**A note on confidentiality.** All communications and documents shared through your account are treated as privileged and confidential. Please contact us at {{ $settings->contact_email ?? config('mail.from.address') }} if you require assistance or wish to discuss your matter directly.
@endcomponent

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
