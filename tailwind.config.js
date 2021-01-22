const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  purge: ["./*.php", "./views/**/*.twig"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      fontFamily: {
        sans: ["Spartan", ...defaultTheme.fontFamily.sans],
      },
      container: {
        center: true,
        padding: {
          DEFAULT: "1rem",
        },
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
