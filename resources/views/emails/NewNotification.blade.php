@component('mail::message')
# {{ $salutaion ?: 'Hello' }} {{ $recipient }},

@if ($attachment != null)
<div style="text-align:center;">
<img src="{{ $message->embed(asset('storage/'. $attachment)) }}" alt="">
</div>
@endif

{!! $body !!}

@if (!empty($url))
@component('mail::button', ['url' => $url])
Open Dashboard
@endcomponent
@endif

Regards,<br>
**{{ $settings->site_name ?? config('app.name') }} Legal Team**
@endcomponent
