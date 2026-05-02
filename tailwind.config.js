import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.jsx",
    ],

    theme: {
        extend: {
            fontFamily: {
                // UTAMA: Libre Caslon (Serif)
                primary: ["'Libre Caslon'", ...defaultTheme.fontFamily.serif],

                // SEKUNDER: Figtree (Sans)
                secondary: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                tertiary: "#433a35",
            },
        },
    },

    plugins: [forms],
};
