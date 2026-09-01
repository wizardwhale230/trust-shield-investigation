@component('mail::message')
# Funds Recovered for Your Case

Dear {{ $user->name }},

We are pleased to inform you that a recovery has been credited to your account in connection with your case.

@component('mail::table')
|                              |                                                                                       |
|:-----------------------------|:--------------------------------------------------------------------------------------|
| **Case Number**              | {{ $case->case_number }}                                                              |
| **Amount Credited**          | {{ $settings->currency ?? '$' }}{{ number_format($amount, 2) }}                       |
| **Total Recovered to Date**  | {{ $settings->currency ?? '$' }}{{ number_format($case->amount_recovered, 2) }}       |
| **Credited On**              | {{ now()->format('M d, Y') }}                                                         |
@endcomponent

@component('mail::panel')
The recovered amount has been added to your available account balance. You may request a withdrawal at any time from your dashboard.
@endcomponent

@component('mail::button', ['url' => route('accounthistory')])
View My Transactions
@endcomponent

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
