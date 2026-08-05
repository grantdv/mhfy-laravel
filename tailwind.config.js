import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Brand colors from logo
                brand: {
                    dark: '#04405F',
                    medium: '#3483EB',
                    light: '#8AE1F0',
                    accent: '#f5771d', // NEW ORANGE ACCENT
                    bgLight: '#F0FCFD',
                    bgMedium: '#D2F4F9',
                }
            },
        },
    },

    plugins: [forms],
};
