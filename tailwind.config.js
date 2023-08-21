/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
    "./src/Form/**/*.php",
  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
      {
        mcu: {
          "primary": "#e62429",
          "secondary": "#3a67d2",
          "accent": "#c6a972",
          "neutral": "#000000",
          "base-100": "#202020",
          "info": "#3a67d2",
          "success": "#68B15D",
          "warning": "#FEDB0E",
          "error": "#e62429",
          "--rounded-box": "0",
          "--rounded-btn": "0",
        },
      }
    ]
  },
  plugins: [require("daisyui")],
}

