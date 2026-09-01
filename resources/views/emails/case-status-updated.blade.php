@component('mail::message')
# Case Status Update

Dear {{ $user->name }},

There has been an update on your recovery case. Please review the details below.

@component('mail::table')
|                          |                                                                              |
|:-------------------------|:-----------------------------------------------------------------------------|
| **Case Number**          | {{ $case->case_number }}                                                     |
| **Previous Status**      | {{ ucwords(str_replace('_', ' ', $oldStatus)) }}                             |
| **Current Status**       | {{ ucwords(str_replace('_', ' ', $case->status)) }}                          |
| **Updated**              | {{ $case->updated_at->format('M d, Y g:i A') }}                              |
@endcomponent

@php
    $statusNote = [
        'assigned'           => 'Your case has been assigned to a recovery specialist who will begin work immediately.',
        'investigating'      => 'Our investigators are actively gathering evidence and tracing the funds related to your case.',
        'legal_action'       => 'Formal legal proceedings have been initiated on your behalf.',
        'funds_recovered'    => 'We are pleased to inform you that funds have been recovered for your case. Please review your dashboard for details.',
        'withdrawal_ready'   => 'Recovered funds are now available for withdrawal from your account.',
        'closed'             => 'Your case has been formally closed. If you have any questions, please contact our team.',
    ][$case->status] ?? null;
@endphp

@if ($statusNote)
@component('mail::panel')
{{ $statusNote }}
@endcomponent
@endif

@component('mail::button', ['url' => route('user.cases.show', $case->id)])
View Case Details
@endcomponent

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
