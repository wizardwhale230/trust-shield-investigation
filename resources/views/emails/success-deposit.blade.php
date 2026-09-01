@component('mail::message')
# {{ $deposit->status == 'Processed' ? 'Fee Payment Confirmed' : 'Fee Authorisation Received' }}

@if ($foramin)
Dear Team,

A fee payment has been recorded on the client portal.

@component('mail::table')
|                  |                                                                                |
|:-----------------|:-------------------------------------------------------------------------------|
| **Client**       | {{ $user->name }} ({{ $user->email }})                                         |
@if($case)
| **Matter**       | {{ $case->case_number }}                                                       |
@endif
@if($feeRequest)
| **Fee**          | {{ $feeRequest->title }} (FR-{{ $feeRequest->id }})                            |
@endif
| **Amount**       | {{ $settings->currency ?? '$' }}{{ number_format($deposit->amount, 2) }}       |
| **Channel**      | {{ $deposit->payment_mode }}                                                   |
| **Status**       | {{ $deposit->status }}                                                         |
| **Reference**    | RCPT-{{ str_pad($deposit->id, 6, '0', STR_PAD_LEFT) }}                         |
| **Received**     | {{ $deposit->created_at->format('M d, Y g:i A') }}                             |
@endcomponent

@if ($deposit->status !== 'Processed')
@component('mail::button', ['url' => url('/admin/deposits')])
Review Payment
@endcomponent
@endif
@else
Dear {{ $user->name }},

@if ($deposit->status == 'Processed')
We confirm receipt of your fee payment into our client trust account. Your matter file has been updated accordingly.
@else
Thank you. Your fee payment has been received and is being reconciled by our finance team. You will receive a further notification once it is fully verified.
@endif

@component('mail::table')
|                  |                                                                                |
|:-----------------|:-------------------------------------------------------------------------------|
@if($case)
| **Matter**       | {{ $case->case_number }}                                                       |
@endif
@if($feeRequest)
| **Fee**          | {{ $feeRequest->title }}                                                       |
| **Reference**    | FR-{{ $feeRequest->id }}                                                       |
@endif
| **Amount**       | {{ $settings->currency ?? '$' }}{{ number_format($deposit->amount, 2) }}       |
| **Channel**      | {{ $deposit->payment_mode }}                                                   |
| **Status**       | {{ $deposit->status }}                                                         |
| **Receipt No.**  | RCPT-{{ str_pad($deposit->id, 6, '0', STR_PAD_LEFT) }}                         |
| **Date**         | {{ $deposit->created_at->format('M d, Y g:i A') }}                             |
@endcomponent

@component('mail::button', ['url' => route('payment.receipt', $deposit->id)])
View Receipt
@endcomponent
@endif

_This communication is confidential and intended solely for the addressee. Funds are held in our client trust account in accordance with the terms of your retainer agreement._

Kind regards,<br>
**{{ $settings->site_name ?? config('app.name') }} — Recovery & Claims Team**
@endcomponent
