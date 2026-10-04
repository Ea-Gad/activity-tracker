import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    50:  '#ecfdf5',
                    100: '#d1fae5',
                    200: '#a7f3d0',
                    300: '#6ee7b7',
                    400: '#34d399',
                    500: '#10b981',
                    600: '#059669',
                    700: '#047857',
                    800: '#065f46',
                    900: '#064e3b',
                },
            },
            keyframes: {
                'fade-in-up': {
                    '0%':   { opacity: '0', transform: 'translateY(8px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'slide-in-right': {
                    '0%':   { opacity: '0', transform: 'translateX(24px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                'pulse-ring': {
                    '0%':   { boxShadow: '0 0 0 0 rgba(16,185,129,0.4)' },
                    '70%':  { boxShadow: '0 0 0 12px rgba(16,185,129,0)' },
                    '100%': { boxShadow: '0 0 0 0 rgba(16,185,129,0)' },
                },
            },
            animation: {
                'fade-in-up':    'fade-in-up 0.35s ease-out',
                'slide-in-right':'slide-in-right 0.3s ease-out',
                'pulse-ring':    'pulse-ring 1.8s infinite',
            },
        },
    },
    plugins: [forms],
};