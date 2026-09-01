@component('mail::message')
# Fee Request for Your Recovery Case

Dear {{ $user->name }},

A fee has been requested in connection with your recovery case. Settlement of this fee allows our team to proceed with the next stage of your matter without delay.

@component('mail::table')
|                       |                                                                            |
|:----------------------|:---------------------------------------------------------------------------|
| **Case Number**       | {{ $case->case_number }}                                                   |
| **Fee Title**         | {{ $feeRequest->title }}                                                   |
| **Amount Due**        | {{ $settings->currency ?? '$' }}{{ number_format($feeRequest->amount, 2) }}|
| **Issued**            | {{ $feeRequest->created_at->format('M d, Y') }}                            |
@endcomponent

@if ($feeRequest->description)
@component('mail::panel')
**Details from your case officer:** {!! e($feeRequest->description) !!}
@endcomponent
@endif

@component('mail::button', ['url' => route('deposits')])
Pay Securely
@endcomponent

If you have any questions about this fee or wish to discuss the breakdown, please reply to this email or contact us at {{ $settings->contact_email ?? config('mail.from.address') }}.

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
