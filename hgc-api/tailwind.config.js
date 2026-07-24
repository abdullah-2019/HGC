import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        
        // Windows-safe forward slash patterns targeting all subfolders
        './resources/views/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './resources/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb', // Saves your bg-primary-600
                    700: '#1d4ed8', // Saves your hover:bg-primary-700
                    800: '#1e40af',
                    900: '#1e3a8a',
                },
                hgc: {
                    blue: '#1e40af',
                    emerald: '#059669',
                    amber: '#d97706',
                    purple: '#7c3aed',
                }
            }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        require('@tailwindcss/typography'),
    ],

    darkMode: 'class',
};
