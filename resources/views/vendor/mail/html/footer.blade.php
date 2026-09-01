{{-- Branded footer — site_name / address / contact / year / confidentiality --}}
<tr>
<td>
<table class="footer" align="center" width="600" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
<p class="firm-name">{{ $settings->site_name ?? config('app.name') }}</p>
@if (!empty($settings) && !empty($settings->site_address))
<p class="firm-meta">{{ $settings->site_address }}</p>
@endif
@if (!empty($settings) && !empty($settings->contact_email))
<p class="firm-meta">
<a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>
</p>
@endif
<hr class="footer-divider">
<p class="firm-meta">&copy; {{ date('Y') }} {{ $settings->site_name ?? config('app.name') }}. All rights reserved.</p>
<p class="confidentiality">
This message and any attachments are confidential and may be legally privileged.
If you are not the intended recipient, please notify the sender and delete this email.
</p>
</td>
</tr>
</table>
</td>
</tr>
