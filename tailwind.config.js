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
      boxShadow: {
        button: "6px 6px 0px",
      },
      maxWidth: {
        "1/5": "20%",
        "1/4": "25%",
        "1/3": "33%",
        "2/5": "40%",
        "1/2": "50%",
        "3/5": "60%",
        "2/3": "66%",
        "3/4": "75%",
        "4/5": "80%",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
};
