@component('mail::message')
# {{ $forAdmin ? 'New Recovery Case Filed' : 'Your Recovery Case Has Been Filed' }}

@if ($forAdmin)
Dear Admin,

A new recovery case has been submitted by **{{ $user->name }}** ({{ $user->email }}) and is awaiting review and assignment.
@else
Dear {{ $user->name }},

Thank you for trusting {{ $settings->site_name ?? config('app.name') }} with your case. Your recovery matter has been formally received and a case number has been assigned. Our legal team will begin the initial review and contact you with next steps.
@endif

@component('mail::table')
|                       |                                                                                                       |
|:----------------------|:------------------------------------------------------------------------------------------------------|
| **Case Number**       | {{ $case->case_number }}                                                                              |
| **Fraud Type**        | {{ ucwords(str_replace('_', ' ', $case->fraud_type)) }}                                               |
| **Amount Lost**       | {{ $case->amount_lost }}                                                                               |
@if ($forAdmin)
| **Filed By**          | {{ $user->name }}                                                                                     |
| **Client Email**      | {{ $user->email }}                                                                                    |
@endif
| **Date Filed**        | {{ $case->created_at->format('M d, Y') }}                                                             |
@endcomponent

@component('mail::button', ['url' => $forAdmin ? route('admin.cases.show', $case->id) : route('user.cases.show', $case->id)])
{{ $forAdmin ? 'Review Case in Admin Panel' : 'View My Case' }}
@endcomponent

@unless ($forAdmin)
@component('mail::panel')
**What happens next.** A dedicated case officer will be assigned within one business day. All communication regarding your case is confidential and protected by attorney–client privilege.
@endcomponent
@endunless

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
