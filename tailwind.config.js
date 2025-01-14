import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "media",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        screens: {
            sm: "540px",
            md: "720px",
            lg: "960px",
            xl: "1140px",
            "2xl": "1320px",
        },
        container: {
            center: true,
            padding: "16px",
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                black: "#212b36",
                "dark-700": "#090e34b3",
                dark: {
                    DEFAULT: "#111928",
                    2: "#1F2A37",
                    3: "#374151",
                    4: "#4B5563",
                    5: "#6B7280",
                    6: "#9CA3AF",
                    7: "#D1D5DB",
                    8: "#E5E7EB",
                },
                primary: "#3758F9",
                "blue-dark": "#1B44C8",
                secondary: "#13C296",
                "body-color": "#637381",
                "body-secondary": "#8899A8",
                warning: "#FBBF24",
                stroke: "#DFE4EA",
                "gray-1": "#F9FAFB",
                "gray-2": "#F3F4F6",
                "gray-7": "#CED4DA",
            },
            keyframes: {
                gradient: {
                    '0%, 100%': {
                        'background-size': '200% 200%',
                        'background-position': 'left center'
                    },
                    '50%': {
                        'background-size': '200% 200%',
                        'background-position': 'right center'
                    }
                }
            }
        },
    },
    plugins: [forms, typography],
};

