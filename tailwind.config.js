import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'

export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        hanken: ['"Hanken Grotesk"', 'sans-serif'],
      },
      colors: {
        amber: { 500: '#f59e0b' },
      },
    },
  },
  plugins: [forms({ strategy: 'class' })],
}

