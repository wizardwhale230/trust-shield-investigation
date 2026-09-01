@component('mail::message')
# Plan Concluded

Dear {{ $demo->receiver_name }},

Your **{{ $demo->receiver_plan }}** plan has reached the end of its term. The associated capital has been released and is now available in your account balance for withdrawal.

@component('mail::table')
|              |                              |
|:-------------|:-----------------------------|
| **Plan**     | {{ $demo->receiver_plan }}   |
| **Amount**   | {{ $demo->received_amount }} |
| **Date**     | {{ $demo->date }}            |
@endcomponent

@component('mail::button', ['url' => route('withdrawalsdeposits') ])
Request a Withdrawal
@endcomponent

Regards,<br>
**{{ $demo->sender }}**
@endcomponent
