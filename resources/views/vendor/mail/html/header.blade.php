@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Elceto Holding')
{{-- <img src="http://127.0.0.1:8000/public/assets/images/logo_elceto.png" class="logo" alt="Elceto Logo"> --}}
Elceto Holding
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
