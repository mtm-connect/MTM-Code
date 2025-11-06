@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'p-4 border-gray-300 bg-gray-300 bg-opacity-10 focus:font-bold  focus:bg-opacity-10 focus:border-gray-300 rounded-lg focus:ring-gray-300 ']) }}>
