{{-- Branded header — pulls firm logo / name from globally shared $settings --}}
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (!empty($settings) && !empty($settings->logo))
<img src="{{ asset('storage/app/public/' . $settings->logo) }}" class="logo" alt="{{ $settings->site_name ?? $slot }}">
@else
{{ $settings->site_name ?? $slot }}
@endif
</a>
</td>
</tr>
