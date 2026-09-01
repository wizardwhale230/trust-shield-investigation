@component('mail::message')
# Welcome to {{ $demo->sender }}

Dear {{ $demo->receiver_name ?? 'Client' }},

Your registration has been successfully completed. Below are the temporary credentials generated for your account. We strongly recommend updating your password upon first sign in.

@component('mail::table')
|                          |                                |
|:-------------------------|:-------------------------------|
| **Temporary Password**   | `{{ $demo->password }}`        |
@endcomponent

@component('mail::button', ['url' => route('login')])
Sign In to Your Account
@endcomponent

@component('mail::panel')
**A note on security.** For your protection, please change your password immediately after signing in. If you require assistance, contact us at {{ $demo->contact_email ?? ($settings->contact_email ?? config('mail.from.address')) }}.
@endcomponent

Regards,<br>
**{{ $demo->sender }}**
@endcomponent
