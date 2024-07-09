/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        myColor: {
          50: "#fbfbef",
          100: "#f7f8df",
          200: "#eff0bf",
          300: "#e7e99e",
          400: "#dfe17e",
          500: "#d7da5e",
          600: "#acae4b",
          700: "#818338",
          800: "#565726",
          900: "#2b2c13"
        }
      }

    },
  },
  daisyui: {
    themes: ["cupcake"],
  },
  plugins: [
    require('flowbite/plugin'),
    require('daisyui'),
  ],
}

