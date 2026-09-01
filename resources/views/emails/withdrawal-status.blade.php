@component('mail::message')
# {{ $withdrawal->status == 'Processed' ? 'Withdrawal Approved' : 'Withdrawal Request Received' }}

@if ($foramin)
Dear Admin,

A new withdrawal request requires review.

@component('mail::table')
|                  |                                                                            |
|:-----------------|:---------------------------------------------------------------------------|
| **Client**       | {{ $user->name }} ({{ $user->email }})                                     |
| **Amount**       | {{ $settings->currency ?? '$' }}{{ number_format($withdrawal->amount, 2) }}|
| **Status**       | {{ $withdrawal->status }}                                                  |
| **Reference**    | {{ $withdrawal->id }}                                                      |
| **Submitted**    | {{ $withdrawal->created_at->format('M d, Y g:i A') }}                      |
@endcomponent

@component('mail::button', ['url' => url('/admin/withdrawals')])
Review Withdrawal Request
@endcomponent
@else
Dear {{ $user->name }},

@if ($withdrawal->status == 'Processed')
We confirm that your withdrawal request has been approved and the funds have been released to your nominated account.
@else
Your withdrawal request has been received and is being processed. You will receive a further notification once the transfer has been completed.
@endif

@component('mail::table')
|                  |                                                                              |
|:-----------------|:-----------------------------------------------------------------------------|
| **Amount**       | {{ $settings->currency ?? '$' }}{{ number_format($withdrawal->amount, 2) }}  |
| **Status**       | {{ $withdrawal->status }}                                                    |
| **Reference**    | {{ $withdrawal->id }}                                                        |
| **Date**         | {{ $withdrawal->created_at->format('M d, Y g:i A') }}                        |
@endcomponent

@component('mail::button', ['url' => route('accounthistory')])
View My Transactions
@endcomponent
@endif

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
