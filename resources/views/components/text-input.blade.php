@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'p-4 border-gray-300 bg-gray-300 bg-opacity-10 focus:font-bold focus:bg-emerald-950 focus:bg-opacity-10 focus:border-emerald-950 rounded-lg focus:ring-emerald-950 ']) }}>
