@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'class' => '
            block w-full p-4 rounded-lg

            appearance-none
            bg-gray-300 bg-opacity-10
            text-white placeholder-white/50

            border border-gray-300

            focus:outline-none
            focus:ring-0
            focus:ring-offset-0
            focus:border-gray-300
        '
    ]) }}
>

