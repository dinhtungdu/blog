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
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
