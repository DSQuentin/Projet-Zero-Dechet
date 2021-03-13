module.exports = {
  purge: {
    enabled: true,
    content: [
        "./templates/**/*.twig",
        "./templates/*/twig"
    ],
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
