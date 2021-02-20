const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

module.exports = {
  purge: ["./*.php", "./views/**/*.twig"],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        primary: "rgba(52, 211, 153, 1)",
      },
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
  plugins: [
    plugin(({ addVariant, e }) => {
      addVariant("before", ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`before${separator}${className}`)}::before`;
        });
      });
      addVariant("after", ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`after${separator}${className}`)}::after`;
        });
      });
    }),
    plugin(({ addUtilities }) => {
      const contentUtilities = {
        ".content": {
          content: "attr(data-content)",
        },
        ".content-before": {
          content: "attr(data-before)",
        },
        ".content-after": {
          content: "attr(data-after)",
        },
      };

      addUtilities(contentUtilities, ["before", "after"]);
    }),
  ],
};
