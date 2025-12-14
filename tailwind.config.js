import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',  // Include JavaScript files (for Alpine.js, Vue, etc.)
        './resources/**/*.vue', // Include Vue components if used
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                hanken: ['"Hanken Grotesk"', 'sans-serif'], // Custom font family
            },

            // 🔥 Add this block
            colors: {
                amber: {
                    500: '#f59e0b', // Tailwind's amber-500 hex
                },
            },
        },
    },

    plugins: [forms],
};
