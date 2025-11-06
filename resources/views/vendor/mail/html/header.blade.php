@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
    <!-- Logo -->
    <div class="text-xl text-white font-bold mb-12 flex justify-center items-center mt-12">
            <a href="{{ $url }}">
                <x-application-logo class="block fill-current text-gray-800 bg-red-400" />
            </a>
        </div>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
