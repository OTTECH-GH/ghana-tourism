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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                ghana: {
                    red: '#CE1126',
                    gold: '#FCD116',
                    green: '#006B3F',
                    black: '#000000',
                },
                primary: {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    200: '#bbf7d0',
                    300: '#86efac',
                    400: '#4ade80',
                    500: '#006B3F',
                    600: '#005C35',
                    700: '#004D2C',
                    800: '#003E23',
                    900: '#002F1A',
                    950: '#001F11',
                },
                accent: {
                    50: '#FFFBEB',
                    100: '#FEF3C7',
                    200: '#FDE68A',
                    300: '#FCD34D',
                    400: '#FCD116',
                    500: '#EAB308',
                    600: '#CA8A04',
                    700: '#A16207',
                    800: '#854D0E',
                    900: '#713F12',
                },
            },
        },
    },

    plugins: [forms],
};
