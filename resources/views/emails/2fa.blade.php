@component('mail::message')
# Verification Code

A request has been made to verify your identity on your {{ $settings->site_name ?? config('app.name') }} account. Please use the following one-time code to continue:

<div style="text-align:center;">
<span class="code-block">{!! $demo->message !!}</span>
</div>

If you did not request this code, please disregard this message and consider changing your account password.

@component('mail::panel')
**Security notice.** Our team will never ask you for this code by phone, email or chat. Do not share it with anyone.
@endcomponent

Regards,<br>
**{{ $demo->sender ?? ($settings->site_name ?? config('app.name')) }}**
@endcomponent
