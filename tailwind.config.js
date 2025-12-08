import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        "bg-green-100",
        "text-green-800",
        "bg-red-100",
        "text-red-800",
        "bg-yellow-100",
        "text-yellow-800",
        "text-indigo-400",
        "text-red-400",
        "text-green-400",
        "text-yellow-400",
        "text-orange-400",
        "text-gray-400",
    ],

    plugins: [forms, typography],
};
