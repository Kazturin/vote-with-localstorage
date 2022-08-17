const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'main': "url('https://votekzfree.tk/img/main.jpg')",
            },
            screens: {
                'xs': '475px',
                ...defaultTheme.screens,
              },
            keyframes: {
                'fade-in-down': {
                    "from": {
                        transform: "translateY(-0.75rem)",
                        opacity: '0'
                    },
                    "to": {
                        transform: "translateY(0rem)",
                        opacity: '1'
                    },
                },
            },
            animation: {
                'fade-in-down': "fade-in-down 0.2s ease-in-out both",
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
