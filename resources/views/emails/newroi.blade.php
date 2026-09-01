@component('mail::message')
# Account Update

Dear {{ $user->name }},

A return has been credited to your account. The details are recorded below for your reference.

@component('mail::table')
|              |                                                                |
|:-------------|:---------------------------------------------------------------|
| **Plan**     | {{ $plan }}                                                    |
| **Amount**   | {{ $settings->currency ?? '$' }}{{ number_format($amount, 2) }}|
| **Date**     | {{ $plandate }}                                                |
@endcomponent

@component('mail::button', ['url' => route('accounthistory')])
View My Transactions
@endcomponent

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
